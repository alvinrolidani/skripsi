<div class="container-fluid">
    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="container-fluid">
                    <div class="float-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (auth()->user()->image)
                                    <img class="rounded-circle header-profile-user"
                                        src="{{ asset('storage/' . auth()->user()->image) }}" alt="Header Avatar">
                                @else
                                    <img class="rounded-circle header-profile-user"
                                        src="/templates/layouts/assets/images/user/default.png" alt="Header Avatar">
                                @endif

                                <span class="d-none d-xl-inline-block ms-1">{{ ucwords(auth()->user()->name) }}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('profil') }}"><i
                                        class="bx bx-user font-size-16 align-middle me-1"></i>
                                    Profile</a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                        class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                                    Logout</a>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <i class="mdi mdi-settings-outline"></i>
                            </button>
                        </div>

                    </div>
                    <div>
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="/" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="/templates/layouts/assets/images/logo-sm.png" alt=""
                                        height="20">
                                </span>
                                <span class="logo-lg">
                                    <img src="/templates/layouts/assets/images/logo-dark.png" alt=""
                                        height="17">
                                </span>
                            </a>

                            <a href="/" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="/templates/layouts/assets/images/logo-sm.png" alt=""
                                        height="20">
                                </span>
                                <span class="logo-lg">
                                    <img src="/templates/layouts/assets/images/logo-light.png" alt=""
                                        height="19">
                                </span>
                            </a>
                        </div>
                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                            id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                    </div>
                </div>
            </div>
        </header>
