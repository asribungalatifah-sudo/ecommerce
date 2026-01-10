@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
    body {
        background: #F7F5F3;
    }

    /* ===== CARD STATS ===== */
    .pastel-card {
        background: linear-gradient(135deg, #EDE7E3, #E5E5E5);
        border-radius: 1.2rem;
        transition: all .3s ease;
    }

    .pastel-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(46,46,46,.12);
    }

    .icon-wrap {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: rgba(255,255,255,.85);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ===== SECTION CARD ===== */
    .section-card {
        border-radius: 1.2rem;
        background: #FAFAFA;
    }

    /* ===== TEXT ===== */
    h4, h5 {
        color: #2E2E2E;
    }

    small {
        color: #6B6B6B;
    }

    /* ===== BADGE ===== */
    .badge-status {
        background: #F1DADA;
        color: #7A2E2E;
        font-weight: 600;
    }

    /* ===== LINK ===== */
    a {
        color: #8B6B5E;
    }

    a:hover {
        color: #C97A7A;
    }
</style>

{{-- ===================== STATS ===================== --}}
<div class="row g-4 mb-4">

    {{-- Total Pendapatan --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card pastel-card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="fw-semibold text-uppercase">Total Pendapatan</small>
                    <h4 class="fw-bold mt-1" style="color:#8B6B5E">
                        Rp {{ number_format($stats['total_revenue'],0,',','.') }}
                    </h4>
                </div>
                <div class="icon-wrap">
                    <i class="bi bi-wallet2 fs-3" style="color:#C97A7A"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Perlu Diproses --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card pastel-card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="fw-semibold text-uppercase">Perlu Diproses</small>
                    <h4 class="fw-bold mt-1" style="color:#2E2E2E">
                        {{ $stats['pending_orders'] }}
                    </h4>
                </div>
                <div class="icon-wrap">
                    <i class="bi bi-box-seam fs-3" style="color:#8B6B5E"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Stok Menipis --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card pastel-card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="fw-semibold text-uppercase">Stok Menipis</small>
                    <h4 class="fw-bold mt-1" style="color:#7A2E2E">
                        {{ $stats['low_stock'] }}
                    </h4>
                </div>
                <div class="icon-wrap">
                    <i class="bi bi-exclamation-triangle fs-3" style="color:#C97A7A"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Produk --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card pastel-card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="fw-semibold text-uppercase">Total Produk</small>
                    <h4 class="fw-bold mt-1" style="color:#2E2E2E">
                        {{ $stats['total_products'] }}
                    </h4>
                </div>
                <div class="icon-wrap">
                    <i class="bi bi-tags fs-3" style="color:#8B6B5E"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ===================== CHART & ORDERS ===================== --}}
<div class="row g-4">

    {{-- Revenue Chart --}}
    <div class="col-lg-8">
        <div class="card section-card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0">
                <h5 class="fw-bold">Grafik Penjualan (7 Hari)</h5>
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
                <h5 class="fw-bold">Pesanan Terbaru</h5>
            </div>

            <div class="list-group list-group-flush">
                @foreach($recentOrders as $order)
                    <div class="list-group-item border-0 d-flex justify-content-between">
                        <div>
                            <strong>#{{ $order->order_number }}</strong><br>
                            <small>{{ $order->user->name }}</small>
                        </div>
                        <div class="text-end">
                            <strong>
                                Rp {{ number_format($order->total_amount,0,',','.') }}
                            </strong><br>
                            <span class="badge rounded-pill badge-status">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card-footer bg-transparent border-0 text-center">
                <a href="{{ route('admin.orders.index') }}" class="fw-bold text-decoration-none">
                    Lihat Semua Pesanan →
                </a>
            </div>
        </div>
    </div>

</div>

{{-- ===================== CHART SCRIPT ===================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueChart->pluck('date')) !!},
            datasets: [{
                data: {!! json_encode($revenueChart->pluck('total')) !!},
                borderColor: '#8B6B5E',
                backgroundColor: 'rgba(201,122,122,0.25)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#2E2E2E'
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
