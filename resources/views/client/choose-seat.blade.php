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
                                            <div class="container-detail-seat">
                                                <div class="screen">Màn Hình Chiếu</div>

                                                <div class="seat-selection">
                                                    @foreach ($seatsGroupedByRow as $row => $seatsInRow)
                                                        <div class="seat-row">
                                                            @foreach ($seatsInRow as $seat)
                                                                <div class="seat {{ $seat->status }}"> {{-- Thêm class theo trạng thái của ghế (ghế thường, ghế VIP,...) --}}
                                                                    <span
                                                                        class="seat-label">{{ $seat->coordinates_y }}{{ $seat->coordinates_x }}</span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach

                                                    {{-- <div class="ghe-thuong">
                                                        <div class="row-seat">
                                                            @for ($i = 1; $i < 13; $i++)
                                                                <span class="solar--sofa-3-bold seat"
                                                                    id="A{{ $i }}">
                                                                    <span class="seat-label">A{{ $i }}</span>
                                                                </span>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="ghe-thuong">
                                                        <div class="row-seat">
                                                            @for ($i = 1; $i < 14; $i++)
                                                                <span class="solar--sofa-3-bold seat"
                                                                    id="A{{ $i }}">
                                                                    <span class="seat-label">A{{ $i }}</span>
                                                                </span>
                                                            @endfor
                                                        </div>
                                                    </div>

                                                    <div class="ghe-vip">
                                                        <div class="row-seat">
                                                            @for ($i = 1; $i < 15; $i++)
                                                                <span class="mdi--love-seat text-muted seat"
                                                                    id="B{{ $i }}">
                                                                    <span class="seat-label">B{{ $i }}</span>
                                                                </span>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="ghe-vip">
                                                        <div class="row-seat">
                                                            @for ($i = 1; $i < 15; $i++)
                                                                <span class="mdi--love-seat text-muted seat"
                                                                    id="B{{ $i }}">
                                                                    <span class="seat-label">B{{ $i }}</span>
                                                                </span>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="ghe-vip">
                                                        <div class="row-seat">
                                                            @for ($i = 1; $i < 15; $i++)
                                                                <span class="mdi--love-seat text-muted seat"
                                                                    id="B{{ $i }}">
                                                                    <span class="seat-label">B{{ $i }}</span>
                                                                </span>
                                                            @endfor
                                                        </div>
                                                    </div>

                                                    <div class="ghe-doi">
                                                        <div class="row-seat">
                                                            @for ($i = 1; $i < 12; $i++)
                                                                <span class="game-icons--sofa seat"
                                                                    id="C{{ $i }}">
                                                                    <span class="seat-label">C{{ $i }}</span>
                                                                </span>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="ghe-doi">
                                                        <div class="row-seat">
                                                            @for ($i = 1; $i < 13; $i++)
                                                                <span class="game-icons--sofa seat"
                                                                    id="C{{ $i }}">
                                                                    <span class="seat-label">C{{ $i }}</span>
                                                                </span>
                                                            @endfor
                                                        </div>
                                                    </div> --}}
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
                                                @php
                                                    $url = $showTime->movie->img_thumbnail;

                                                    if (!\Str::contains($url, 'http')) {
                                                        $url = Storage::url($url);
                                                    }
                                                @endphp
                                                <img width="150px" src="{{ $url }}" alt="">
                                            </div>
                                            <div>
                                                <h3>{{ $showTime->movie->name }}</h3>
                                                <br>
                                                <p>{{ $showTime->movie_version->name }}</p>
                                            </div>

                                        </li>
                                        <li>Thể loại: <span class="bold">{{ $showTime->movie->category }}</span></li>
                                        <li> Thời lượng: <span class="bold">{{ $showTime->movie->duration }} phút</span>
                                        </li>
                                        <hr>
                                        <li> Rạp chiếu: <span class="bold">{{ $showTime->room->cinema->name }}</span>
                                        </li>
                                        <li> Ngày chiếu: <span class="bold">{{ $showTime->movie->release_date }}</span>
                                        </li>
                                        <li> Giờ chiếu: <span class="bold">{{ $showTime->start_time }}</span></li>
                                        <li> Phòng chiếu: <span class="bold">{{ $showTime->room->name }}</span></li>
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

@section('styles')
    <style>
        /* Đảm bảo các hàng ghế được bố trí theo hàng ngang */
        .seat-row {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
            /* Tạo khoảng cách giữa các hàng ghế */
        }

        /* Định dạng chung cho ghế */
        .seat {
            width: 40px;
            height: 40px;
            margin: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Ví dụ về trạng thái ghế */
        .seat.available {
            background-color: #4CAF50;
            /* Màu ghế trống */
        }

        .seat.selected {
            background-color: #FF9800;
            /* Màu ghế đang chọn */
        }

        .seat.reserved {
            background-color: #F44336;
            /* Màu ghế đã đặt */
        }

        .seat.vip {
            background-color: #9C27B0;
            /* Màu ghế VIP */
        }
    </style>
@endsection
