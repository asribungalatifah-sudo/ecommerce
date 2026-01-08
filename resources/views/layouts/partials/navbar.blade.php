{{-- ===================== HEADER ===================== --}}
<style>
    /* ===== PASTEL THEME ===== */
    .pastel-header {
        background: linear-gradient(135deg, #FFE4F2, #FFF3C4);
        border-bottom: 1px solid rgba(0,0,0,.05);
    }

    .nav-icon-hover i {
        font-size: 1.3rem;
        color: #D63384;
        transition: all .3s ease;
    }

    .nav-icon-hover:hover i {
        color: #FF9ECF;
        transform: scale(1.1);
    }

    /* Notification */
    .notification-dot {
        position: absolute;
        top: 6px;
        right: 6px;
        width: 8px;
        height: 8px;
        background: #FF9ECF;
        border-radius: 50%;
        box-shadow: 0 0 0 3px rgba(255,158,207,.3);
    }

    /* Search */
    .pastel-input {
        border-radius: 999px;
        border: 1px solid #FFD6E8;
        padding-left: 14px;
    }

    .pastel-input:focus {
        border-color: #FF9ECF;
        box-shadow: 0 0 0 .2rem rgba(255,158,207,.25);
    }

    .btn-pastel {
        background: linear-gradient(135deg, #FF9ECF, #FFD6E8);
        color: #fff;
        border-radius: 999px;
        border: none;
        padding: 4px 14px;
    }

    .btn-pastel:hover {
        background: linear-gradient(135deg, #F472B6, #FFB703);
    }

    /* Avatar */
    .pastel-avatar {
        border: 2px solid #FFB703;
        transition: all .3s ease;
    }

    .pastel-avatar:hover {
        transform: scale(1.05);
    }

    /* Dropdown */
    .pastel-dropdown {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 15px 35px rgba(0,0,0,.12);
        padding: .5rem 0;
    }

    .pastel-dropdown .dropdown-item {
        border-radius: .6rem;
        margin: 2px 10px;
        font-weight: 500;
        transition: all .2s ease;
    }

    .pastel-dropdown .dropdown-item:hover {
        background: #FFE4F2;
        color: #D63384;
    }

    /* Logout */
    .btn-outline-pastel {
        border-radius: 999px;
        border: 1px solid #FF9ECF;
        color: #D63384;
    }

    .btn-outline-pastel:hover {
        background: #FF9ECF;
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

            <li class="nav-item position-relative">
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
