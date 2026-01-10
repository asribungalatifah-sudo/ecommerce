{{-- ===================== SIDEBAR ===================== --}}
<style>
    /* ===== SIDEBAR BASE ===== */
    .left-sidebar {
        background: linear-gradient(180deg, #ECE6E2, #E0E0E0);
        box-shadow: 4px 0 25px rgba(30,30,30,.08);
    }

    /* ===== LOGO ===== */
    .brand-logo {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid rgba(46,46,46,.08);
        background: rgba(255,255,255,.35);
    }

    /* ===== NAV TITLE ===== */
    .nav-small-cap {
        color: #6B4F45;
        font-weight: 600;
        letter-spacing: .05em;
        opacity: .85;
    }

    /* ===== SIDEBAR LINK ===== */
    .sidebar-link {
        border-radius: 999px;
        margin: 6px 14px;
        padding: 10px 18px;
        color: #2E2E2E;
        transition: all .25s ease;
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 500;
    }

    .sidebar-link i {
        font-size: 1.2rem;
        color: #6B4F45;
        transition: all .25s ease;
    }

    .sidebar-link:hover {
        background: linear-gradient(135deg, #D7CCC8, #EFEFEF);
        color: #7A2E2E;
        box-shadow: 0 8px 18px rgba(122,46,46,.25);
    }

    .sidebar-link:hover i {
        color: #7A2E2E;
    }

    /* ===== ACTIVE MENU ===== */
    .sidebar-item.active .sidebar-link {
        background: linear-gradient(135deg, #6B4F45, #A04A4A);
        color: #fff;
        box-shadow: 0 12px 28px rgba(107,79,69,.45);
    }

    .sidebar-item.active .sidebar-link i {
        color: #fff;
    }

    /* ===== CLOSE BUTTON ===== */
    .close-btn i {
        color: #6B4F45;
    }

    /* ===== SCROLLBAR ===== */
    .scroll-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .scroll-sidebar::-webkit-scrollbar-thumb {
        background: #BCAAA4;
        border-radius: 10px;
    }

    /* ===== UPGRADE CARD ===== */
    .unlimited-access {
        background: linear-gradient(135deg, #EDE6E2, #D7CCC8);
        border-radius: 1.2rem;
        box-shadow: 0 12px 30px rgba(30,30,30,.12);
        padding: 1.2rem;
    }

    .unlimited-access h6 {
        color: #4A342E;
    }

    .unlimited-access .btn {
        background: linear-gradient(135deg, #6B4F45, #A04A4A);
        border: none;
        border-radius: 999px;
        color: #fff;
        transition: all .25s ease;
    }

    .unlimited-access .btn:hover {
        background: linear-gradient(135deg, #4A342E, #7A2E2E);
        color: #fff;
    }
</style>

<aside class="left-sidebar">
    <div>

        {{-- LOGO --}}
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/admin/dashboard" class="text-nowrap logo-img">
                <img src="../assets/images/logos/dark-logo.svg" width="150" alt="Logo">
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-6"></i>
            </div>
        </div>

        {{-- NAV --}}
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">

                <li class="nav-small-cap mt-3">
                    <i class="ti ti-dots fs-4"></i>
                    <span class="hide-menu ms-2">ADMIN MENU</span>
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
