{{-- ================================================
FILE: resources/views/home.blade.php
FUNGSI: Halaman utama website
HERO: Foto tembus panjang + teks overlay
================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="hero-banner">

    {{-- FOTO BACKGROUND TEMBUS PANJANG --}}
    <img src="{{ asset('assets/images/2.png') }}" alt="Belanja Online">

    {{-- OVERLAY COKLAT --}}
    <div class="hero-overlay"></div>

    {{-- TEKS MENIMPA FOTO --}}
    <div class="container hero-content">
        <h1>Belanja Online Mudah & Terpercaya</h1>
        <p>
            Temukan berbagai produk berkualitas dengan harga terbaik.
            Gratis ongkir untuk pembelian pertama!
        </p>
        <a href="{{ route('catalog.index') }}" class="hero-btn">
            <i class="bi bi-bag me-2"></i>Mulai Belanja
        </a>
    </div>

</section>

{{-- ================= KATEGORI ================= --}}
<section class="py-5" style="background:#f3f1ee;">
    <div class="container">
        <h2 class="text-center mb-4" style="color:#3b2f2f;">
            Kategori Populer
        </h2>

        <div class="row g-4">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                       class="text-decoration-none">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body">
                                <img src="{{ $category->image_url }}"
                                     alt="{{ $category->name }}"
                                     class="rounded-circle mb-3"
                                     width="80" height="80"
                                     style="object-fit:cover;">
                                <h6 class="mb-1" style="color:#3b2f2f;">
                                    {{ $category->name }}
                                </h6>
                                <small style="color:#7a6f6f;">
                                    {{ $category->products_count }} produk
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PRODUK UNGGULAN ================= --}}
<section class="py-5" style="background:#e9e6e1;">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0" style="color:#3b2f2f;">
                Produk Unggulan
            </h2>
            <a href="{{ route('catalog.index') }}"
               class="btn btn-sm"
               style="border:1px solid #8b5e3c;color:#8b5e3c;">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ================= PROMO ================= --}}
<section class="py-5" style="background:#f3f1ee;">
    <div class="container">
        <div class="row g-4">

            {{-- FLASH SALE --}}
            <div class="col-md-6">
                <div class="card border-0 h-100"
                     style="background:#d8a7a7;color:#3b2f2f;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h3 class="fw-bold">Flash Sale!</h3>
                        <p>Diskon hingga 50% untuk produk pilihan</p>
                        <a href="{{ route('catalog.index') }}"
                           class="btn btn-sm"
                           style="background:#3b2f2f;color:#fff;width:fit-content;">
                            Lihat Promo
                        </a>
                    </div>
                </div>
            </div>

            {{-- MEMBER BARU --}}
            <div class="col-md-6">
                <div class="card border-0 h-100"
                     style="background:#b9b0aa;color:#2f2f2f;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h3 class="fw-bold">Member Baru?</h3>
                        <p>Dapatkan voucher Rp 50.000 untuk pembelian pertama</p>
                        <a href="{{ route('register') }}"
                           class="btn btn-sm"
                           style="background:#8b5e3c;color:#fff;width:fit-content;">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ================= PRODUK TERBARU ================= --}}
<section class="py-5" style="background:#ffffff;">
    <div class="container">
        <h2 class="text-center mb-4" style="color:#3b2f2f;">
            Produk Terbaru
        </h2>

        <div class="row g-4">
            @foreach($latestProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
