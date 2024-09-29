<div class="header ">
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
                        <img src="{{ asset('theme/client/images/header/logo6.svg') }}" alt="logo" />
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
                                @php
                                    $selectedCinema = App\Models\Cinema::find(session('cinema_id'));
                                @endphp
                                <a href="#">Poly {{ $selectedCinema->name }} <i class="fa-solid fa-chevron-down"></i></a>
                                <ul class="sub-menu">
                                    @foreach ($branches as $branch)
                                        <li class="li-branch">
                                            <a href="#">{{ $branch->name }}</a>
                                            <span><i class="fa-solid fa-chevron-right"></i></span>
                                            <ul class="menu-cinema">
                                                @if ($branch->cinemas->isEmpty())
                                                    <li><a href="#">Không có rạp nào</a></li>
                                                @else
                                                    @foreach ($branch->cinemas as $cinema)
                                                        <li>
                                                            <form action="{{ route('change-cinema') }}" method="POST"
                                                                style="display:inline;">
                                                                @csrf
                                                                <input type="hidden" name="cinema_id"
                                                                    value="{{ $cinema->id }}">
                                                                <button type="submit"
                                                                    style="background:none;border:none;color:#000;text-align:left;cursor:pointer;">
                                                                    Poly {{ $cinema->name }}
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>

                    </div>

                </div>
            </div>

            <div class="main-menu">
                <ul>
                    <li>
                        <a href="{{ route('showtimes') }}">Lịch chiếu theo rạp</a>
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
            <div class="menu-responsive">
                <ul class="menu-respon">
                    <li>
                        <a><i class="fa-solid fa-bars"></i></a>
                        <ul class="sub-menu-respon">
                            <li>
                                <a href="{{ route('showtimes') }}"><i class="fa-solid fa-calendar-days"></i> Lịch chiếu theo rạp</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-solid fa-film"></i> Phim</a>
                            </li>
                            <li>
                                <a href="{{ route('policy') }}"><i class="fa-solid fa-building-shield"></i> Chính
                                    sách</a>
                            </li>
                            <li>
                                <a href=""><i class="fa-solid fa-money-bill"></i> Giá vé</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-regular fa-newspaper"></i> Tin tức</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-regular fa-address-card"></i> Liên hệ</a>
                            </li>
                            <li>
                                <a href=""><i class="fa-regular fa-user"></i> Thành viên</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
