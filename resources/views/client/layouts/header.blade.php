<div class="header">
    <div class="header-top">
        <div class="container-header-top">
            <div class="login">
                {{-- <a href="">Đăng nhập</a> <a href="">|</a>  <a href="">Đăng ký</a> --}}
                @guest
                    @if (Route::has('login'))
                        <a class="a-dndk" href="{{ route('login') }}">{{ __('Đăng Nhập') }}</a>
                    @endif
                    |
                    @if (Route::has('register'))
                        <a class="a-dndk" href="{{ route('register') }}">{{ __('Đăng Ký') }}</a>
                    @endif
                @else
                    {{-- <div class="div-dndk">
                       Xin chào: {{ Auth::user()->name }} <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <ul class="lg-submenu ul-dndk">
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                {{ __('Đăng Xuất') }}
                            </a>
                            <a href="{{ route('my-account.edit') }}">Tài khoản của tôi</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul> --}}
                    <ul class="menu-account">
                        <li class="hello-account">
                            <a href="#"> Xin chào: {{ Auth::user()->name }} <i
                                    class="fa-solid fa-chevron-down"></i></a>
                            <ul class="sub-menu-account">
                                <li><a href="{{ route('my-account.edit') }}"><i class="fa-regular fa-user"></i> Thông tin
                                        tài khoản</a></li>
                                <li><a href=""><i class="fa-regular fa-credit-card"></i> Thẻ thành viên</a></li>
                                <li><a href=""><i class="fa-regular fa-paper-plane"></i> Hành trình điện ảnh</a></li>
                                <li><a href=""><i class="fa-regular fa-hand-point-right"></i> Điểm Poly</a></li>
                                <li><a href=""><i class="fa-solid fa-ticket"></i> Voucher của tôi</a></li>
                                <li>
                                    {{-- <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </a> --}}

                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i> {{ __('Đăng Xuất') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>


                                </li>
                            </ul>
                        </li>
                    </ul>
                @endguest
            </div>
            <div>
                <a href="#" onclick="return alert('Click cái gì, chưa đổi đc ngôn ngữ đâu :)))')">
                    <img width="20px" src="{{ asset('theme/client/images/languages_english.png') }}" alt="">
                </a>

            </div>
        </div>
    </div>
    <div class="header-buttom ">
        <div class="container-header-buttom">
            <div class="logo">
                <div class="img-logo">
                    <a href="/">
                        <img style="width: 184px; height: 40px"
                            src="{{ asset('theme/client/images/header/logo6.svg') }}" alt="logo" />
                    </a>
                </div>
                <div class="choose-cinemas">
                    <div>
                        {{-- @php
                            $cinemas = App\Models\Cinema::all();
                        @endphp
                        <select id="cinemaSelect" onchange="fetchData()">
                            <option value="">Chọn cơ sở</option>
                            @foreach ($cinemas as $cinema)
                                <option value="{{ $cinema->id }}">{{ $cinema->name }}</option>
                            @endforeach
                        </select> --}}
                        @php
                            $branches = App\Models\Branch::where('is_active', '1')->get();
                        @endphp

                        <ul class="dropdown">
                            <li class="default-base">
                                <a href="#">Poly Thanh Xuân <i class="fa-solid fa-chevron-down"></i></a>
                                <ul class="sub-menu">
                                    @foreach ($branches as $branch)
                                        <li class="li-branch">
                                            <a href="">{{ $branch->name }}</a>
                                            <span><i class="fa-solid fa-chevron-right"></i></span>
                                            <ul class="menu-cinema">
                                                @if ($branch->cinemas->isEmpty())
                                                    <li><a href="#">Không có rạp nào</a></li>
                                                @else
                                                    @foreach ($branch->cinemas as $cinema)
                                                        <li><a href="#">Poly {{ $cinema->name }}</a></li>
                                                    @endforeach
                                                @endif

                                            </ul>
                                        </li>
                                    @endforeach
                                    {{-- <li class="li-branch">
                                        <a href="">Hồ Chí Minh</a>
                                        <span><i class="fa-solid fa-chevron-right"></i></span>
                                        <ul class="menu-cinema">
                                            <li><a href="">Poly Thanh Xuân</a></li>
                                            <li><a href="">Poly Mỹ Đình</a></li>
                                            <li><a href="">Poly Hà Đông</a></li>
                                            <li><a href="">Poly Thanh Xuân</a></li>
                                        </ul>
                                    </li>
                                    <li class="li-branch">
                                        <a href="">Huế</a>
                                        <span><i class="fa-solid fa-chevron-right"></i></span>
                                        <ul class="menu-cinema">
                                            <li><a href="">Poly Thanh Xuân</a></li>
                                            <li><a href="">Poly Mỹ Đình</a></li>
                                            <li><a href="">Poly Hà Đông</a></li>
                                            <li><a href="">Poly Thanh Xuân</a></li>
                                        </ul>
                                    </li> --}}

                                </ul>
                            </li>

                        </ul>

                    </div>

                </div>
            </div>

            <div class="main-menu">
                <ul>
                    <li>
                        <a href="#">Lịch chiếu theo rạp</a>
                    </li>
                    <li>
                        <a href="#">Phim</a>
                    </li>
                    <li>
                        <a href="{{ route('policy') }}">Chính sách</a>
                    </li>
                    <li>
                        <a href="">Giá vé</a>
                    </li>
                    <li>
                        <a href="#">Tin tức</a>
                    </li>
                    <li>
                        <a href="#">Liên hệ</a>
                    </li>
                    <li>
                        <a href="">Thành viên</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
