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
        <a href="#" class="logo logo-light">
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

                {{-- Menu mới --}}
                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#systemCinemas" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="systemCinemas">
                        <i class=" ri-store-3-fill"></i><span data-key="t-landing">Hệ thống Rạp</span>
                    </a>
                    <div class="menu-dropdown collapse" id="systemCinemas" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.branches.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal"><i class="ri-ancient-gate-fill"></i><span
                                        data-key="t-layouts">Quản lý chi nhánh</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.cinemas.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal"> <i class=" ri-store-3-fill"></i> <span
                                        data-key="t-layouts">Quản lý Rạp</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.rooms.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal"> <i class=" ri-tv-line"></i> <span data-key="t-layouts">Quản
                                        lý Phòng chiếu</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.seat-templates.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal"> <i class="ri-rocket-line"></i>
                                    <span data-key="t-layouts">Mẫu sơ đồ ghế</span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#manageMovies" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="manageMovies">
                        <i class=" ri-slideshow-3-fill"></i> <span data-key="t-landing">Phim & Suất chiếu</span>
                    </a>
                    <div class="menu-dropdown collapse" id="manageMovies" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.movies.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal"><i class="mdi mdi-movie-open-outline"></i> <span
                                        data-key="t-layouts">Quản lý
                                        Phim</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.showtimes.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal"><i class=" ri-slideshow-3-fill"></i> <span
                                        data-key="t-layouts">Quản
                                        lý Suất
                                        chiếu</span></a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.tickets.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal">
                                    <i class="ri-wallet-3-fill"></i>
                                    <span data-key="t-layouts">Quản lý hóa đơn</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.book-tickets.index') }}" class="nav-link menu-link" data-key="t-horizontal">
                                    <i class=" mdi mdi-store"></i>
                                    <span data-key="t-dashboards">Đặt vé</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#service" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="service">
                        <i class="ri-shopping-basket-2-line"></i> <span data-key="t-landing">Dịch vụ và Ưu đãi</span>
                    </a>
                    <div class="menu-dropdown collapse" id="service" style="">
                        <ul class="nav nav-sm flex-column">

                            {{-- Quản lí đồ ăn --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.food.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal"><i class="ri-cake-3-fill"></i> <span
                                        data-key="t-layouts">Quản lý Đồ Ăn</span></a>
                            </li>

                            {{-- Quản lí Combo --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.combos.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal">
                                    <i class="ri-shopping-basket-2-line"></i> <span data-key="t-layouts">Quản lý
                                        Combo</span></a>
                            </li>
                            {{-- Vouchers --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.vouchers.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal"><i class=" ri-coupon-3-line "></i> <span
                                        data-key="t-layouts">Vouchers</span></a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.payments.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal"><i class="ri-layout-3-line"></i> <span
                                        data-key="t-layouts">Quản lý
                                        Thanh Toán</span></a>
                            </li>

                            {{-- Giá vé --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('admin.ticket-price') }}">
                                    <i class=" ri-ticket-2-line"></i> <span data-key="t-dashboards">Quản lý Giá
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#contentMarketing" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="contentMarketing">
                        <i class="ri-file-list-3-line"></i><span data-key="t-landing">Nội dung và Marketing</span>
                    </a>
                    <div class="menu-dropdown collapse" id="contentMarketing" style="">
                        <ul class="nav nav-sm flex-column">

                            {{-- Quản lí bài viết --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.posts.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal"><i class="ri-file-list-3-line"></i> <span
                                        data-key="t-layouts">Quản lý bài
                                        viết</span></a>
                            </li>
                            {{-- Quản lí Slideshows --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.slideshows.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal"> <i class="ri-slideshow-3-line"></i> <span
                                        data-key="t-layouts">Slideshows</span></a>
                            </li>
                        </ul>
                    </div>
                </li>



                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#user-report" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="user-report">
                        <i class="ri-account-circle-line"></i>
                        <span data-key="t-landing">Tài khoản và Báo cáo</span>
                    </a>
                    <div class="menu-dropdown collapse" id="user-report" style="">
                        <ul class="nav nav-sm flex-column">

                            {{-- Quản lí Liên hệ --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.contacts.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal"><i class="ri-contacts-book-2-line"></i> <span
                                        data-key="t-layouts">Liên hệ</span></a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link menu-link"
                                    data-key="t-horizontal">
                                    <i class="ri-account-circle-line"></i> <span data-key="t-layouts">Tài
                                        khoản</span></a>
                            </li>
                            {{-- Thống kê --}}
                            <li class="nav-item">
                                <a href="/admin" class="nav-link menu-link" data-key="t-horizontal">
                                    <i class="ri-dashboard-2-line"></i>
                                    <span data-key="t-dashboards">Thống Kê</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>



                {{-- Menu cũ --}}



            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
