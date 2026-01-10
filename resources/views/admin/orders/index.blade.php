@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')

<style>
    /* ===============================
       PALET WARNA (PASTEL ELEGAN)
       =============================== */
    :root {
        --brown: #8D6E63;
        --brown-soft: #BCAAA4;

        --gray: #EDEDED;
        --gray-soft: #F5F5F5;

        --red-pastel: #E6B0AA;
        --red-soft: #F2D7D5;

        --black-soft: #3E3A39;
    }

    /* ===== PAGE TITLE ===== */
    .page-title {
        color: var(--black-soft);
        font-weight: 700;
    }

    /* ===== CARD ===== */
    .card {
        border-radius: 1rem;
        background: var(--gray-soft);
    }

    /* ===== NAV PILLS ===== */
    .nav-pills .nav-link {
        border-radius: 999px;
        padding: .4rem 1rem;
        color: var(--black-soft);
        margin-right: .4rem;
        font-weight: 500;
    }

    .nav-pills .nav-link:hover {
        background: var(--gray);
    }

    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, var(--brown), var(--red-pastel));
        color: #fff;
        box-shadow: 0 6px 16px rgba(141,110,99,.35);
    }

    /* ===== TABLE ===== */
    .table thead {
        background: var(--gray);
    }

    .table thead th {
        color: var(--black-soft);
        font-weight: 600;
    }

    .table-hover tbody tr:hover {
        background: #F0ECEB;
    }

    /* ===== ORDER NUMBER ===== */
    .order-number {
        color: var(--brown);
        font-weight: 700;
    }

    /* ===== BADGE STATUS ===== */
    .badge {
        padding: .45em .8em;
        border-radius: 999px;
        font-weight: 600;
        font-size: .75rem;
    }

    .badge-pending {
        background: var(--gray);
        color: var(--black-soft);
    }

    .badge-processing {
        background: var(--brown-soft);
        color: var(--black-soft);
    }

    .badge-shipped {
        background: var(--brown);
        color: #fff;
    }

    .badge-delivered {
        background: #C8E6C9;
        color: #2E7D32;
    }

    .badge-cancelled {
        background: var(--red-soft);
        color: #7B241C;
    }

    /* ===== BUTTON ===== */
    .btn-outline-brown {
        border: 1px solid var(--brown);
        color: var(--black-soft);
        border-radius: 999px;
        padding: .35rem .9rem;
    }

    .btn-outline-brown:hover {
        background: linear-gradient(135deg, var(--brown), var(--red-pastel));
        color: #fff;
        border-color: transparent;
    }

    /* ===== PAGINATION (PANAH KECIL & SOFT) ===== */
    .pagination {
        justify-content: center;
    }

    .pagination .page-link {
        border-radius: 999px;
        padding: .35rem .7rem;
        font-size: .85rem;
        color: var(--black-soft);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--brown), var(--red-pastel));
        border-color: transparent;
        color: #fff;
    }

    .pagination svg {
        width: 14px !important;
        height: 14px !important;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 page-title">Daftar Pesanan</h2>
</div>

<div class="card shadow-sm border-0">

    {{-- FILTER STATUS --}}
    <div class="card-header bg-transparent py-3">
        <ul class="nav nav-pills card-header-pills">
            @foreach ([
                '' => 'Semua',
                'pending' => 'Pending',
                'processing' => 'Diproses',
                'shipped' => 'Dikirim',
                'delivered' => 'Sampai',
                'cancelled' => 'Batal'
            ] as $key => $label)
            <li class="nav-item">
                <a class="nav-link {{ request('status') == $key || (!$key && !request('status')) ? 'active' : '' }}"
                   href="{{ route('admin.orders.index', $key ? ['status' => $key] : []) }}">
                    {{ $label }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    {{-- TABLE --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No. Order</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4 order-number">
                            #{{ $order->order_number }}
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $order->user->name }}</div>
                            <small class="text-muted">{{ $order->user->email }}</small>
                        </td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="fw-semibold">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>
                        <td>
                            <span class="badge badge-{{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="btn btn-sm btn-outline-brown">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            Tidak ada pesanan ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer bg-transparent">
        {{ $orders->links() }}
    </div>
</div>

@endsection
