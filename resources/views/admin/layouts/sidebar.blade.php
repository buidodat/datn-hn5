<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="#" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('theme/client/images/header/logo6.svg') }}" alt="" width="187px" height="40px">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('theme/client/images/header/logo6.svg') }}" alt="" width="187px"
                    height="40px">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="#" class="logo logo-light mt-3">
            <span class="logo-sm">
                <img src="{{ asset('theme/client/images/header/logo6.svg') }}" alt="" width="187px"
                    height="40px">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('theme/client/images/header/logo6.svg') }}" alt="" width="187px"
                    height="40px">
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

                {{-- Thống kê --}}
                <li class="nav-item">
                    <a href="/admin" class="nav-link" data-key="t-horizontal"> <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Thống Kê</span></a>
                </li>

                {{-- Quản lí chi nhánh --}}
                <li class="nav-item">
                    <a href="{{ route('admin.branches.index') }}" class="nav-link" data-key="t-horizontal"><i
                            class="ri-ancient-gate-fill"></i><span data-key="t-layouts">Quản lý chi nhánh</span></a>
                </li>

                {{-- Quản lí Rạp --}}
                <li class="nav-item">
                    <a href="{{ route('admin.cinemas.index') }}" class="nav-link" data-key="t-horizontal"> <i
                            class=" ri-store-3-fill"></i> <span data-key="t-layouts">Quản lý Rạp</span></a>
                </li>

                {{-- Quản lí Loại phòng --}}
                <li class="nav-item">
                    <a href="{{ route('admin.type-rooms.index') }}" class="nav-link" data-key="t-horizontal"><i
                            class=" ri-layout-grid-line"></i> <span data-key="t-layouts">Quản lý Loại
                            phòng</span></a>
                </li>

                {{-- Quản lí Phòng --}}
                <li class="nav-item">
                    <a href="{{ route('admin.rooms.index') }}" class="nav-link" data-key="t-horizontal"> <i
                            class=" ri-tv-line"></i> <span data-key="t-layouts">Quản lý Phòng</span></a>
                </li>

                {{-- Quản lí Phim --}}
                <li class="nav-item">
                    <a href="{{ route('admin.movies.index') }}" class="nav-link" data-key="t-horizontal"><i
                            class="mdi mdi-movie-open-outline"></i> <span data-key="t-layouts">Quản lý
                            Phim</span></a>
                </li>

                {{-- Quản lí Suất chiếu --}}
                <li class="nav-item">
                    <a href="{{ route('admin.showtimes.index') }}" class="nav-link" data-key="t-horizontal"><i
                            class=" ri-slideshow-3-fill"></i> <span data-key="t-layouts">Quản lý Suất
                            chiếu</span></a>
                </li>

                {{-- Quản lí thanh toán --}}
                <li class="nav-item">
                    <a href="{{ route('admin.payments.index') }}" class="nav-link" data-key="t-horizontal"><i
                            class="ri-layout-3-line"></i> <span data-key="t-layouts">Quản lý Thanh Toán</span></a>
                </li>

                {{-- Vouchers --}}
                <li class="nav-item">
                    <a href="{{ route('admin.vouchers.index') }}" class="nav-link" data-key="t-horizontal"><i
                            class=" ri-coupon-3-line "></i> <span data-key="t-layouts">Vouchers</span></a>
                </li>

                {{-- Quản lí bài viết --}}
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link" data-key="t-horizontal"><i
                            class="ri-file-list-3-line"></i> <span data-key="t-layouts">Quản lý bài
                            viết</span></a>
                </li>

                {{-- Quản lí đồ ăn --}}
                <li class="nav-item">
                    <a href="{{ route('admin.food.index') }}" class="nav-link" data-key="t-horizontal"><i
                            class="ri-cake-3-fill"></i> <span data-key="t-layouts">Quản lý Đồ Ăn</span></a>
                </li>

                {{-- Quản lí Combo --}}
                <li class="nav-item">
                    <a href="{{ route('admin.combos.index') }}" class="nav-link" data-key="t-horizontal"> <i
                            class="ri-shopping-basket-2-line"></i> <span data-key="t-layouts">Quản lý
                            Combo</span></a>
                </li>

                {{-- Quản lí Slideshows --}}
                <li class="nav-item">
                    <a href="{{ route('admin.slideshows.index') }}" class="nav-link" data-key="t-horizontal"> <i
                            class="ri-slideshow-3-line"></i> <span data-key="t-layouts">Slideshows</span></a>
                </li>

                {{-- Quản lí Liên hệ --}}
                <li class="nav-item">
                    <a href="{{ route('admin.contacts.index') }}" class="nav-link" data-key="t-horizontal"><i
                            class="ri-contacts-book-2-line"></i> <span data-key="t-layouts">Liên hệ</span></a>
                </li>

                {{-- Quản lí loại ghế --}}
                <li class="nav-item">
                    <a href="{{ route('admin.type_seats.index') }}" class="nav-link" data-key="t-horizontal"><i
                            class="ri-layout-3-line"></i> <span data-key="t-layouts">Quản lý Loại Ghế</span></a>
                </li>

                {{-- Giá vé --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.price-ticket') }}">
                        <i class=" ri-ticket-2-line"></i> <span data-key="t-dashboards">Giá vé</span>
                    </a>
                </li>

                {{-- Tài khoản --}}
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link" data-key="t-horizontal"> <i
                            class="ri-account-circle-line"></i> <span data-key="t-layouts">Tài khoản</span></a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
