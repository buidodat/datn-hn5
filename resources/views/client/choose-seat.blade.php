@extends('client.layouts.master')

@section('title')
    Chọn ghế
@endsection

@section('content')
    <div class="st_dtts_wrapper float_left">
        <div class="container container-choose-seat">
            <div class="row">
                <div class="mb-3 title-choose-seat">

                    <a href="#">Trang chủ ></a> <a href="#">Đặt vé ></a> <a
                        href="#">{{ $showtime->movie->name }}</a>
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
                                    {{-- <div class="list-seats"> <span class="mdi--love-seat text-warning"></span>
                                        <span class="status-seat">Ghế đặt trước</span>
                                    </div> --}}

                                </div>
                                <div class="">
                                    <div>
                                        <div class="container-screen">
                                            @php
                                                $maxCol = App\Models\Room::MAX_COL;
                                                $maxRow = App\Models\Room::MAX_ROW;
                                            @endphp
                                            <div class="container-detail-seat">
                                                <div class="screen">Màn Hình Chiếu</div>
                                                <div class="seat-selection">
                                                    <table class="table-seat">
                                                        <tbody>
                                                            @for ($row = 0; $row < $maxRow; $row++)
                                                                <tr>
                                                                    {{-- <td class="box-item">
                                                                        {{ chr(65 + $row) }}
                                                                    </td> --}}
                                                                    @for ($col = 0; $col < $maxCol; $col++)
                                                                        <td class="row-seat">
                                                                            @foreach ($showtime->room->seats as $seat)
                                                                                @if ($seat->coordinates_x === $col + 1 && $seat->coordinates_y === chr(65 + $row))
                                                                                    @php
                                                                                        // Lấy status từ bảng seat_showtimes thông qua pivot
                                                                                        $seatStatus = $seat->showtimes
                                                                                            ->where('id', $showtime->id)
                                                                                            ->first()->pivot->status;
                                                                                    @endphp

                                                                                    @if ($seat->type_seat_id == 1)
                                                                                        <span
                                                                                            class="solar--sofa-3-bold seat span-seat {{ $seatStatus }}">
                                                                                            <span
                                                                                                class="seat-label">{{ $seat->name }}</span>
                                                                                        </span>
                                                                                    @endif
                                                                                    @if ($seat->type_seat_id == 2)
                                                                                        <span
                                                                                            class="mdi--love-seat text-muted seat span-seat {{ $seatStatus }}">
                                                                                            <span
                                                                                                class="seat-label">{{ $seat->name }}</span>
                                                                                        </span>
                                                                                    @endif
                                                                                    @if ($seat->type_seat_id == 3)
                                                                                        <span
                                                                                            class="game-icons--sofa seat span-seat {{ $seatStatus }}">
                                                                                            <span
                                                                                                class="seat-label">{{ $seat->name }}</span>
                                                                                        </span>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                    @endfor

                                                                </tr>
                                                            @endfor
                                                        </tbody>
                                                    </table>

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
                                                    <p id="timer" class="bold">10:00</p>
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
                                                    $url = $showtime->movie->img_thumbnail;

                                                    if (!\Str::contains($url, 'http')) {
                                                        $url = Storage::url($url);
                                                    }
                                                @endphp
                                                <img width="150px" src="{{ $url }}" alt="">
                                            </div>
                                            <div>
                                                <h3>{{ $showtime->movie->name }}</h3>
                                                <br>
                                                <p>{{ $showtime->format }}</p>
                                            </div>

                                        </li>
                                        <li>Thể loại: <span class="bold">{{ $showtime->movie->category }}</span></li>
                                        <li> Thời lượng: <span class="bold">{{ $showtime->movie->duration }} phút</span>
                                        </li>
                                        <hr>
                                        <li> Rạp chiếu: <span class="bold">{{ $showtime->room->cinema->name }}</span>
                                        </li>
                                        <li> Ngày chiếu: <span
                                                class="bold">{{ \Carbon\Carbon::parse($showtime->movie->release_date)->format('d/m/Y') }}</span>
                                        </li>
                                        <li> Giờ chiếu: <span
                                                class="bold">{{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}</span>
                                        </li>
                                        <li> Phòng chiếu: <span class="bold">{{ $showtime->room->name }}</span></li>
                                        <li>Ghế ngồi: <span id="selected-seats" class="bold"></span></li>
                                        {{-- <li class="bold"> Tổng tiền: <span class="bold">190.000đ</span></li> --}}
                                    </ul>
                                </div>

                                <div class="total-price-choose-seat float_left">
                                    <form action="{{ route('checkout') }}">
                                        {{-- @csrf --}}
                                        {{-- <input type="hidden" name="selected_seats" id="hidden-selected-seats"> --}}
                                        {{-- <input type="hidden" name="total_price" value="190000">  <!-- Ví dụ --> --}}
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

@endsection

@section('scripts')
    <script>
        // document.addEventListener('DOMContentLoaded', () => {
        //     const seats = document.querySelectorAll('.seat'); // Lấy tất cả các ghế
        //     const selectedSeatsDisplay = document.getElementById('selected-seats'); // Vị trí hiển thị ghế đã chọn
        //     let selectedSeats = []; // Mảng lưu trữ tên các ghế đã chọn

        //     seats.forEach(seat => {
        //         seat.addEventListener('click', () => {
        //             const seatLabel = seat.querySelector('.seat-label').textContent; // Lấy tên ghế

        //             // Kiểm tra ghế có phải đã được đặt hoặc giữ trước không
        //             if (!seat.classList.contains('reserved') && !seat.classList.contains(
        //                     'pre-booked')) {
        //                 seat.classList.toggle('selected'); // Thêm hoặc xóa lớp 'selected'

        //                 if (seat.classList.contains('selected')) {
        //                     // Thêm tên ghế vào mảng selectedSeats
        //                     selectedSeats.push(seatLabel);
        //                 } else {
        //                     // Xóa tên ghế khỏi mảng selectedSeats
        //                     selectedSeats = selectedSeats.filter(s => s !== seatLabel);
        //                 }

        //                 // Cập nhật danh sách ghế đã chọn hiển thị trên giao diện
        //                 selectedSeatsDisplay.textContent = selectedSeats.join(', ');
        //             }
        //         });
        //     });
        // });

        document.addEventListener('DOMContentLoaded', () => {
            const seats = document.querySelectorAll('.seat'); // Lấy tất cả các ghế
            const selectedSeatsDisplay = document.getElementById('selected-seats'); // Vị trí hiển thị ghế đã chọn
            const submitButton = document.querySelector('form button[type="submit"]'); // Nút "Tiếp tục"
            let selectedSeats = []; // Mảng lưu trữ tên các ghế đã chọn

            seats.forEach(seat => {
                seat.addEventListener('click', () => {
                    const seatLabel = seat.querySelector('.seat-label').textContent; // Lấy tên ghế

                    // Kiểm tra ghế có phải đã được đặt hoặc giữ trước không
                    if (!seat.classList.contains('reserved') && !seat.classList.contains(
                            'pre-booked')) {
                        seat.classList.toggle('selected'); // Thêm hoặc xóa lớp 'selected'

                        if (seat.classList.contains('selected')) {
                            if (selectedSeats.length < 8) {
                                // Thêm tên ghế vào mảng selectedSeats nếu số ghế đã chọn dưới 8
                                selectedSeats.push(seatLabel);
                            } else {
                                // Nếu đã chọn 8 ghế, không cho chọn thêm và hiện cảnh báo
                                seat.classList.remove('selected');
                                alert('Bạn chỉ được chọn tối đa 8 ghế!');
                            }
                        } else {
                            // Xóa tên ghế khỏi mảng selectedSeats
                            selectedSeats = selectedSeats.filter(s => s !== seatLabel);
                        }

                        // Cập nhật danh sách ghế đã chọn hiển thị trên giao diện
                        selectedSeatsDisplay.textContent = selectedSeats.join(', ');
                    }
                });
            });

            // Kiểm tra khi người dùng bấm nút "Tiếp tục"
            submitButton.addEventListener('click', (event) => {
                if (selectedSeats.length > 8) {
                    event.preventDefault(); // Ngăn không cho form gửi đi
                    alert('Bạn chỉ được chọn tối đa 8 ghế!'); // Hiển thị thông báo
                }
            });
        });

        // Thời gian đếm ngược (10 phút = 600 giây)
        let timeLeft = 600; // 600 giây tương đương 10 phút
        const timerElement = document.getElementById('timer');

        // Hàm đếm ngược thời gian
        const countdown = setInterval(() => {
            // Tính số phút và giây còn lại
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;

            // Hiển thị thời gian còn lại ở định dạng mm:ss
            timerElement.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

            // Giảm thời gian còn lại
            timeLeft--;

            // Khi thời gian kết thúc (hết 0 giây)
            if (timeLeft < 0) {
                clearInterval(countdown); // Dừng đếm ngược

                // Hiển thị thông báo và quay về trang chủ
                alert('Hết thời gian! Bạn sẽ được chuyển về trang chủ.');
                window.location.href = '/'; // Điều hướng về trang chủ ("/")
            }
        }, 1000); // Cập nhật mỗi giây
    </script>
@endsection
