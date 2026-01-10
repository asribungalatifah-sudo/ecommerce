{{-- ================================================
     FILE: resources/views/partials/navbar.blade.php
     FUNGSI: Navigation bar untuk customer
     THEME: Coklat · Abu · Merah · Hitam Pastel
     ================================================ --}}

<style>
    /* ===== NAVBAR BASE ===== */
    .pastel-navbar {
        background: linear-gradient(135deg, #F0E9E6, #E4E2E1);
        border-bottom: 1px solid rgba(0,0,0,.06);
    }

    /* ===== BRAND ===== */
    .pastel-brand {
        color: #4A342E !important;
        font-weight: 700;
        letter-spacing: .3px;
    }

    .pastel-brand i {
        color: #8B3A3A;
    }

    /* ===== NAV LINK ===== */
    .navbar .nav-link {
        color: #2E2E2E;
        font-weight: 500;
        transition: all .25s ease;
    }

    .navbar .nav-link:hover {
        color: #8B3A3A;
    }

    /* ===== SEARCH ===== */
    .pastel-search input {
        border-radius: 999px 0 0 999px;
        border: 1px solid #D7CCC8;
        background: #FAF9F8;
    }

    .pastel-search input:focus {
        border-color: #8B3A3A;
        box-shadow: 0 0 0 .2rem rgba(139,58,58,.2);
    }

    .pastel-search button {
        border-radius: 0 999px 999px 0;
        border: 1px solid #D7CCC8;
        border-left: none;
        background: linear-gradient(135deg, #8B6F61, #A04A4A);
        color: #fff;
    }

    .pastel-search button:hover {
        background: linear-gradient(135deg, #6B4F45, #7A2E2E);
    }

    /* ===== ICON MENU ===== */
    .nav-icon i {
        font-size: 1.2rem;
        color: #4A342E;
        transition: all .25s ease;
    }

    .nav-icon:hover i {
        color: #8B3A3A;
        transform: scale(1.1);
    }

    /* ===== USER DROPDOWN ===== */
    .pastel-dropdown {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 15px 35px rgba(0,0,0,.15);
        padding: .5rem 0;
        background: #FAF9F8;
    }

    .pastel-dropdown .dropdown-item {
        font-weight: 500;
        color: #2E2E2E;
        border-radius: .6rem;
        margin: 2px 10px;
        transition: all .2s ease;
    }

    .pastel-dropdown .dropdown-item:hover {
        background: #EFE7E3;
        color: #8B3A3A;
    }

    /* ===== ADMIN LINK ===== */
    .dropdown-item.admin-link {
        color: #7A2E2E;
        font-weight: 700;
    }

    /* ===== BUTTON AUTH ===== */
    .btn-pastel {
        background: linear-gradient(135deg, #6B4F45, #A04A4A);
        color: #fff;
        border-radius: 999px;
        border: none;
        padding: 6px 16px;
    }

    .btn-pastel:hover {
        background: linear-gradient(135deg, #4A342E, #7A2E2E);
        color: #fff;
    }
</style>

<nav class="navbar navbar-expand-lg pastel-navbar shadow-sm sticky-top">
    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand pastel-brand" href="{{ route('home') }}">
            <i class="bi bi-bag-heart-fill me-2"></i>
            TokoOnline
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">

            {{-- Search --}}
            <form class="d-flex mx-auto my-3 my-lg-0 pastel-search"
                  style="max-width: 500px; width: 100%;"
                  action="{{ route('catalog.index') }}" method="GET">
                <div class="input-group">
                    <input type="text"
                           name="q"
                           class="form-control"
                           placeholder="Cari produk..."
                           value="{{ request('q') }}">
                    <button class="btn">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            {{-- Right Menu --}}
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link" href="{{ route('catalog.index') }}">
                        <i class="bi bi-grid me-1"></i> Katalog
                    </a>
                </li>

                @auth
                    {{-- Wishlist --}}
                    <li class="nav-item nav-icon">
                        <a class="nav-link" href="{{ route('wishlist.index') }}">
                            <i class="bi bi-heart"></i>
                        </a>
                    </li>

                    {{-- Cart --}}
                    <li class="nav-item nav-icon mx-3">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3"></i>
                        </a>
                    </li>

                    {{-- USER DROPDOWN --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                           href="#"
                           data-bs-toggle="dropdown">
                            <img src="{{ auth()->user()->avatar_url }}"
                                 class="rounded-circle me-2 border"
                                 width="36" height="36">
                            <span class="d-none d-lg-inline fw-medium">
                                {{ auth()->user()->name }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end pastel-dropdown">

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i> Profil Saya
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('orders.index') }}">
                                    <i class="bi bi-bag me-2"></i> Pesanan Saya
                                </a>
                            </li>

                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item admin-link"
                                       href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Admin Panel
                                    </a>
                                </li>
                            @endif

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">
                                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-pastel btn-sm ms-2"
                           href="{{ route('register') }}">
                            Daftar
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
