@extends('client.layouts.master')

@section('title')
    Choose Seat
@endsection

@section('content')
    <div class="st_dtts_wrapper float_left">
        <div class="container container-choose-seat">
            <div class="row">
                <div class="mb-3 title-choose-seat">

                    <a href="">Trang chủ ></a> <a href="">Đặt vé ></a> <a href="">Phim Shin Cậu Bé Bút
                        Chì: Nhật Ký Khủng Long Của Chúng Mình</a>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="st_dtts_left_main_wrapper float_left">
                        <div class="row">
                            <div class="col-md-12 box-list-status-seat">
                                <div class="border my-3">
                                    {{-- <span class="mdi--love-seat"></span> --}}
                                    <div class="list-seats"><span class="mdi--love-seat text-muted"></span>
                                        <span class="status-seat">Ghế trống</span>
                                    </div>
                                    <div class="list-seats"><span class="mdi--love-seat text-primary"></span>
                                        <span class="status-seat">Ghế đang chọn</span>
                                    </div>
                                    <div class="list-seats"><span class="mdi--love-seat text-blue"></span>
                                        <span class="status-seat">Ghế đang được giữ</span>
                                    </div>
                                    <div class="list-seats"><span class="mdi--love-seat text-danger"></span>
                                        <span class="status-seat">Ghế đã bán</span>
                                    </div>
                                    <div class="list-seats"> <span class="mdi--love-seat text-warning"></span>
                                        <span class="status-seat">Ghế đặt trước</span>
                                    </div>

                                </div>
                                <div class="">

                                    <div>
                                        <div class="container-screen">
                                            <div class="screen">Màn Hình Chiếu</div>

                                            <div class="seat-selection">
                                                <div class="ghe-thuong">
                                                    <div class="row">
                                                        @for ($i = 1; $i < 12; $i++)
                                                            <span class="solar--sofa-3-bold seat" id="A{{ $i }}">
                                                                <span class="seat-label">A{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="ghe-thuong">
                                                    <div class="row">
                                                        @for ($i = 1; $i < 13; $i++)
                                                            <span class="solar--sofa-3-bold seat" id="A{{ $i }}">
                                                                <span class="seat-label">A{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="ghe-thuong">
                                                    <div class="row">
                                                        @for ($i = 1; $i < 14; $i++)
                                                            <span class="solar--sofa-3-bold seat" id="A{{ $i }}">
                                                                <span class="seat-label">A{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>

                                                <div class="ghe-vip">
                                                    <div class="row">
                                                        @for ($i = 1; $i < 15; $i++)
                                                            <span class="mdi--love-seat text-muted seat"
                                                                id="B{{ $i }}">
                                                                <span class="seat-label">B{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="ghe-vip">
                                                    <div class="row">
                                                        @for ($i = 1; $i < 15; $i++)
                                                            <span class="mdi--love-seat text-muted seat"
                                                                id="B{{ $i }}">
                                                                <span class="seat-label">B{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="ghe-vip">
                                                    <div class="row">
                                                        @for ($i = 1; $i < 15; $i++)
                                                            <span class="mdi--love-seat text-muted seat"
                                                                id="B{{ $i }}">
                                                                <span class="seat-label">B{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>

                                                <div class="ghe-doi">
                                                    <div class="row">
                                                        @for ($i = 1; $i < 12; $i++)
                                                            <span class="game-icons--sofa seat" id="C{{ $i }}">
                                                                <span class="seat-label">C{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="ghe-doi">
                                                    <div class="row">
                                                        @for ($i = 1; $i < 13; $i++)
                                                            <span class="game-icons--sofa seat" id="C{{ $i }}">
                                                                <span class="seat-label">C{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="legend">
                                                {{-- <div><span class="seat available"></span> Ghế trống</div> --}}
                                                <div><span class="solar--sofa-3-bold text-muted"></span> Ghế Thường</div>
                                                <div><span class="mdi--love-seat text-muted"></span> Ghế Vip</div>
                                                <div><span class="game-icons--sofa text-muted"></span> Ghế Đôi</div>
                                                <div>
                                                    <p>Tổng tiền:</p>
                                                    <p class="bold">190.000đ</p>
                                                </div>
                                                <div>
                                                    <p>Thời gian còn lại:</p>
                                                    <p class="bold">9:55</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-12">
                                <div class="st_cherity_btn float_left">
                                    <h3>SELECT TICKET TYPE</h3>
                                    <ul>
                                        <li><a href="#"><i class="flaticon-tickets"></i> &nbsp;M-Ticket</a>
                                        </li>
                                        <li><a href="#"><i class="flaticon-tickets"></i> &nbsp;Box office Pickup
                                            </a>
                                        </li>
                                        <li><a href="#"><i class="flaticon-tickets"></i> &nbsp;Box office Pickup
                                        </a>
                                    </li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="st_dtts_bs_wrapper float_left info-movie">
                                <div class="st_dtts_bs_heading float_left">
                                    <p>Thông tin phim</p>
                                </div>
                                <div class=" float_left">

                                    <ul>
                                        <li>
                                            <div>
                                                <img width="150px"
                                                    src="{{ asset('theme/client/images/index_III/img_phim_chon_ghe.png') }}"
                                                    alt="">
                                            </div>
                                            <div>
                                                <h3>Phim Shin Cậu Bé Bút Chì: Nhật Ký Khủng Long Của Chúng Mình</h3>
                                                <br>
                                                <p>2D Lồng tiếng</p>
                                            </div>

                                        </li>
                                        <li>Thể loại: <span class="bold">Gia đình, Hoạt hình</span></li>
                                        <li> Thời lượng: <span class="bold">105 phút</span></li>
                                        <hr>
                                        <li> Rạp chiếu: <span class="bold">Beta Thái Nguyên</span></li>
                                        <li> Ngày chiếu: <span class="bold">31/08/2024</span></li>
                                        <li> Giờ chiếu: <span class="bold">18:10</span></li>
                                        <li> Phòng chiếu: <span class="bold">P1</span></li>
                                        <li> Ghế ngồi: <span class="bold">A1,A2</span></li>
                                        <li class="bold"> Tổng tiền: <span class="bold">190.000đ</span></li>
                                    </ul>
                                </div>

                                <div class="total-price-choose-seat float_left">
                                    <form action="{{ route('checkout') }}">
                                        <button type="submit">Tiếp tục</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const seats = document.querySelectorAll('.seat');

            seats.forEach(seat => {
                seat.addEventListener('click', () => {
                    if (!seat.classList.contains('reserved') && !seat.classList.contains(
                            'pre-booked')) {
                        seat.classList.toggle('selected');
                    }
                });
            });
        });
    </script>
@endsection
