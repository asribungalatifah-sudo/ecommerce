@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
    .pastel-card {
        background: linear-gradient(135deg, #FFF7CC, #FFD6E8);
        border-radius: 1rem;
        transition: all .3s ease;
    }
    .pastel-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(0,0,0,.08);
    }
    .icon-wrap {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255,255,255,.7);
    }
    .section-card {
        border-radius: 1rem;
        overflow: hidden;
    }
</style>

{{-- ===================== STATS ===================== --}}
<div class="row g-4 mb-4">

    {{-- Total Pendapatan --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card pastel-card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted fw-semibold text-uppercase">Total Pendapatan</small>
                    <h4 class="fw-bold mt-1" style="color:#D63384">
                        Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                    </h4>
                </div>
                <div class="icon-wrap">
                    <i class="bi bi-wallet2 fs-3" style="color:#FF9ECF"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Perlu Diproses --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card pastel-card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted fw-semibold text-uppercase">Perlu Diproses</small>
                    <h4 class="fw-bold mt-1" style="color:#F59E0B">
                        {{ $stats['pending_orders'] }}
                    </h4>
                </div>
                <div class="icon-wrap">
                    <i class="bi bi-box-seam fs-3" style="color:#FBBF24"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Stok Menipis --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card pastel-card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted fw-semibold text-uppercase">Stok Menipis</small>
                    <h4 class="fw-bold mt-1" style="color:#E11D48">
                        {{ $stats['low_stock'] }}
                    </h4>
                </div>
                <div class="icon-wrap">
                    <i class="bi bi-exclamation-triangle fs-3" style="color:#FB7185"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Produk --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card pastel-card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted fw-semibold text-uppercase">Total Produk</small>
                    <h4 class="fw-bold mt-1" style="color:#7C3AED">
                        {{ $stats['total_products'] }}
                    </h4>
                </div>
                <div class="icon-wrap">
                    <i class="bi bi-tags fs-3" style="color:#C4B5FD"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ===================== CHART + ORDERS ===================== --}}
<div class="row g-4">

    {{-- Revenue Chart --}}
    <div class="col-lg-8">
        <div class="card section-card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0">
                <h5 class="fw-bold mb-0" style="color:#D63384">
                    Grafik Penjualan (7 Hari)
                </h5>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="110"></canvas>
            </div>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="col-lg-4">
        <div class="card section-card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0">
                <h5 class="fw-bold mb-0" style="color:#F59E0B">
                    Pesanan Terbaru
                </h5>
            </div>

            <div class="list-group list-group-flush">
                @foreach($recentOrders as $order)
                    <div class="list-group-item border-0 d-flex justify-content-between">
                        <div>
                            <strong class="text-dark">#{{ $order->order_number }}</strong><br>
                            <small class="text-muted">{{ $order->user->name }}</small>
                        </div>
                        <div class="text-end">
                            <strong>Rp {{ number_format($order->total_amount,0,',','.') }}</strong><br>
                            <span class="badge rounded-pill"
                                style="background:#FFD6E8;color:#D63384">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card-footer bg-transparent text-center border-0">
                <a href="{{ route('admin.orders.index') }}"
                   class="fw-bold text-decoration-none"
                   style="color:#FF9ECF">
                    Lihat Semua Pesanan →
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ===================== CHART SCRIPT ===================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueChart->pluck('date')) !!},
            datasets: [{
                data: {!! json_encode($revenueChart->pluck('total')) !!},
                borderColor: '#FF9ECF',
                backgroundColor: 'rgba(255,158,207,0.25)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#FFD6E8'
            }]
        },
        options: {
            plugins: { legend: { display: false }},
            scales: {
                y: {
                    ticks: {
                        callback: v => 'Rp ' + new Intl.NumberFormat('id-ID').format(v)
                    }
                }
            }
        }
    });
</script>

@endsection
