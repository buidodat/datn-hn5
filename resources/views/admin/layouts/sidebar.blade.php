<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ env('APP_URL') . '/theme/admin/' }}assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ env('APP_URL') . '/theme/admin/' }}assets/images/logo-dark.png" alt=""
                    height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ env('APP_URL') . '/theme/admin/' }}assets/images/logo-sm.png" alt=""
                    height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ env('APP_URL') . '/theme/admin/' }}assets/images/logo-light.png" alt=""
                    height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Thống Kê</span>
                    </a>

                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts-0" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLayouts-0">
                        <i class="ri-ancient-gate-fill"></i> <span data-key="t-layouts">Quản lý Thành Phố</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts-0">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.cities.index')}}" class="nav-link" data-key="t-horizontal">Danh sách</a>
                            </li>
                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.cities.create')}}" class="nav-link" data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCinemas" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarCinemas">
                        <i class=" ri-store-3-fill"></i> <span data-key="t-layouts">Quản lý Rạp</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCinemas">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.cinemas.index')}}" class="nav-link" data-key="t-horizontal">Danh
                                    sách</a>
                            </li>
                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.cinemas.create')}}" class="nav-link" data-key="t-horizontal">Thêm
                                    mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCombos" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarCombos">
                        <i class="ri-gift-2-line"></i> <span data-key="t-layouts">Quản lý Combo</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCombos">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.combos.index')}}" class="nav-link" data-key="t-horizontal">Danh
                                    sách</a>
                            </li>
                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.combos.create')}}" class="nav-link" data-key="t-horizontal">Thêm
                                    mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts-2" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLayouts-2">
                        <i class="ri-file-list-3-line"></i> <span data-key="t-layouts">Quản lý bài viết</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts-2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.posts.index') }}" class="nav-link" data-key="t-horizontal">Danh
                                    sách</a>
                            </li>
                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.posts.create') }}" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts-3" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLayouts-3">
                        <i class="ri-account-circle-line"></i> <span data-key="t-layouts">Liên hệ</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts-3">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.contacts.index') }}" class="nav-link" data-key="t-horizontal">Danh sách</a>
                            </li>
                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.contacts.create') }}" class="nav-link" data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts-4" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLayouts-4">
                        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Quản lý Thanh Toán</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts-4">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.payments.index')}}" class="nav-link" data-key="t-horizontal">Danh sách</a>
                            </li>
                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.payments.create')}}" class="nav-link" data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts-5" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarLayouts-5">
                        <i class="ri-slideshow-3-line"></i> <span data-key="t-layouts">Slideshows</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts-5">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.slideshows.list') }}" class="nav-link" data-key="t-horizontal">Danh
                                    sách</a>
                            </li>
                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.slideshows.create') }}" class="nav-link"
                                   data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMovie" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarMovie">
                        <i class="mdi mdi-movie-open-outline"></i> <span data-key="t-layouts">Phim</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMovie">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.movies.index') }}" class="nav-link" data-key="t-horizontal">Danh
                                    sách</a>
                            </li>
                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.movies.create') }}" class="nav-link"
                                   data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts-15" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarLayouts-15">
                        <i class=" ri-coupon-3-line "></i> <span data-key="t-layouts">Vouchers</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts-15">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.vouchers.list') }}" class="nav-link" data-key="t-horizontal">Danh
                                    sách</a>
                            </li>
                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.vouchers.create') }}" class="nav-link"
                                   data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
