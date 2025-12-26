@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="card shadow-sm">

                {{-- Header Order --}}
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="fw-bold mb-1">
                                Order #{{ $order->order_number }}
                            </h4>
                            <small class="text-muted">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </small>
                        </div>

                        {{-- Status --}}
                        @php
                            $statusClass = match($order->status) {
                                'pending' => 'warning',
                                'processing' => 'primary',
                                'shipped' => 'info',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                                default => 'secondary'
                            };
                        @endphp

                        <span class="badge bg-{{ $statusClass }} fs-6">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>

                {{-- Items --}}
                <div class="card-body">
                    <h5 class="fw-semibold mb-3">Produk yang Dipesan</h5>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                @if($order->shipping_cost > 0)
                                <tr>
                                    <td colspan="3" class="text-end">Ongkos Kirim</td>
                                    <td class="text-end">
                                        Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endif
                                <tr class="fw-bold fs-5">
                                    <td colspan="3" class="text-end">TOTAL BAYAR</td>
                                    <td class="text-end text-primary">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="card-body bg-light border-top">
                    <h5 class="fw-semibold mb-2">Alamat Pengiriman</h5>
                    <p class="mb-1 fw-medium">{{ $order->shipping_name }}</p>
                    <p class="mb-1">{{ $order->shipping_phone }}</p>
                    <p class="mb-0">{{ $order->shipping_address }}</p>
                </div>

                {{-- Tombol Bayar --}}
                @if($order->status === 'pending' && $snapToken)
                <div class="card-footer bg-white text-center">
                    <p class="text-muted mb-3">
                        Selesaikan pembayaran Anda untuk memproses pesanan.
                    </p>
                    <button id="pay-button" class="btn btn-primary btn-lg px-5">
                        💳 Bayar Sekarang
                    </button>
                </div>
                @endif

            </div>

        </div>
    </div>
</div>
@endsection

{{-- Midtrans Snap --}}
@if($snapToken)
@push('scripts')
<script src="{{ config('midtrans.snap_url') }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const payButton = document.getElementById('pay-button');

    if (!payButton) return;

    payButton.addEventListener('click', function () {
        payButton.disabled = true;
        payButton.innerText = 'Memproses...';

        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function () {
                window.location.href = '{{ route("orders.success", $order) }}';
            },
            onPending: function () {
                window.location.href = '{{ route("orders.pending", $order) }}';
            },
            onError: function () {
                alert('Pembayaran gagal. Silakan coba lagi.');
                payButton.disabled = false;
                payButton.innerText = '💳 Bayar Sekarang';
            },
            onClose: function () {
                payButton.disabled = false;
                payButton.innerText = '💳 Bayar Sekarang';
            }
        });
    });
});
</script>
@endpush
@endif
