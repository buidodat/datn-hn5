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
                                    </div>
                                    <div class="">
                                        <div>
                                            <div class="container-screen">
                                                <div class="container-detail-seat">
                                                    <div class="screen">Màn Hình Chiếu</div>
                                                    <div class="seat-selection">
                                                        <table class="table-seat">
                                                            <tbody>
                                                                @for ($row = 0; $row < $matrixSeat['max_row']; $row++)
                                                                    <tr>
                                                                        {{-- <td class="box-item">
                                                                            {{ chr(65 + $row) }}
                                                                        </td> --}}
                                                                        @for ($col = 0; $col < $matrixSeat['max_col']; $col++)
                                                                            <td class="row-seat">
                                                                                @foreach ($showtime->room->seats as $seat)
                                                                                    @if ($seat->coordinates_x === $col + 1 && $seat->coordinates_y === chr(65 + $row))
                                                                                        @php
                                                                                            // // Lấy status từ bảng seat_showtimes thông qua pivot
                                                                                            // $seatStatus = $seat->showtimes
                                                                                            //     ->where(
                                                                                            //         'id',
                                                                                            //         $showtime->id,
                                                                                            //     )
                                                                                            //     ->first()->pivot
                                                                                            //     ->status;
                                                                                            // Lấy status và price từ bảng seat_showtimes thông qua pivot
                                                                                            $seatData = $seat->showtimes
                                                                                                ->where(
                                                                                                    'id',
                                                                                                    $showtime->id,
                                                                                                )
                                                                                                ->first()->pivot;
                                                                                            $seatStatus =
                                                                                                $seatData->status;
                                                                                            $seatPrice =
                                                                                                $seatData->price;
                                                                                        @endphp

                                                                                        @if ($seat->type_seat_id == 1)
                                                                                            <span
                                                                                                data-seat-id="{{ $seat->id }}"
                                                                                                data-seat-price="{{ $seatPrice }}"
                                                                                                class="solar--sofa-3-bold seat span-seat {{ $seatStatus }}">
                                                                                                <span
                                                                                                    class="seat-label">{{ $seat->name }}</span>
                                                                                            </span>
                                                                                            {{-- <p
                                                                                                style="font-size: 13px; font-weight: 600">
                                                                                                {{ $seatPrice }}</p> --}}
                                                                                        @endif
                                                                                        @if ($seat->type_seat_id == 2)
                                                                                            <span
                                                                                                data-seat-id="{{ $seat->id }}"
                                                                                                data-seat-price="{{ $seatPrice }}"
                                                                                                class="mdi--love-seat text-muted seat span-seat {{ $seatStatus }}">
                                                                                                <span
                                                                                                    class="seat-label">{{ $seat->name }}</span>
                                                                                            </span>
                                                                                            {{-- <p
                                                                                                style="font-size: 13px; font-weight: 600">
                                                                                                {{ $seatPrice }}</p> --}}
                                                                                        @endif
                                                                                        @if ($seat->type_seat_id == 3)
                                                                                            <span
                                                                                                data-seat-id="{{ $seat->id }}"
                                                                                                data-seat-price="{{ $seatPrice }}"
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
                                                    </div>
                                                </div>

                                                <div class="legend">
                                                    {{-- <div><span class="seat available"></span> Ghế trống</div> --}}
                                                    <div><span class="solar--sofa-3-bold text-muted"></span> Ghế Thường
                                                    </div>
                                                    <div><span class="mdi--love-seat text-muted"></span> Ghế Vip</div>
                                                    <div><span class="game-icons--sofa text-muted"></span> Ghế Đôi</div>
                                                    <div>
                                                        <p>Tổng tiền:</p>
                                                        <p id="total-price" class="bold">0 Vnđ</p>
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
                                            <li> Thời lượng: <span class="bold">{{ $showtime->movie->duration }}
                                                    phút</span>
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
                                        <div class="total-price-choose-seat float_left">
                                            <form action="{{ route('save-information', $showtime->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="showtimeId" value="{{ $showtime->id }}">
                                                <input type="hidden" name="seatId" id="hidden-seat-ids">
                                                <input type="hidden" name="selected_seats" id="hidden-selected-seats">
                                                <input type="hidden" name="total_price" id="hidden-total-price">
                                                <!-- Thay đổi ở đây -->
                                                <button id="submit-button" type="submit">Tiếp tục</button>
                                            </form>
                                        </div>
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
        {{-- <script>
            document.addEventListener('DOMContentLoaded', () => {
                const seats = document.querySelectorAll('.seat');
                const selectedSeatsDisplay = document.getElementById('selected-seats');
                const hiddenSelectedSeats = document.getElementById('hidden-selected-seats');
                const hiddenSeatIds = document.getElementById('hidden-seat-ids');
                const totalPriceElement = document.getElementById('total-price');
                const hiddenTotalPrice = document.getElementById('hidden-total-price');
                const submitButton = document.getElementById('submit-button');

                let selectedSeats = [];
                let selectedSeatIds = [];
                let totalPrice = 0;

                seats.forEach(seat => {
                    seat.addEventListener('click', () => {
                        const seatLabel = seat.querySelector('.seat-label').textContent;
                        const seatId = seat.getAttribute('data-seat-id');
                        const seatPrice = parseInt(seat.getAttribute(
                            'data-seat-price')); // Lấy giá ghế từ thuộc tính data-seat-price

                        if (!seat.classList.contains('reserved') && !seat.classList.contains(
                                'pre-booked')) {
                            seat.classList.toggle('selected');

                            if (seat.classList.contains('selected')) {
                                if (selectedSeats.length < 8) {
                                    selectedSeats.push(seatLabel);
                                    selectedSeatIds.push(seatId);
                                    totalPrice += seatPrice; // Cộng giá ghế vào tổng tiền
                                } else {
                                    seat.classList.remove('selected');
                                    alert('Bạn chỉ được chọn tối đa 8 ghế!');
                                }
                            } else {
                                selectedSeats = selectedSeats.filter(s => s !== seatLabel);
                                selectedSeatIds = selectedSeatIds.filter(id => id !== seatId);
                                totalPrice -= seatPrice; // Trừ giá ghế khi bỏ chọn
                            }

                            selectedSeatsDisplay.textContent = selectedSeats.join(', ');
                            hiddenSelectedSeats.value = selectedSeats.join(',');
                            hiddenSeatIds.value = JSON.stringify(selectedSeatIds);
                            totalPriceElement.textContent = totalPrice.toLocaleString() +
                                ' Vnđ'; // Hiển thị tổng tiền
                            hiddenTotalPrice.value = totalPrice; // Cập nhật tổng tiền vào input ẩn
                        }
                    });
                });

                submitButton.addEventListener('click', (event) => {
                    console.log("Selected seats:", selectedSeats); // Kiểm tra số lượng ghế đã chọn
                    if (selectedSeats.length === 0) {
                        event.preventDefault();
                        alert('Bạn chưa chọn ghế nào! Vui lòng chọn ghế trước khi tiếp tục.');
                        return false;
                    } else if (selectedSeats.length > 8) {
                        event.preventDefault();
                        alert('Bạn chỉ được chọn tối đa 8 ghế!');
                    }
                });
            });
        </script> --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const seats = document.querySelectorAll('.seat');
                const selectedSeatsDisplay = document.getElementById('selected-seats');
                const hiddenSelectedSeats = document.getElementById('hidden-selected-seats');
                const hiddenSeatIds = document.getElementById('hidden-seat-ids');
                const totalPriceElement = document.getElementById('total-price');
                const hiddenTotalPrice = document.getElementById('hidden-total-price');
                const submitButton = document.getElementById('submit-button');

                let selectedSeats = [];
                let selectedSeatIds = [];
                let totalPrice = 0;

                seats.forEach(seat => {
                    seat.addEventListener('click', () => {
                        const seatLabel = seat.querySelector('.seat-label').textContent;
                        const seatId = seat.getAttribute('data-seat-id');
                        const seatPrice = parseInt(seat.getAttribute(
                        'data-seat-price')); // Lấy giá ghế từ thuộc tính data-seat-price

                        if (!seat.classList.contains('reserved') && !seat.classList.contains(
                                'pre-booked')) {
                            seat.classList.toggle('selected');

                            if (seat.classList.contains('selected')) {
                                if (selectedSeats.length < 8) {
                                    selectedSeats.push(seatLabel);
                                    selectedSeatIds.push(seatId);
                                    totalPrice += seatPrice; // Cộng giá ghế vào tổng tiền
                                } else {
                                    seat.classList.remove('selected');
                                    alert('Bạn chỉ được chọn tối đa 8 ghế!');
                                }
                            } else {
                                selectedSeats = selectedSeats.filter(s => s !== seatLabel);
                                selectedSeatIds = selectedSeatIds.filter(id => id !== seatId);
                                totalPrice -= seatPrice; // Trừ giá ghế khi bỏ chọn
                            }

                            selectedSeatsDisplay.textContent = selectedSeats.join(', ');
                            hiddenSelectedSeats.value = selectedSeats.join(',');
                            hiddenSeatIds.value = JSON.stringify(selectedSeatIds);
                            totalPriceElement.textContent = totalPrice.toLocaleString() +
                            ' Vnđ'; // Hiển thị tổng tiền
                            hiddenTotalPrice.value = totalPrice; // Cập nhật tổng tiền vào input ẩn
                        }
                    });
                });

                // Hàm kiểm tra ghế ngoài cùng và ghế bên cạnh
                function checkAdjacentEdgeSeats() {
                    const rows = document.querySelectorAll('.table-seat tr'); // Mỗi hàng trong bảng ghế
                    let isEdgeSeatIssue = false;

                    rows.forEach(row => {
                        const seatsInRow = row.querySelectorAll('.seat'); // Các ghế trong hàng này
                        if (seatsInRow.length >= 2) {
                            const firstSeat = seatsInRow[0]; // Ghế ngoài cùng trái
                            const secondSeat = seatsInRow[1]; // Ghế ngay bên cạnh ghế ngoài cùng trái

                            const lastSeat = seatsInRow[seatsInRow.length - 1]; // Ghế ngoài cùng phải
                            const beforeLastSeat = seatsInRow[seatsInRow.length -
                            2]; // Ghế ngay bên cạnh ghế ngoài cùng phải

                            // Kiểm tra điều kiện ghế ngoài cùng không được chọn và ghế bên cạnh nó được chọn
                            if ((!firstSeat.classList.contains('selected') && secondSeat.classList.contains(
                                    'selected')) ||
                                (!lastSeat.classList.contains('selected') && beforeLastSeat.classList.contains(
                                    'selected'))) {
                                isEdgeSeatIssue = true;
                            }
                        }
                    });

                    return isEdgeSeatIssue;
                }

                submitButton.addEventListener('click', (event) => {
                    console.log("Selected seats:", selectedSeats); // Kiểm tra số lượng ghế đã chọn
                    if (selectedSeats.length === 0) {
                        event.preventDefault();
                        alert('Bạn chưa chọn ghế nào! Vui lòng chọn ghế trước khi tiếp tục.');
                        return false;
                    } else if (selectedSeats.length > 8) {
                        event.preventDefault();
                        alert('Bạn chỉ được chọn tối đa 8 ghế!');
                    } else if (checkAdjacentEdgeSeats()) {
                        event.preventDefault();
                        alert('Bạn không được để trống ghế ngoài cùng khi ghế bên cạnh được chọn.');
                        return false;
                    }
                });
            });
        </script>
    @endsection
