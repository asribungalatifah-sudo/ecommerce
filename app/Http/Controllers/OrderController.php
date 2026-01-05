<?php
// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;


class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan milik user yang sedang login.
     */
    public function index()
    {
        // PENTING: Jangan gunakan Order::all() !
        // Kita hanya mengambil order milik user yg sedang login menggunakan relasi hasMany.
        // auth()->user()->orders() akan otomatis memfilter: WHERE user_id = current_user_id
        $orders = auth()->user()->orders()
            ->with(['items.product']) // Eager Load nested: Order -> OrderItems -> Product
            ->latest() // Urutkan dari pesanan terbaru
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
{
    // Security
    if ($order->user_id !== auth()->id()) {
        abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
    }

    // Load relasi
    $order->load(['items.product', 'items.product.primaryImage']);

    // 👉 GENERATE SNAP TOKEN JIKA PENDING & BELUM ADA
    if ($order->status === 'pending' && !$order->snap_token) {

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                // PENTING: order_id HARUS unik
                'order_id' => $order->order_number . '-' . time(),
                'gross_amount' => $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            $order->update([
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            abort(500, 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }

    return view('orders.show', compact('order'));
}


    /**
     * Menampilkan halaman status pembayaran sukses.
     */
    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
        return view('orders.success', compact('order'));
    }

    /**
     * Menampilkan halaman status pembayaran pending.
     */
    public function pending(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
        return view('orders.pending', compact('order'));
    }
}
