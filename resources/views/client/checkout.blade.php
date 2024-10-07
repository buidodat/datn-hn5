@extends('client.layouts.master')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="st_dtts_wrapper float_left">
        <div class="container container-choose-seat">
            <div class="row">
                <div class="mb-3 title-choose-seat">

                    <a href="/">Trang chủ ></a> <a href="#">Đặt vé ></a> <a
                        href="">{{ $showtime->movie->name }}</a>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 box-checkout">
                    <div class="st_dtts_left_main_wrapper float_left">
                        <div class="row">
                            <div class="col-md-12 box-list-status-seat">
                                <div class="text-info-checkout">
                                    <div>
                                        <span class="ei--user"></span>
                                    </div>
                                    <div>
                                        <h4>Thông tin thanh toán</h4>
                                    </div>
                                </div>
                                {{-- thong tin --}}
                                <div class="">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Họ tên:</th>
                                                {{-- <th>Số điện thoại</th> --}}
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ Auth::user()->name }}</td>
                                                {{-- <td>0987654321</td> --}}
                                                <td>{{ Auth::user()->email }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <hr>
                                <div class="info-seat-checkout">
                                    <div>
                                        <p>GHẾ THƯỜNG</p>
                                    </div>
                                    <div>
                                        <span>2 x 45.000</span> <span> = 90.000 Vnđ</span>
                                    </div>
                                </div>
                                {{-- combo, voucher, diem --}}
                                <div class="box-combo-uu-dai">
                                    <div class="text-info-checkout">
                                        <div>
                                            {{-- <span class="ei--user"></span> --}}
                                            <span class="map--food"></span>
                                        </div>
                                        <div>
                                            <h4>Combo Ưu Đãi</h4>
                                        </div>
                                    </div>
                                    <div class="combo-uu-dai">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Ảnh minh họa</th>
                                                    <th>Tên combo</th>
                                                    <th>Mô tả</th>
                                                    <th>Số lượng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td>
                                                            @php
                                                                $url = $item->img_thumbnail;

                                                                if (!\Str::contains($url, 'http')) {
                                                                    $url = Storage::url($url);
                                                                }
                                                            @endphp
                                                            @if (!empty($item->img_thumbnail))
                                                                <img src="{{ $url }}" alt="" width="100px"
                                                                    height="60px">
                                                            @endif
                                                        </td>
                                                        {{-- <td>{{ $item->name }} - {{ number_format($item->price_sale) }} Vnđ
                                                    </td> --}}
                                                        <td>{{ $item->name }} - <span class="combo-price"
                                                                data-price="{{ $item->price_sale }}">{{ number_format($item->price_sale) }}</span>Vnđ
                                                        </td>

                                                        <td>
                                                            @foreach ($item->comboFood as $value)
                                                                @foreach ($foods as $food)
                                                                    @if ($value->food_id == $food->id)
                                                                        <ul class="nav nav-sm flex-column">
                                                                            <li class="nav-item mb-2">
                                                                                <span
                                                                                    class="fw-semibold">{{ $food->type }}:
                                                                                </span>
                                                                                {{ $food->name }} x
                                                                                ({{ $value->quantity }})
                                                                            </li>
                                                                        </ul>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        </td>

                                                        <td>
                                                            <div class="quantity-container">
                                                                <button class="quantity-btn decrease">-</button>
                                                                <input type="text" class="quantity-input" name="combo"
                                                                    value="0" min="1" max="10" readonly>
                                                                <button class="quantity-btn increase">+</button>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-voucher">
                                        <div class="text-info-checkout">
                                            <div>
                                                {{-- <span class="ei--user"></span> --}}
                                                <span class="mdi--voucher"></span>
                                            </div>
                                            <div>
                                                <h4>Giảm giá</h4>
                                            </div>
                                        </div>
                                        <div class="info-voucher-checkout">

                                            {{-- <div class="voucher-section">
                                                <div class="voucher-title">Poly Voucher</div>
                                                <form class="voucher-form" id="voucher-form" method="POST"  action="{{ route('applyVoucher') }}">
                                                    @csrf
                                                    <label for="voucher_code">Vui lòng nhập mã voucher vào ô trống phía dưới
                                                        để được giảm giá!</label> <br>
                                                    <div class="form-row">
                                                        <input type="text" name="code" id="voucher_code" placeholder="Nhập mã voucher">
                                                        <button type="submit">Xác nhận</button>
                                                    </div>
                                                </form>
                                            </div> --}}

                                            <div class="voucher-section">
                                                <div class="voucher-title">Poly Voucher</div>
                                                <form class="voucher-form" id="voucher-form" method="POST">
                                                    @csrf
                                                    <label for="voucher_code">Vui lòng nhập mã voucher vào ô trống phía
                                                        dưới để được giảm giá!</label> <br>
                                                    <div class="form-row">
                                                        <input type="text" name="code" id="voucher_code" required
                                                            placeholder="Nhập mã voucher" @guest disabled @endguest>

                                                        <button type="submit" id="apply-voucher-btn"
                                                            @guest disabled @endguest>Xác nhận
                                                        </button>
                                                    </div>

                                                </form>
                                                <div id="voucher-response"></div>
                                            </div>


                                            {{-- diem --}}
                                            <div class="points-section">
                                                <div class="points-title">Điểm Poly</div>
                                                <form class="points-form" action="">
                                                    <table class="points-table">
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
                                                                <td><input type="text" name="point_use"
                                                                        placeholder="Nhập điểm"></td>
                                                                <td>= 0 Vnđ</td>
                                                                <td>
                                                                    <button type="submit">Đổi điểm</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- tong tien --}}
                                <div class="total-price-checkout">
                                    <div>
                                        <p>Tổng tiền:</p>
                                        <p class="text-danger total-price-checkout">
                                            {{ number_format(session('total_price', 0), 0, ',', '.') }} Vnđ
                                        </p>
                                        <input type="text" name="total-price" id="total-price" value="" hidden
                                            readonly>
                                    </div>
                                    <div>
                                        <p>Số tiền được giảm:</p>
                                        <p class="text-danger total-discount">0 Vnđ</p>
                                    </div>
                                    <div>
                                        <p>Số tiền cần thanh toán:</p>
                                        <p class="text-danger total-price-payment">
                                            {{ number_format(session('total_price', 0), 0, ',', '.') }} Vnđ</p>
                                    </div>
                                </div>
                                {{-- phuong thuc thanh toan --}}
                                <div class="box-payment-checkout">
                                    <div class="text-info-checkout">
                                        <div>
                                            {{-- <span class="ei--user"></span> --}}
                                            <span class="ic--baseline-payment"></span>
                                        </div>
                                        <div>
                                            <h4>Phương thức thanh toán</h4>
                                        </div>
                                    </div>
                                    <div class="payment-checkout">
                                        <div>
                                            <p>Chọn thẻ thanh toán</p>
                                        </div>
                                        <hr>
                                        <div class="img-payment-checkout">
                                            <form action="">
                                                <div>
                                                    <input type="radio" name="payment-checkout" id="payment-checkout-1">
                                                    <img src="{{ asset('theme/client/images/index_III/the-noi-dia.png') }}"
                                                        alt="">
                                                    <label for="payment-checkout-1">Thẻ nội địa</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="payment-checkout" id="payment-checkout-2">
                                                    <img src="{{ asset('theme/client/images/index_III/the-quoc-te.png') }}"
                                                        alt="">
                                                    <label for="payment-checkout-2">Thẻ quốc tế</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="payment-checkout" id="payment-checkout-3">
                                                    <img src="{{ asset('theme/client/images/index_III/vi-shopee-pay.png') }}"
                                                        alt="">
                                                    <label for="payment-checkout-3">Ví Shoppe Pay</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="payment-checkout" id="payment-checkout-4">
                                                    <img src="{{ asset('theme/client/images/index_III/vi-momo.ico') }}"
                                                        alt="">
                                                    <label for="payment-checkout-4">Ví MoMo</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="payment-checkout"
                                                        id="payment-checkout-5">
                                                    <img src="{{ asset('theme/client/images/index_III/vi-zalo-pay.png') }}"
                                                        alt="">
                                                    <label for="payment-checkout-5">Ví ZaloPay</label>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- realtime 10p --}}
                                <div class="giu-cho-checkout">
                                    <div>
                                        <p>Vui lòng kiểm tra thông tin đầy đủ trước khi qua bước tiếp theo. <br>
                                            *Vé mua rồi không hoàn trả lại dưới mọi hình thức.</p>
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
                                        <li>Ghế ngồi: <span id="selected-seats"
                                                class="bold">{{ implode(', ', session('selected_seats', [])) }}</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="total-price-choose-seat float_left">
                                    {{-- <form action="">
                                        <button type="submit">Tiếp tục</button>
                                    </form> --}}
                                    {{-- Thanh toán vnpay --}}
                                    <form action="{{ url('/vnpay-payment') }}" method="POST">
                                        @csrf
                                        <button type="submit" name="redirect">Thanh toán VNPAY</button>
                                    </form>
                                </div>

                                <div class="total-price-choose-seat float_left">
                                    {{-- Form thanh toán Momo --}}
                                    <form action="{{ route('momo.payment') }}" method="POST">
                                        @csrf
                                        <button type="submit" name="payUrl">Thanh toán MOMO</button>
                                    </form>
                                </div>

                                <div class="total-price-choose-seat float_left">
                                    {{-- Form thanh toán ZaloPay --}}
                                    <form action="{{ url('/zalopay-payment') }}" method="POST">
                                        @csrf
                                        <button type="submit" name="redirect">Thanh toán ZaloPay</button>
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

@section('styles')
    <link rel="stylesheet" href="{{ asset('theme/client/css/checkout.css') }}">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var routeUrl = "{{ route('applyVoucher') }}";
        var csrfToken = "{{ csrf_token() }}";

        let sessionTotalPrice = parseInt("{{ session('total_price', 0) }}");
        let discountAmount = 0; // Số tiền được giảm

        const totalDiscountElement = document.querySelector('.total-discount');


        // document.addEventListener('DOMContentLoaded', function() {
        //     const decreaseBtns = document.querySelectorAll('.quantity-btn.decrease'); // dấu trừ
        //     const increaseBtns = document.querySelectorAll('.quantity-btn.increase'); // dấu cộng
        //     const quantityInputs = document.querySelectorAll('.quantity-input');
        //     const totalPriceElement = document.querySelector('.total-price-checkout .total-price-checkout');
        //     const totalPriceInput = document.getElementById('total-price');
        //     const totalDiscountElement = document.querySelector('.total-discount');
        //     const totalPaymentElement = document.querySelector('.total-price-payment');

        //     let sessionTotalPrice = parseInt("{{ session('total_price', 0) }}");
        //     let discountAmount = 0; // Số tiền được giảm

        //     // Hàm tính tổng tiền
        //     function calculateTotal() {
        //         let totalPrice = sessionTotalPrice; // Bắt đầu từ tổng tiền trong session

        //         quantityInputs.forEach(input => {
        //             const quantity = parseInt(input.value); // chuyển giá trị thành số nguyên
        //             const pricePerCombo = parseInt(input.closest('tr').querySelector('.combo-price').dataset
        //                 .price);
        //             totalPrice += quantity * pricePerCombo;
        //         });

        //         // Cập nhật tổng tiền và số tiền thanh toán
        //         totalPriceElement.textContent = totalPrice.toLocaleString() + ' Vnđ';
        //         totalPriceInput.value = totalPrice; // Cập nhật giá trị cho ô input ẩn

        //         // Tính số tiền cần thanh toán
        //         let totalPayment = totalPrice - discountAmount;
        //         totalPayment = Math.max(totalPayment, 0); // Đảm bảo không âm

        //         // Cập nhật giao diện
        //         totalPaymentElement.textContent = totalPayment.toLocaleString() + ' Vnđ';
        //     }

        //     // Sự kiện khi bấm nút tăng số lượng
        //     increaseBtns.forEach(button => {
        //         button.addEventListener('click', function() {
        //             const input = this.closest('.quantity-container').querySelector(
        //                 '.quantity-input');
        //             let currentValue = parseInt(input.value);
        //             const max = parseInt(input.getAttribute('max'));
        //             if (currentValue < max) { // Chỉ tăng nếu giá trị nhỏ hơn max
        //                 input.value = currentValue + 1;
        //                 calculateTotal(); // Cập nhật tổng tiền
        //             }
        //         });
        //     });

        //     // Sự kiện khi bấm nút giảm số lượng
        //     decreaseBtns.forEach(button => {
        //         button.addEventListener('click', function() {
        //             const input = this.closest('.quantity-container').querySelector(
        //                 '.quantity-input');
        //             let currentValue = parseInt(input.value);
        //             if (currentValue > 0) { // Chỉ giảm khi giá trị lớn hơn 0
        //                 input.value = currentValue - 1;
        //                 calculateTotal(); // Cập nhật tổng tiền
        //             }
        //         });
        //     });

        //     function attachCancelVoucherEvent() {
        //         $('#cancel-voucher-btn').on('click', function() {
        //             // Phục hồi giá trị và nút bấm về trạng thái ban đầu
        //             $('#voucher-form')[0].reset();
        //             $('#voucher-response').html('');

        //             // Lấy giá trị tổng tiền ban đầu và định dạng lại
        //             var originalTotalPrice = parseInt($('#total-price').val());
        //             $('.total-price-payment').text(originalTotalPrice.toLocaleString() + ' Vnđ');
        //             $('.total-discount').text('0 Vnđ');

        //             // Cập nhật lại trạng thái nút
        //             $('#apply-voucher-btn').attr('disabled', false);

        //             // Cập nhật lại discountAmount về 0
        //             discountAmount = 0;
        //             calculateTotal(); // Tính lại tổng tiền thanh toán sau khi hủy voucher
        //         });
        //     }

        //     // Code xử lý chính
        //     $('#voucher-form').on('submit', function(e) {
        //         e.preventDefault();

        //         $('#apply-voucher-btn').attr('disabled', true);

        //         var formData = {
        //             code: $('#voucher_code').val(),
        //             _token: csrfToken
        //         };

        //         $.ajax({
        //             url: routeUrl,
        //             type: "POST",
        //             data: formData,
        //             success: function(response) {
        //                 var discountAmountReceived = response.discount;
        //                 discountAmount = discountAmountReceived; // Cập nhật discountAmount
        //                 var discountAmountFormatted = discountAmountReceived.toLocaleString();

        //                 $('#voucher-response').html(`
        //                     <div class="t-success">${response.success}</div>
        //                     <div class="show-text">
        //                         <span>Voucher: <b>${response.voucher_code}</b></span>
        //                         <span>Giảm giá: <b>${discountAmountFormatted}</b> Vnđ</span>
        //                         <button id="cancel-voucher-btn" data-voucher-id="${response.id}">Hủy</button>
        //                     </div>
        //                 `);

        //                 var totalPrice = parseInt($('#total-price').val());
        //                 var totalPricePayment = totalPrice - discountAmount;

        //                 $('.total-price-payment').text(totalPricePayment.toLocaleString() + ' Vnđ');
        //                 $('.total-discount').text(discountAmountFormatted.toLocaleString() + ' Vnđ');

        //                 $('#apply-voucher-btn').attr('disabled', false);
        //                 attachCancelVoucherEvent();
        //             },
        //             error: function(xhr) {
        //                 var error = xhr.responseJSON.error || 'Voucher không hợp lệ';
        //                 showModalError(error);
        //                 $('#apply-voucher-btn').attr('disabled', false);
        //             }
        //         });
        //     });

        //     function showModalError(errorMessage) {
        //         const modalHTML = `
        //             <div id="error-modal" class="modal">
        //                 <div class="modal-content" >
        //                     <p class="text-error">${errorMessage}</p>
        //                     <span class="close-modal button-error">Hủy</span>
        //                 </div>
        //             </div>
        //         `;

        //         $('body').append(modalHTML);
        //         $('#error-modal').css('display', 'block');
        //         $('.close-modal').on('click', function() {
        //             $('#error-modal').remove();
        //         });

        //         $(window).on('click', function(event) {
        //             if ($(event.target).is('#error-modal')) {
        //                 $('#error-modal').remove();
        //             }
        //         });
        //     }

        //     // Tính toán ban đầu khi trang được tải
        //     calculateTotal();
        // });

        // Thời gian đếm ngược (10 phút = 600 giây)
        // let timeLeft = 600; // 600 giây tương đương 10 phút
        // const timerElement = document.getElementById('timer');

        // // Hàm đếm ngược thời gian
        // const countdown = setInterval(() => {
        //     // Tính số phút và giây còn lại
        //     const minutes = Math.floor(timeLeft / 60);
        //     const seconds = timeLeft % 60;

        //     // Hiển thị thời gian còn lại ở định dạng mm:ss
        //     timerElement.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

        //     // Giảm thời gian còn lại
        //     timeLeft--;

        //     // Khi thời gian kết thúc (hết 0 giây)
        //     if (timeLeft < 0) {
        //         clearInterval(countdown); // Dừng đếm ngược

        //         // Hiển thị thông báo và quay về trang chủ
        //         alert('Hết thời gian! Bạn sẽ được chuyển về trang chủ.');
        //         window.location.href = '/'; // Điều hướng về trang chủ ("/")
        //     }
        // }, 1000); // Cập nhật mỗi giây
    </script>
@endsection
