{{-- ===================== SIDEBAR ===================== --}}
<style>
    /* ===== SIDEBAR BACKGROUND ===== */
    .left-sidebar {
        background: linear-gradient(180deg, #FFE4F2, #FFF7CC);
        box-shadow: 4px 0 20px rgba(0,0,0,.06);
    }

    /* ===== LOGO ===== */
    .brand-logo {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid rgba(0,0,0,.05);
    }

    /* ===== NAV TITLE ===== */
    .nav-small-cap {
        color: #D63384;
        font-weight: 600;
        letter-spacing: .04em;
    }

    /* ===== SIDEBAR LINK ===== */
    .sidebar-link {
        border-radius: 999px;
        margin: 6px 14px;
        padding: 10px 18px;
        color: #5A4A4A;
        transition: all .25s ease;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sidebar-link i {
        font-size: 1.2rem;
        color: #F59E0B;
    }

    .sidebar-link:hover {
        background: linear-gradient(135deg, #FFD6E8, #FFF1B8);
        color: #D63384;
        box-shadow: 0 8px 18px rgba(255,158,207,.35);
    }

    /* ===== ACTIVE MENU ===== */
    .sidebar-item.active .sidebar-link {
        background: linear-gradient(135deg, #FF9ECF, #FFE08A);
        color: #fff;
        box-shadow: 0 10px 25px rgba(255,158,207,.45);
    }

    .sidebar-item.active .sidebar-link i {
        color: #fff;
    }

    /* ===== CLOSE BUTTON ===== */
    .close-btn i {
        color: #D63384;
    }

    /* ===== UPGRADE CARD ===== */
    .unlimited-access {
        background: linear-gradient(135deg, #FFF1B8, #FFD6E8);
        border-radius: 1.2rem;
        box-shadow: 0 10px 25px rgba(0,0,0,.08);
        padding: 1.2rem;
    }

    .unlimited-access h6 {
        color: #D63384;
    }

    .unlimited-access .btn {
        background: linear-gradient(135deg, #FF9ECF, #FBBF24);
        border: none;
        border-radius: 999px;
        color: #fff;
    }

    .unlimited-access .btn:hover {
        opacity: .9;
    }
</style>

<aside class="left-sidebar">
    <div>

        {{-- LOGO --}}
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/admin/dashboard" class="text-nowrap logo-img">
                <img src="../assets/images/logos/dark-logo.svg" width="160" alt="Logo">
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-7"></i>
            </div>
        </div>

        {{-- NAV --}}
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">

                <li class="nav-small-cap mt-3">
                    <i class="ti ti-dots fs-4"></i>
                    <span class="hide-menu ms-2">Admin Menu</span>
                </li>

                <li class="sidebar-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/admin/dashboard">
                        <i class="ti ti-layout-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/admin/categories">
                        <i class="ti ti-category"></i>
                        <span class="hide-menu">Kategori</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('admin/products*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/admin/products">
                        <i class="ti ti-package"></i>
                        <span class="hide-menu">Produk</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('admin/orders*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/admin/orders">
                        <i class="ti ti-receipt"></i>
                        <span class="hide-menu">Pesanan</span>
                    </a>
                </li>

            </ul>

        </nav>
    </div>
</aside>
