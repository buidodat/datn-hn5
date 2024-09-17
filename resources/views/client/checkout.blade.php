@extends('client.layouts.master')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="st_dtts_wrapper float_left">
        <div class="container container-choose-seat">
            <div class="row">
                <div class="mb-3 title-choose-seat">

                    <a href="">Trang chủ ></a> <a href="">Đặt vé ></a> <a href="">Phim Shin Cậu Bé Bút
                        Chì: Nhật Ký Khủng Long Của Chúng Mình</a>
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

                                <div class="">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Họ tên:</th>
                                                <th>Số điện thoại</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Nguyễn Viết Sơn</td>
                                                <td>0987654321</td>
                                                <td>sonnvph33874@fpt.edu.vn</td>
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
                                                        <td>{{ $item->name }} - {{ number_format($item->price_sale) }} VNĐ
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
                                                                <input type="text" class="quantity-input" value="0"
                                                                    min="1">
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
                                            <div class="voucher-section">
                                                <div class="voucher-title">Poly Voucher</div>
                                                <form class="voucher-form" action="">
                                                    <label for="voucher">Vui lòng nhập mã voucher vào ô trống phía dưới để
                                                        được giảm giá!</label> <br>
                                                    <div class="form-row">
                                                        <input type="text" name="voucher" id="voucher"
                                                            placeholder="Nhập mã voucher">
                                                        <button type="submit">Xác nhận</button>
                                                    </div>
                                                </form>
                                            </div>
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
                                                                <td>= 0 VNĐ</td>
                                                                <td><button type="submit">Đổi điểm</button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="total-price-checkout">
                                    <div>
                                        <p>Tổng tiền:</p>
                                        <p class="text-danger">190.000 Vnđ</p>
                                    </div>
                                    <div>
                                        <p>Số tiền được giảm:</p>
                                        <p class="text-danger">0 Vnđ</p>
                                    </div>
                                    <div>
                                        <p>Số tiền cần thanh toán:</p>
                                        <p class="text-danger">190.000 Vnđ</p>
                                    </div>
                                </div>
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
                                                    <input type="radio" name="payment-checkout" id="payment-checkout-5">
                                                    <img src="{{ asset('theme/client/images/index_III/vi-zalo-pay.png') }}"
                                                        alt="">
                                                    <label for="payment-checkout-5">Ví ZaloPay</label>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="giu-cho-checkout">
                                    <div>
                                        <p>Vui lòng kiểm tra thông tin đầy đủ trước khi qua bước tiếp theo. <br>
                                            *Vé mua rồi không hoàn trả lại dưới mọi hình thức.</p>
                                    </div>
                                    <div>
                                        <p>Thời gian còn lại: 9:50</p>
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
                                        {{-- <li class="bold"> Tổng tiền: <span class="bold">190.000đ</span></li> --}}
                                    </ul>
                                </div>

                                <div class="total-price-choose-seat float_left">
                                    <form action="">
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
    {{-- <script>
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
    </script> --}}
@endsection
