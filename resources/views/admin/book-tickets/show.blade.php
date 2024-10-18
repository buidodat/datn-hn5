@extends('admin.layouts.master')

@section('title')
    Đặt vé tại quầy
@endsection

@section('content')
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Đặt vé tại quầy</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.rooms.index') }}">Lịch chiếu</a></li>
                        <li class="breadcrumb-item active">Chọn ghế</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form id="proceedPayment">
        @csrf
        <div class="row">

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12" id="chooseSeat">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Sơ đồ ghế</h4>
                            </div><!-- end card header -->
                            <div class="card-body mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="list-seats my-3">
                                            <div class="list-seat">
                                                <span class='seat-vip-svg '></span>
                                                <span class="status-seat">Ghế trống</span>
                                            </div>
                                            <div class="list-seat"> <span class='seat-vip-svg seat-selected'></span>
                                                <span class="status-seat">Ghế đang chọn</span>
                                            </div>
                                            <div class="list-seat"><span class='seat-vip-svg seat-hold'></span>
                                                <span class="status-seat">Ghế đang được giữ</span>
                                            </div>
                                            <div class="list-seat"><span class='seat-vip-svg seat-sold'></span>
                                                <span class="status-seat">Ghế đã bán</span>
                                            </div>
                                        </div>
                                        <div class="srceen mb-4">
                                            Màn Hình Chiếu
                                        </div>
                                    </div>
                                </div>
                                <table class="table-chart-chair table-none align-middle mx-auto text-center">
                                    <tbody>
                                        @for ($row = 0; $row < $matrix['max_row']; $row++)
                                            <tr>
                                                <td class="box-item-pro">{{ chr(65 + $row) }}</td>
                                                @for ($col = 0; $col < $matrix['max_col']; $col++)
                                                    @php
                                                        // Kiểm tra xem ô hiện tại có trong seatMap không
                                                        $seat =
                                                            isset($seatMap[chr(65 + $row)]) &&
                                                            isset($seatMap[chr(65 + $row)][$col + 1])
                                                                ? $seatMap[chr(65 + $row)][$col + 1]
                                                                : null;
                                                        if (!function_exists('getSeatClassStatus')) {
                                                            function getSeatClassStatus($status)
                                                            {
                                                                switch ($status) {
                                                                    case 'hold':
                                                                    case 'paying':
                                                                        return 'seat-hold';
                                                                    case 'sold':
                                                                        return 'seat-sold';
                                                                    default:
                                                                        return '';
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    @if ($seat && $seat->type_seat_id == 3)
                                                        <!-- Nếu là ghế đôi -->
                                                        <td class="box-item-pro" colspan="2"
                                                            data-seat-status="{{ $seat->pivot->status ?? '' }}"
                                                            data-seat-name="{{ $seat->name ?? '' }}"
                                                            data-seat-price="{{ $seat->pivot->price ?? '' }}"
                                                            data-type-seat-id="{{ $seat->type_seat_id ?? '' }}"
                                                            data-seat-id="{{ $seat->id ?? '' }}">
                                                            <div class="seat-item">
                                                                <!-- 3 cho ghế đôi -->
                                                                <span
                                                                    class="seat-double-svg-pro seat {{ getSeatClassStatus($seat->pivot->status ?? '') }}"></span>
                                                                <span
                                                                    class="seat-label-double-pro">{{ chr(65 + $row) . ($col + 1) }}
                                                                    {{ chr(65 + $row) . ($col + 2) }}</span>
                                                            </div>
                                                        </td>
                                                        @php $col++; @endphp
                                                    @else
                                                        <td class="box-item-pro"
                                                            data-seat-status="{{ $seat->pivot->status ?? '' }}"
                                                            data-seat-name="{{ $seat->name ?? '' }}"
                                                            data-seat-price="{{ $seat->pivot->price ?? '' }}"
                                                            data-type-seat-id="{{ $seat->type_seat_id ?? '' }}"
                                                            data-seat-id="{{ $seat->id ?? '' }}">
                                                            <div class="seat-item">
                                                                @switch($seat->type_seat_id ?? "")
                                                                    @case(1)
                                                                        <span
                                                                            class="seat-regular-svg-pro seat {{ getSeatClassStatus($seat->pivot->status ?? '') }}"></span>
                                                                        <span
                                                                            class="seat-label-pro">{{ chr(65 + $row) . $col + 1 }}</span>
                                                                    @break

                                                                    @case(2)
                                                                        <span
                                                                            class="seat-vip-svg-pro  seat {{ getSeatClassStatus($seat->pivot->status ?? '') }}"></span>
                                                                        <span
                                                                            class="seat-label-pro">{{ chr(65 + $row) . $col + 1 }}</span>
                                                                    @break
                                                                @endswitch

                                                            </div>
                                                        </td>
                                                    @endif
                                                @endfor
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                                <div class="legend">

                                    <div><span class="seat-regular-svg"></span> Ghế Thường
                                    </div>
                                    <div><span class="seat-vip-svg"></span> Ghế Vip</div>
                                    <div><span class="seat-double-svg"></span> Ghế Đôi</div>
                                    <div>
                                        <p>Tổng tiền:</p>
                                        <p id="total-price" class="fw-bold">0 VNĐ</p>
                                        <input type="hidden" name="totalPriceSeat" id="inputTotalPriceSeat">
                                    </div>
                                    <div>
                                        <p>Thời gian còn lại:</p>
                                        <p id="timer" class="fw-bold">8:16</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" id="checkOut" style="display:block">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h3 class="card-title mb-0 flex-grow-1">Thông tin Thanh toán</h3>
                                    </div><!-- end card header -->
                                    <div class="card-body mb-3">
                                        <div class="row">
                                            <div class="col-md-12">

                                                @php
                                                    $orderer = Auth::user();
                                                @endphp

                                                <table id="example"
                                                    class="table table-bordered mb-3 dt-responsive nowrap  align-middle"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th><span>Người đặt</span></th>
                                                            <th><span>Email</span></th>
                                                            <th><span>Số điện thoại</span></th>
                                                        </tr>
                                                    </thead>
                                                    {{-- <tbody>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                </tbody> --}}
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $orderer->name }}</td>
                                                            <td>{{ $orderer->email }}</td>
                                                            <td>{{ $orderer->phone }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                {{-- <div class="my-4">
                                                    <label class="form-label">Thẻ thành viên <span class="text-muted">(nếu
                                                            có)</span>:</label>
                                                    <input type="text" name="card" class="form-control"
                                                        placeholder="3047-1414-2012-3534">
                                                </div> --}}

                                                <div id="seatDetails" class="my-3">
                                                    <div class="info-seat-checkout m-2 d-flex justify-content-between my-2">
                                                        <div>
                                                            <b>GHẾ THƯỜNG</b> {{-- Ghế thường/ Ghế Vip/Ghế đôi   --}}
                                                        </div>
                                                        <div class="text-danger">
                                                            <span>2 x 45.000</span> <span> = 90.000 Vnđ</span>
                                                        </div>

                                                    </div>
                                                </div>





                                                <div class="combo-checkout mt-3">
                                                    <h4 class="p-3 mb-2  bg-light text-dark">Combo Ưu đãi</h4>

                                                    <div class="">
                                                        <table id="example"
                                                            class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                                            style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Ảnh</th>
                                                                    <th>Tên combo</th>
                                                                    <th>Mô tả</th>
                                                                    <th>Số lượng</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($combos as $combo)
                                                                    <tr>
                                                                        @php
                                                                            $url = $combo->img_thumbnail;

                                                                            if (!\Str::contains($url, 'http')) {
                                                                                $url = Storage::url($url);
                                                                            }
                                                                        @endphp

                                                                        <td>
                                                                            @if (!empty($combo->img_thumbnail))
                                                                                <img src="{{ $url }}"
                                                                                    alt=""
                                                                                    class="rounded-circle avatar-md">
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $combo->name }} - {{ $combo->price_sale }}
                                                                            VNĐ
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($combo->food as $item)
                                                                                <ul class="nav nav-sm flex-column">
                                                                                    <li class="nav-item mb-2">
                                                                                        <span
                                                                                            class="fw-semibold">{{ $item->type }}:
                                                                                        </span>
                                                                                        {{ $item->name }} x
                                                                                        ({{ $item->pivot->quantity }})
                                                                                    </li>
                                                                                </ul>
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            <div class="input-step step-primary">
                                                                                <button type="button"
                                                                                    class="quantity-btn decrease">-</button>
                                                                                <input type="number" readonly
                                                                                    name="quantity_combo[{{ $combo->id }}]"
                                                                                    class="product-quantity quantity-input"
                                                                                    data-combo-id="{{ $combo->id }}"
                                                                                    data-price-sale="{{ $combo->price_sale }}"
                                                                                    value="0" min="0"
                                                                                    max="10">
                                                                                <button type="button"
                                                                                    class="quantity-btn increase">+</button>
                                                                            </div>

                                                                        </td>
                                                                @endforeach

                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                {{-- Voucher giảm giá --}}
                                                {{-- <div class="box-voucher mt-3">
                                                    <h4 class="p-3 mb-2  bg-light text-dark">Giảm giá</h4>
                                                    <div class="info-voucher-checkout">

                                                        <div class="voucher-section mt-4">
                                                            <div class="voucher-title mx-2">
                                                                <h5>Poly Voucher</h5>
                                                            </div>
                                                            <form class="voucher-form" id="voucher-form" method="POST">
                                                                @csrf

                                                                <div class="row">
                                                                    <div class="col-md-10">
                                                                        <input type="text" name="code"
                                                                            class="form-control" id="voucher_code" required
                                                                            placeholder="Nhập mã voucher"
                                                                            @guest disabled @endguest>

                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <button class="btn btn-primary" type="submit"
                                                                            id="apply-voucher-btn"
                                                                            @guest disabled @endguest>Xác nhận
                                                                        </button>
                                                                    </div>


                                                                </div>

                                                            </form>
                                                            <div id="voucher-response"></div>
                                                        </div>



                                                        <div class="points-section mt-4">
                                                            <div class="points-title mx-2">
                                                                <h5>Điểm Poly</h5>
                                                            </div>
                                                            <form class="points-form" action="">
                                                                <table
                                                                    class="points-table table table-bordered dt-responsive nowrap table-striped align-middle"
                                                                    style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Điểm hiện có</th>
                                                                            <th>Nhập điểm</th>
                                                                            <th>Số tiền được giảm</th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>1900</td>
                                                                            <td><input type="text" class="form-control"
                                                                                    name="point_use" placeholder="Nhập điểm">
                                                                            </td>
                                                                            <td>= 0 Vnđ</td>
                                                                            <td align="right">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Đổi
                                                                                    điểm</button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                {{-- tong tien --}}
                                                <div class="total-price-checkout" id="getPriceOrder">
                                                    <div class="d-flex justify-content-end">
                                                        <p>Tổng tiền:</p>
                                                        <p class="text-danger total-price-checkout px-2" id="totalPrice">
                                                            105.000 VNĐ
                                                        </p>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <p>Số tiền được giảm:</p>
                                                        <p class="text-danger total-discount  px-2"
                                                            id="totalPriceReduced">0
                                                            VNĐ</p>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <p>Số tiền cần thanh toán:</p>
                                                        <p class="text-danger total-price-payment  px-2"
                                                            id="totalPricePaid">
                                                            105.000 VNĐ
                                                        </p>
                                                    </div>
                                                </div>


                                                {{-- phuong thuc thanh toan --}}
                                                <div class="box-payment-checkout">
                                                    <div class="text-info-checkout">
                                                        <div>

                                                            <span class="ic--baseline-payment"></span>
                                                        </div>
                                                        <div>
                                                            <h4 class="p-3 mb-2  bg-light text-dark">Phương thức thanh toán
                                                            </h4>
                                                        </div>
                                                    </div>

                                                    <div class="payment-checkout">
                                                        <div class="img-payment-checkout">

                                                            <div class=' mx-3'>
                                                                <input type="radio" name="payment_method"
                                                                    value='cash' id="payment-checkout-1">

                                                                <label for="payment-checkout-1"><img
                                                                        src="{{ asset('svg/cod.svg') }}"> Thanh toán tiền
                                                                    mặt</label>
                                                            </div>
                                                            {{-- <div>
                                                                        <input type="radio" name="payment_method"
                                                                            id="payment-checkout-2">
                                                                        <img src="{{ asset('theme/client/images/index_III/the-quoc-te.png') }}">
                                                                        <label for="payment-checkout-2">Thẻ quốc tế</label>
                                                                    </div>
                                                                    <div>
                                                                        <input type="radio" name="payment_method"
                                                                            id="payment-checkout-3">
                                                                        <img src="{{ asset('theme/client/images/index_III/vi-shopee-pay.png') }}">
                                                                        <label for="payment-checkout-3">Ví Shoppe Pay</label>
                                                                    </div> --}}
                                                            <div class=' mx-3'>
                                                                <input type="radio" name="payment_method"
                                                                    id="payment-checkout-5" value='vnpay'>
                                                                <label for="payment-checkout-5"> <img
                                                                        src="{{ asset('images/vn-pay.jpg') }}">
                                                                    VNPAY</label>
                                                            </div>
                                                            <div class=' mx-3'>
                                                                <input type="radio" name="payment_method"
                                                                    id="payment-checkout-4" value='momo'>

                                                                <label for="payment-checkout-4">
                                                                    <img
                                                                        src="{{ asset('theme/client/images/index_III/vi-momo.ico') }}">
                                                                    Ví MoMo</label>
                                                            </div>


                                                        </div>
                                                    </div>


                                                </div>
                                                {{-- realtime 10p --}}
                                                <div class="giu-cho-checkout bg-light mt-5">
                                                    <div class="row p-3 pb-0">
                                                        <div class="col-md-8">
                                                            <p>Vui lòng kiểm tra thông tin đầy đủ trước khi qua bước tiếp
                                                                theo.
                                                                <br>
                                                                *Vé mua rồi không hoàn trả lại dưới mọi hình thức.
                                                            </p>
                                                        </div>
                                                        <div class="col-md-4 d-flex">
                                                            <p>Thời gian còn lại:</p>
                                                            <h5 id="timer" class="text-danger px-2">9:56</h5>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 mb-4">

                <div class="card">
                    <div class="card-header border bg-opacity-75 bg-info-subtle ">
                        <h5 class="card-title mb-0 text-center">Thông tin phim</h5>
                    </div>
                    <div class="movie-info mt-3 d-flex">
                        <div class='img-movie'>
                            @php
                                $url = $showtime->movie->img_thumbnail;

                                if (!\Str::contains($url, 'http')) {
                                    $url = Storage::url($url);
                                }

                            @endphp
                            @if (!empty($showtime->movie->img_thumbnail))
                                <img src="{{ $url }}" width="100%">
                            @else
                                No image !
                            @endif

                        </div>
                        <div class='name-movie mx-3 '>
                            <h3 class='text-primary my-2'>{{ $showtime->movie->name }}</h3>
                            <div class="fs-5 mt-2">
                                <span>{{ $showtime->format }}</span>
                            </div>
                        </div>
                    </div>
                    <div class='card-header border-bottom-dashed border-2'>
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="my-2">Thể loại:</td>
                                        <td class="text-end fw-bold my-2">{{ $showtime->movie->category }}</td>
                                    </tr>
                                    <tr>
                                        <td class="my-2">Thời lượng: </td>
                                        <td class="text-end fw-bold my-2">{{ $showtime->movie->duration }} phút</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="my-2">Rạp chiếu: </td>
                                        <td class="text-end fw-bold my-2">{{ $showtime->cinema->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="my-2">Ngày chiếu</td>
                                        <td class="text-end fw-bold my-2">
                                            {{ \Carbon\Carbon::parse($showtime->date)->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="my-2">Giờ chiếu:</td>
                                        @php
                                            $startTime = \Carbon\Carbon::parse($showtime->start_time);
                                            $endTime = $startTime->copy()->addMinutes($showtime->movie->duration);
                                        @endphp
                                        <td class="text-end fw-bold my-2">
                                            {{ $startTime->format('H:i') }} ~ {{ $endTime->format('H:i') }}
                                    </tr>
                                    <tr>
                                        <td class="my-2">Phòng Chiếu: </td>
                                        <td class="text-end fw-bold my-2" id="cart-tax">P201</td>
                                    </tr>
                                    <tr>
                                        <td class="my-2">Ghế ngồi: </td>
                                        <td class="text-end fw-bold my-2" id="selected-seats"> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                {{-- <div class="text-end my-3" id="buttonAction">
                <button id="nextChooseSeat" class="btn btn-success btn-label right ms-auto"><i
                        class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Tiếp tục</button>
            </div> --}}
                <div class="d-flex align-items-start gap-3 my-3" id="buttonAction">
                    {{-- <button type="button" class="btn btn-link text-decoration-none btn-label previestab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Quay lại</button> --}}
                    <button type="button" id="nextChooseSeat"
                        class="btn btn-success btn-label right ms-auto nexttab nexttab w-50"><i
                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2 w-"></i>Tiếp Tục</button>
                </div>



            </div>

        </div>
    </form>


@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/mainstyle.css') }}">
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateButtonAction() {
            const buttonAction = document.getElementById('buttonAction');

            // Xóa nút "Tiếp tục"
            buttonAction.innerHTML = '';

            // Thêm nút "Quay lại" và "Thanh Toán"
            buttonAction.innerHTML =
                `<button type="button" id="backToChooseSeat" class="btn btn-link text-decoration-none w-50"> Quay lại</button>
                <button type="button" id="payNow"  class="btn btn-success btn-label right ms-auto  w-50 " ><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Thanh Toán</button>`;

            // Gắn sự kiện cho nút "Quay lại"
            document.getElementById('backToChooseSeat').addEventListener('click', function() {
                document.getElementById('checkOut').style.display = 'none';
                document.getElementById('chooseSeat').style.display = 'block';
                resetButtonAction(); // Quay về trạng thái nút ban đầu

            });
        }

        function resetButtonAction() {
            const buttonAction = document.getElementById('buttonAction');
            buttonAction.innerHTML =
                `<button type="button" id="nextChooseSeat" class="btn btn-success btn-label right ms-auto w-50" ><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Tiếp Tục</button>`;

            // Gắn lại sự kiện cho nút "Tiếp tục"
            document.getElementById('nextChooseSeat').addEventListener('click', function() {
                loadSeatsFromSession();
            });
        }
        // Chuyển từ phần chọn ghế đến phần thanh toán
        document.getElementById('nextChooseSeat').addEventListener('click', function() {
            loadSeatsFromSession();
        });

        // Quay lại phần chọn ghế từ phần thanh toán
        document.getElementById('backToChooseSeat').addEventListener('click', function() {
            document.getElementById('checkOut').style.display = 'none';
            document.getElementById('chooseSeat').style.display = 'block';
        });
    </script>
    {{-- js-ajax tăng giá và hiện thị ghế --}}
    <script>
        let selectedSeats = []; // Mảng lưu tên ghế đã chọn
        let selectedSeatIds = []; // Mảng lưu ID ghế đã chọn
        let totalPriceSeat = 0; // Tổng giá ghế đã chọn
        let selectedSeatsCount = 0; // Số ghế đã chọn

        // Hàm định dạng giá
        function formatPrice(price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ' VNĐ';
        }

        // Hàm toggle ghế (chọn hoặc bỏ chọn)
        function toggleSeat(element) {
            const status = element.getAttribute('data-seat-status');
            const seatName = element.getAttribute('data-seat-name'); // Ví dụ: "A1, A2"
            const seatId = element.getAttribute('data-seat-id'); // ID của ghế
            const seatPrice = parseInt(element.getAttribute('data-seat-price'), 10);
            const typeSeatId = parseInt(element.getAttribute('data-type-seat-id'), 10); // Kiểm tra loại ghế

            // Nếu ghế không khả dụng, báo lỗi
            if (status !== "available") {
                alert('Ghế này không khả dụng.');
                return;
            }

            const seatIndex = selectedSeats.indexOf(seatName);
            const isDoubleSeat = typeSeatId === 3; // Xác định loại ghế đôi

            if (seatIndex > -1) {
                // Bỏ chọn ghế
                selectedSeats.splice(seatIndex, 1); // Bỏ tên ghế
                selectedSeatIds.splice(seatIndex, 1); // Bỏ ID ghế
                totalPriceSeat -= seatPrice; // Giảm tổng giá
                selectedSeatsCount -= isDoubleSeat ? 2 : 1; // Giảm số ghế đã chọn
                element.querySelector('.seat').classList.remove('seat-selected');
            } else {
                // Thêm tên ghế và ID vào danh sách mà không cần kiểm tra giới hạn
                selectedSeats.push(seatName); // Thêm tên ghế vào danh sách
                selectedSeatIds.push(seatId); // Thêm ID ghế vào danh sách
                totalPriceSeat += seatPrice; // Cập nhật tổng giá
                selectedSeatsCount += isDoubleSeat ? 2 : 1; // Cập nhật số ghế đã chọn
                element.querySelector('.seat').classList.add('seat-selected');
            }

            // Cập nhật thông tin tổng giá và danh sách ghế đã chọn
            document.getElementById('total-price').textContent = formatPrice(totalPriceSeat);

            document.getElementById('selected-seats').textContent = selectedSeats.join(', ');

            // Gán giá trị tổng giá vào input
            document.getElementById('inputTotalPriceSeat').value = totalPriceSeat;

            // Cập nhật session với danh sách ID ghế đã chọn
            toggleSeatToSession(selectedSeatIds);
        }

        document.querySelectorAll('.box-item-pro').forEach(item => {
            item.addEventListener('click', function() {
                toggleSeat(this); // Gọi hàm toggleSeat với phần tử hiện tại
            });
        });

        function toggleSeatToSession(selectedSeatIds) {
            $.ajax({
                url: '{{ route('toggle-seat', $showtime) }}', // Đường dẫn tới route
                method: 'POST', // Phương thức POST
                contentType: 'application/json', // Định dạng dữ liệu
                data: JSON.stringify({
                    selectedSeatIds: selectedSeatIds, // Dữ liệu cần gửi
                }),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token
                },
                success: function(data) {
                    console.log(data); // Xử lý phản hồi thành công
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown); // Xử lý lỗi
                }
            });
        }

        function loadSeatsFromSession() {
            $.ajax({
                url: '{{ route('get-selected-seat') }}', // Đường dẫn tới route
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Thêm CSRF token vào headers
                },
                success: function(data) {
                    if (data.success) {
                        // Xóa nội dung cũ nếu có
                        $('#seatDetails').html('');

                        // Lặp qua từng loại ghế và đổ vào giao diện
                        data.data.seatDetails.forEach(function(seat) {
                            const seatHtml = `
                            <div class="info-seat-checkout m-2 d-flex justify-content-between my-2">
                            <div>
                                <b>${seat.name}</b> <!-- Loại ghế -->
                            </div>
                            <div class="text-danger">
                                <span>${seat.quantity} x ${seat.price.toLocaleString()} VNĐ</span>
                                <span> = ${(seat.quantity * seat.price).toLocaleString()} VNĐ</span>
                            </div>
                            </div> `;
                            $('#seatDetails').append(seatHtml); // Thêm vào phần HTML
                        });
                        document.getElementById('chooseSeat').style.display = 'none';
                        document.getElementById('checkOut').style.display = 'block';
                        updateButtonAction();
                        console.log(data); // Kiểm tra dữ liệu trả về
                    } else {
                        // Xử lý thông báo lỗi nếu có
                        console.error('Error:', data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 401) {
                        alert(jqXHR.responseJSON.message); // Hiển thị thông báo khi mã lỗi là 401
                    } else {
                        console.error('Error:', textStatus, errorThrown); // Xử lý lỗi khác
                    }
                }
            });
        }
    </script>

    {{-- Xử lý combo --}}
    <script>
        function getTotalPriceSeat() {
            const totalPriceSeatElement = document.getElementById('total-price'); // Lấy phần tử tổng giá
            return parseFloat(totalPriceSeatElement.textContent.replace(/\D/g, '')); // Trả về giá trị đã chuyển đổi
        }

        function getTotalPrice() {
            const totalPriceSeatElement = document.getElementById('totalPrice'); // Lấy phần tử tổng giá
            return parseFloat(totalPriceSeatElement.textContent.replace(/\D/g, '')); // Trả về giá trị đã chuyển đổi
        }

        function gettotalPriceReduced() {
            const totalPriceSeatElement = document.getElementById('totalPriceReduced'); // Lấy phần tử tổng giá
            return parseFloat(totalPriceSeatElement.textContent.replace(/\D/g, '')); // Trả về giá trị đã chuyển đổi
        }

        function getTotalPricePaid() {
            const totalPriceSeatElement = document.getElementById('totalPricePaid'); // Lấy phần tử tổng giá
            return parseFloat(totalPriceSeatElement.textContent.replace(/\D/g, '')); // Trả về giá trị đã chuyển đổi
        }

        function updatePrice() {
            // Lấy giá trị từ các hàm đã định nghĩa
            const totalPriceSeat = getTotalPriceSeat();
            const totalPrice = getTotalPrice();
            const totalPriceReduced = gettotalPriceReduced();
            const totalPricePaid = getTotalPricePaid();

            // Cập nhật hiển thị các giá trị
            document.getElementById('total-price').textContent = `${totalPriceSeat.toLocaleString('vi-VN')} VNĐ`;
            document.getElementById('totalPrice').textContent = `${totalPrice.toLocaleString('vi-VN')} VNĐ`;
            document.getElementById('totalPriceReduced').textContent = `${totalPriceReduced.toLocaleString('vi-VN')} VNĐ`;
            document.getElementById('totalPricePaid').textContent = `${totalPricePaid.toLocaleString('vi-VN')} VNĐ`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const decreaseBtns = document.querySelectorAll('.quantity-btn.decrease');
            const increaseBtns = document.querySelectorAll('.quantity-btn.increase');
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const totalPriceElement = document.getElementById('totalPrice');
            const totalPricePaidElement = document.getElementById('totalPricePaid');
            const totalPriceReducedElement = document.getElementById('totalPriceReduced');

            function calculateTotalPrice() {
                let comboTotalPrice = 0;

                quantityInputs.forEach(input => {
                    const quantity = parseInt(input.value);
                    const price = parseFloat(input.dataset.priceSale);
                    comboTotalPrice += quantity * price; // Cộng thêm giá trị từ combo
                });
                totalPrice = getTotalPriceSeat() + comboTotalPrice;
                // Cập nhật lại nội dung của thẻ <p>
                totalPriceElement.textContent = `${totalPrice.toLocaleString('vi-VN')} VNĐ`;

                // Cập nhật số tiền cần thanh toán (giả định không có giảm giá ở đây)
                const totalDiscount = parseFloat(totalPriceReducedElement.textContent.replace(/\D/g, '')) || 0;
                const totalPayment = totalPrice - totalDiscount;

                totalPricePaidElement.textContent = `${totalPayment.toLocaleString('vi-VN')} VNĐ`;
            }

            decreaseBtns.forEach((decreaseBtn, index) => {
                decreaseBtn.addEventListener('click', function() {
                    let currentValue = parseInt(quantityInputs[index].value);
                    if (currentValue > 0) {
                        quantityInputs[index].value = currentValue - 1;
                        calculateTotalPrice();
                    }
                });
            });

            increaseBtns.forEach((increaseBtn, index) => {
                increaseBtn.addEventListener('click', function() {
                    let currentValue = parseInt(quantityInputs[index].value);
                    if (currentValue < 8) {
                        quantityInputs[index].value = currentValue + 1;
                        calculateTotalPrice();
                    }
                });
            });

            // Khởi tạo tổng giá ngay khi trang được tải
            calculateTotalPrice();
            
        });
    </script>
    {{-- Xử lý thanh toán --}}
    <script>
        document.getElementById('payNow').addEventListener('click', function() {
            const formData = new FormData(document.getElementById('proceedPayment'));
            fetch('{{ route('payment', $showtime) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Đã có lỗi xảy ra.');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);

                    alert(data.message); // Hiển thị thông báo thành công
                })
                .catch(error => {
                    console.log(data);
                    alert(error.message); // Hiển thị thông báo lỗi
                });
        });
    </script>
@endsection
