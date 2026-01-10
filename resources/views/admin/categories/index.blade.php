@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@push('styles')
<style>
    :root {
        --brown: #8D6E63;
        --brown-soft: #BCAAA4;
        --gray: #EDEDED;
        --gray-soft: #F7F6F5;
        --red-pastel: #E6B0AA;
        --black-soft: #3E3A39;
    }

    .bi {
        font-family: bootstrap-icons !important;
    }

    .card {
        border-radius: 1rem;
        background: var(--gray-soft);
    }

    .card-header {
        background: linear-gradient(135deg, var(--brown), var(--red-pastel));
        color: #fff;
        border-radius: 1rem 1rem 0 0;
    }

    .table thead {
        background: var(--gray);
    }

    .table-hover tbody tr:hover {
        background: #F0ECEB;
    }

    .badge-products {
        background: var(--brown-soft);
        color: var(--black-soft);
    }

    .badge-active {
        background: #C8E6C9;
        color: #2E7D32;
    }

    .badge-inactive {
        background: var(--gray);
        color: #616161;
    }

    .btn-outline-brown {
        border: 1px solid var(--brown);
        color: var(--black-soft);
        border-radius: 999px;
    }

    .btn-outline-brown:hover {
        background: linear-gradient(135deg, var(--brown), var(--red-pastel));
        color: #fff;
        border-color: transparent;
    }

    .pagination {
        justify-content: center;
        gap: 6px;
    }

    .pagination svg {
        width: 14px !important;
        height: 14px !important;
    }

    .pagination .page-link {
        border-radius: 999px;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--brown), var(--red-pastel));
        border-color: transparent;
        color: #fff;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">

        <div class="card shadow-sm border-0 mb-4">

            {{-- HEADER --}}
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-mortarboard me-2"></i>
                        Manajemen Kategori Jurusan SMK
                    </h5>
                    <small class="opacity-75">Perlengkapan sesuai jurusan</small>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Jurusan</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)

                        @php
                            $icons = [
                                'rpl' => 'bi-code-slash',
                                'tkj' => 'bi-router',
                                'tkr' => 'bi-car-front',
                                'tsm' => 'bi-bicycle',
                                'otkp' => 'bi-journal-text',
                                'bdp' => 'bi-shop',
                                'akl' => 'bi-calculator',
                                'mm'  => 'bi-camera-video',
                                'multimedia' => 'bi-camera-video',
                            ];

                            $icon = $icons[strtolower($category->slug)] ?? 'bi-box-seam';
                        @endphp

                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                                             style="width:44px;height:44px">
                                            <i class="bi {{ $icon }} fs-5 text-muted"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $category->name }}</div>
                                            <small class="text-muted">{{ $category->slug }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <span class="badge badge-products px-3 py-2">
                                        {{ $category->products_count }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    @if($category->is_active)
                                        <span class="badge badge-active px-3 py-2">Aktif</span>
                                    @else
                                        <span class="badge badge-inactive px-3 py-2">Nonaktif</span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-brown">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x fs-3 d-block mb-2"></i>
                                    Belum ada kategori jurusan
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PAGINATION --}}
            <div class="card-footer bg-transparent">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
