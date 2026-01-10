{{-- ===================== HEADER ===================== --}}
<style>
    /* ===== HEADER BASE ===== */
    .pastel-header {
        background: linear-gradient(135deg, #EDE6E2, #E3E3E3);
        border-bottom: 1px solid rgba(46,46,46,.08);
    }

    /* ===== ICON ===== */
    .nav-icon-hover {
        position: relative;
    }

    .nav-icon-hover i {
        font-size: 1.3rem;
        color: #6B4F45; /* coklat gelap */
        transition: all .25s ease;
    }

    .nav-icon-hover:hover i {
        color: #A04A4A; /* merah pastel */
        transform: scale(1.08);
    }

    /* ===== NOTIFICATION DOT ===== */
    .notification-dot {
        position: absolute;
        top: 6px;
        right: 6px;
        width: 8px;
        height: 8px;
        background: #A04A4A;
        border-radius: 50%;
        box-shadow: 0 0 0 3px rgba(160,74,74,.35);
    }

    /* ===== SEARCH ===== */
    .pastel-input {
        border-radius: 999px;
        border: 1px solid #CFC6C1;
        padding-left: 14px;
        background: #FAF9F8;
        color: #2E2E2E;
    }

    .pastel-input::placeholder {
        color: #8A8A8A;
    }

    .pastel-input:focus {
        border-color: #6B4F45;
        box-shadow: 0 0 0 .2rem rgba(107,79,69,.25);
    }

    .btn-pastel {
        background: linear-gradient(135deg, #6B4F45, #A04A4A);
        color: #fff;
        border-radius: 999px;
        border: none;
        padding: 4px 14px;
        transition: all .25s ease;
    }

    .btn-pastel:hover {
        background: linear-gradient(135deg, #4A342E, #7A2E2E);
        color: #fff;
    }

    /* ===== AVATAR ===== */
    .pastel-avatar {
        border: 2px solid #A04A4A;
        transition: all .3s ease;
    }

    .pastel-avatar:hover {
        transform: scale(1.05);
        border-color: #6B4F45;
    }

    /* ===== DROPDOWN ===== */
    .pastel-dropdown {
        border-radius: 1.1rem;
        border: none;
        box-shadow: 0 18px 40px rgba(46,46,46,.18);
        padding: .5rem 0;
        background: #FAFAFA;
    }

    .pastel-dropdown .dropdown-item {
        border-radius: .6rem;
        margin: 2px 10px;
        font-weight: 500;
        color: #2E2E2E;
        transition: all .2s ease;
    }

    .pastel-dropdown .dropdown-item i {
        color: #6B4F45;
    }

    .pastel-dropdown .dropdown-item:hover {
        background: #EFE7E3;
        color: #7A2E2E;
    }

    /* ===== LOGOUT ===== */
    .btn-outline-pastel {
        border-radius: 999px;
        border: 1px solid #7A2E2E;
        color: #7A2E2E;
        background: transparent;
        transition: all .25s ease;
    }

    .btn-outline-pastel:hover {
        background: #7A2E2E;
        color: #fff;
    }
</style>

<header class="app-header pastel-header">
    <nav class="navbar navbar-expand-lg navbar-light px-3">

        {{-- LEFT --}}
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                    <i class="ti ti-bell-ringing"></i>
                    <span class="notification-dot"></span>
                </a>
            </li>
        </ul>

        {{-- RIGHT --}}
        <div class="navbar-collapse justify-content-end">
            <ul class="navbar-nav flex-row align-items-center gap-3">

                {{-- Search --}}
                <form action="{{ route('catalog.index') }}" method="GET" class="d-flex">
                    <input type="text"
                           name="q"
                           class="form-control form-control-sm pastel-input"
                           placeholder="Search..."
                           value="{{ request('q') }}">
                    <button class="btn btn-pastel ms-2">
                        <i class="ti ti-search"></i>
                    </button>
                </form>

                {{-- Profile --}}
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="#" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/images/profile/2.jpeg') }}"
                             width="36" height="36"
                             class="rounded-circle pastel-avatar">
                    </a>

                    <div class="dropdown-menu dropdown-menu-end pastel-dropdown">
                        <a href="{{ route('profile.edit') }}"
                           class="dropdown-item d-flex align-items-center gap-2">
                            <i class="ti ti-user"></i> My Profile
                        </a>

                        <a href="#" class="dropdown-item d-flex align-items-center gap-2">
                            <i class="ti ti-mail"></i> My Account
                        </a>

                        <a href="#" class="dropdown-item d-flex align-items-center gap-2">
                            <i class="ti ti-list-check"></i> My Task
                        </a>

                        <div class="px-3 pt-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-pastel w-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>
