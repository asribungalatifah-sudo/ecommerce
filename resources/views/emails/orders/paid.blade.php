<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Diterima</title>
</head>
<body style="margin:0;padding:0;background-color:#f8f9fa;">
<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8f9fa;padding:20px;">
    <tr>
        <td align="center">
            <!-- Container -->
            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;padding:24px;font-family:Arial,sans-serif;color:#212529;">

                <!-- Header -->
                <tr>
                    <td>
                        <h2 style="margin:0 0 16px 0;font-size:24px;">
                            Halo, {{ $order->user->name }}
                        </h2>
                        <p style="margin:0 0 16px 0;font-size:15px;">
                            Terima kasih! Pembayaran untuk pesanan
                            <strong>#{{ $order->order_number }}</strong> telah kami terima.
                            Kami sedang memproses pesanan Anda.
                        </p>
                    </td>
                </tr>

                <!-- Table -->
                <tr>
                    <td style="padding-top:16px;">
                        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
                            <thead>
                                <tr style="background:#f1f3f5;">
                                    <th align="left" style="border:1px solid #dee2e6;">Produk</th>
                                    <th align="center" style="border:1px solid #dee2e6;">Qty</th>
                                    <th align="right" style="border:1px solid #dee2e6;">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td style="border:1px solid #dee2e6;">
                                        {{ $item->product_name }}
                                    </td>
                                    <td align="center" style="border:1px solid #dee2e6;">
                                        {{ $item->quantity }}
                                    </td>
                                    <td align="right" style="border:1px solid #dee2e6;">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                                <tr style="font-weight:bold;background:#f8f9fa;">
                                    <td style="border:1px solid #dee2e6;">Total</td>
                                    <td style="border:1px solid #dee2e6;"></td>
                                    <td align="right" style="border:1px solid #dee2e6;">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <!-- Button -->
                <tr>
                    <td align="center" style="padding:24px 0;">
                        <a href="{{ route('orders.show', $order) }}"
                           style="
                                background:#0d6efd;
                                color:#ffffff;
                                text-decoration:none;
                                padding:12px 24px;
                                border-radius:6px;
                                display:inline-block;
                                font-weight:bold;
                           ">
                            Lihat Detail Pesanan
                        </a>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="font-size:13px;color:#6c757d;">
                        <p style="margin:0 0 8px 0;">
                            Jika ada pertanyaan, silakan balas email ini.
                        </p>
                        <p style="margin:0;">
                            Salam,<br>
                            <strong>{{ config('app.name') }}</strong>
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
