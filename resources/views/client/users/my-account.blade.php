@extends('client.layouts.master')

@section('title')
    Tài khoản của tôi
@endsection

@section('content')

    <body>
        <div class="container" style="margin-top: 70px; margin-bottom: 100px;">
            <div class="my-account-tabs">
                <a href="#my-account" aria-controls="best" role="tab" data-toggle="tab">
                    <div class="my-account-tab" role="presentation">THÔNG TIN TÀI KHOẢN</div>
                </a>
                <a href="#">
                    <div class="my-account-tab">THẺ THÀNH VIÊN</div>
                </a>
                <a href="#cinema-journey" aria-controls="trand" role="tab" data-toggle="tab">
                    <div class="my-account-tab" role="presentation">LỊCH SỬ GIAO DỊCH</div>
                </a>
                <a href="#">
                    <div class="my-account-tab">ĐIỂM POLY</div>
                </a>
                <a href="#">
                    <div class="my-account-tab">VOUCHER</div>
                </a>
            </div>

            <div class="col-md-12">
                <div class="tab-content">
                    {{-- Thông tin tài khoản --}}
                    <div id="my-account" class="tab-pane "> {{-- active --}}
                        <form action="{{ route('my-account.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="my-account-upload-container">
                                <div class="my-account-image-upload-container" id="img_thumbnail" name="img_thumbnail">
                                    @php
                                        $url = $user->img_thumbnail;

                                        if (!\Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }

                                    @endphp
                                    @if (!empty($user->img_thumbnail))
                                        <img src="{{ $url }}">
                                    @else
                                        <img src="{{ asset('theme/client/images/user-dummy-img.jpg') }}">
                                    @endif

                                </div>
                                <div class="my-account-buttons">
                                    <input type="file" id="file-upload" name="img_thumbnail" accept="image/*"
                                        style="display: none;" />
                                    <label for="img_thumbnail" class="my-account-upload-btn" id="uploadBtn">Tải ảnh
                                        lên</label>
                                </div>

                            </div>

                            <div class="my-account-form-row">
                                <div class="my-account-form-group">
                                    <div class="my-account-mb-3">
                                        <label for="name"><span style="color: red;">*</span>&nbsp;Họ tên</label>
                                        <input type="text" class="my-account-form-control" placeholder="Họ và tên"
                                            name="name" id="name" value="{{ old('name', $user->name) }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="my-account-mb-3">
                                        <label for="phone"><span style="color: red;">*</span>&nbsp;Số điện thoại</label>
                                        <i class="fa fa-phone-square phone-icon"></i>
                                        <input type="text" id="phone" class="my-account-form-control" name="phone"
                                            placeholder="Nhập số điện thoại của bạn"
                                            value="{{ old('phone', $user->phone) }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="my-account-mb-3">
                                        <label for="birthday"><span style="color: red;">*</span>&nbsp;Ngày sinh</label>
                                        <i class="fa fa-calendar birthday-icon"></i>
                                        <input type="date" id="birthday" value="{{ old('birthday', $user->birthday) }}"
                                            class="my-account-form-control" name="birthday" placeholder="Ngày sinh"
                                            data-date-format="yyyy-mm-dd" />
                                        @error('birthday')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="my-account-mb-3">
                                        <a href="#" id="changePasswordBtn" class="my-account-d-block">Đổi mật
                                            khẩu?</a>
                                    </div>
                                </div>

                                <div class="my-account-form-group">
                                    <div class="my-account-mb-3">
                                        <label for="email"><span style="color: red;">*</span>&nbsp;Email</label>
                                        <i class="fa fa-envelope email-icon"></i>
                                        <input type="email" id="email" disabled class="my-account-form-control"
                                            name="email" placeholder="example@gmail.com"
                                            value="{{ old('email', $user->email) }}">
                                    </div>
                                    <div class="my-account-mb-3">
                                        <label for="gender">Giới tính</label>
                                        <i class="fa fa-male sex-icon"></i>
                                        <div class="my-account-input-icon">
                                            <select name="gender" id="" class="my-account-form-select">
                                                @foreach ($genders as $gender)
                                                    <option value="{{ $gender }}" @selected($user->gender == $gender)>
                                                        {{ $gender }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="my-account-mb-3">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" class="my-account-form-control"
                                            placeholder="Số nhà, đường, ngõ xóm" name="address" id="address"
                                            value="{{ old('address', $user->address) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="my-account-text-center my-account-my-3">
                                <button type="submit" class="my-account-btn"
                                    onclick="return confirm('Bạn có chắc chắn muốn cập nhật không?')">Cập nhật</button>
                            </div>
                        </form>
                    </div>

                    {{-- Hành trình điện ảnh --}}
                    <div id="cinema-journey" class="tab-pane active "> {{-- fade --}}
                        <div class="cinema-journey-container">
                            <table class="cinema-journey-table">
                                <thead class="cinema-journey-thead">
                                    <tr>
                                        <th class="cinema-journey-th">Mã Đặt vé</th>
                                        <th class="cinema-journey-th">Phim</th>
                                        <th class="cinema-journey-th">Giờ Chiếu</th> {{-- Ngày - Giờ chiếu -> giờ kết thúc --}}
                                        <th class="cinema-journey-th">Rạp </th> {{-- Tên Rạp - Tên phòng --}}
                                        <th class="cinema-journey-th">Ghế</th>
                                        <th class="cinema-journey-th">Trạng Thái</th>
                                        <th class="cinema-journey-th">Tổng tiền</th>
                                        <th class="cinema-journey-th">Thao tác</th>

                                    </tr>
                                </thead>
                                <tbody class="cinema-journey-tbody">
                                    @if ($tickets->count() > 0)
                                        @foreach ($tickets as $ticket)
                                            @php
                                                // Nhóm các ticketMovie theo movie_id
                                                $ticketSeatsByMovie = $ticket->ticketSeat->groupBy('movie_id');
                                            @endphp

                                            @foreach ($ticketSeatsByMovie as $ticketSeats)
                                                <tr>
                                                    <td class="cinema-journey-td">{{ $ticket->code }}</td>
                                                    <td class="cinema-journey-td">

                                                        @php
                                                            // Lấy thông tin movie từ ticketSeat đầu tiên trong nhóm

                                                            $url = $ticketSeats->first()->movie->img_thumbnail;

                                                            if (!\Str::contains($url, 'http')) {
                                                                $url = Storage::url($url);
                                                            }
                                                        @endphp


                                                        <img class="cinema-journey-movie-poster"
                                                            src="{{ $url }}" alt="movie_img" />
                                                        <p class="cinema-journey-movie-title" align='left'>
                                                            {{ $ticketSeats->first()->movie->name }}
                                                        </p>



                                                    </td>
                                                    <td class="cinema-journey-td">
                                                        {{ \Carbon\Carbon::parse($ticketSeats->first()->showtime->date)->format('d-m-Y') }}
                                                        <br />
                                                        {{ \Carbon\Carbon::parse($ticketSeats->first()->showtime->start_time)->format('H:i') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($ticketSeats->first()->showtime->end_time)->format('H:i') }}
                                                    </td>
                                                    <td class="cinema-journey-td">
                                                        {{ $ticketSeats->first()->showtime->cinema->name }} -
                                                        {{ $ticketSeats->first()->room->name }}
                                                    </td>


                                                    <td class="cinema-journey-td">

                                                        @foreach ($ticketSeats as $item)
                                                            {{ $item->seat->name }}
                                                        @endforeach
                                                    </td>

                                                    <td class="cinema-journey-td">{{ $ticket->status }}</td>
                                                    <td class="cinema-journey-td">
                                                        {{ number_format($ticket->total_price, 0, ',', '.') }}đ
                                                    </td>
                                                    <td class="cinema-journey-td">
                                                        {{-- href="detail-ticket/{{ $ticket->id }}"  --}}
                                                        <a href="{{ route('ticketDetail', $ticket->id) }}" class="bold btn-detail-ticket">
                                                            Chi tiết
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="cinema-journey-td" colspan="8">Bạn chưa có giao dịch nào !</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            {{ $tickets->links() }}
                        </div>
                    </div>

                    {{-- Chi tiết giao dịch --}}

                    <div id="detail-ticket" class="tab-pane fade">
                        <div class="row mb-3 title-detail">
                            <h3>Chi tiết giao dịch #4811201174585152</h3>
                        </div>
                        <div class="content-detail">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="code-qr">
                                        <p class="text-img bold">Mã quét</p>

                                        <p><b>Ngày mua hàng:</b> 09/09/2024</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img width="150px" src="{{ asset('theme/client/images/img-qr.png') }}"
                                        alt="">
                                </div>
                            </div>

                            <div class="box-address">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="address-detail">
                                            <b>Địa chỉ thanh toán</b>
                                            <p>NGuyễn Viết Sơn</p>
                                            <p>Xã Tiên Phương, huyện Chương Mỹ, Hà Nội</p>
                                            <p>sonnvph33874@fpt.edu.vn</p>
                                            <p>0987654321</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="payment-checkout-detail">
                                            <b>Phương thức thanh toán</b>
                                            <p>MOMO - 65k/vé</p>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row info-detail">

                                <div class="col-md-12">
                                    <div>
                                        <b> Thông tin giao dịch</b>
                                    </div>
                                    <div>
                                        <button>In hóa đơn</button>
                                    </div>

                                </div>




                            </div>

                            <div class="row box-detail-history">
                                <div class="row">
                                    <div class="col-md-12" align='center'>
                                        CHI TIẾT GIAO DỊCH
                                    </div>
                                </div>

                            </div>

                            <div class="table-history">
                                <div class="row">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Phim</th>
                                                <th>Suất chiếu</th>
                                                <th>Vé</th>
                                                <th>Combo</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Vây hãm trên không</td>
                                                <td>
                                                    <b>Poly Mỹ đình</b> <br>
                                                    <p>Poly Room 01</p>
                                                    <p>09/09/2024</p>
                                                    <p>20:50 - 22:33</p>
                                                </td>
                                                <td>
                                                    <b>VIP</b>
                                                    <p>E1, E2</p>
                                                    <p>130.000đ</p> {{-- 65k x 2 --}}
                                                </td>
                                                <td>
                                                    <b>Combo Poly 49k x 3</b>
                                                    <p>147.000đ</p> {{-- 49k x 3 --}}
                                                </td>
                                                <td>
                                                    <p>277.000đ</p>
                                                </td>
                                            </tr>


                                            <tr>
                                                <th colspan="5" class="total-detail" align="right">Tổng cộng:
                                                    277.000đ</th>
                                            </tr>
                                        </tbody>
                                        {{-- <tfoot>

                                        </tfoot> --}}
                                    </table>
                                    <div class="back-list-history">
                                        <a href="#cinema-journey" aria-controls="trand" role="tab"
                                            data-toggle="tab">
                                            << Trở về</a>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>
    <!-- Modal Đổi mật khẩu -->
    <div class="my-account-overlay" id="overlay">
        <div class="my-account-modal" id="changePasswordForm">
            <form action="{{ route('my-account.changePassword') }}" method="post">
                @csrf
                @method('PUT')
                <div class="my-account-mb-3">
                    <label for="old_password"><span style="color: red;">*</span>&nbsp;Mật khẩu hiện tại</label>
                    <input type="password" class="my-account-form-control" id="old_password" name="old_password"
                        placeholder="Nhập mật khẩu hiện tại">
                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-account-mb-3">
                    <label for="password"><span style="color: red;">*</span>&nbsp;Mật khẩu mới</label>
                    <input type="password" class="my-account-form-control" id="password" name="password"
                        placeholder="Nhập mật khẩu mới">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-account-mb-3">
                    <label for="password_confirmation"><span style="color: red;">*</span>&nbsp;Nhập lại mật khẩu
                        mới</label>
                    <input type="password" class="my-account-form-control" id="password_confirmation"
                        name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-account-text-center">
                    <button type="submit" class="my-account-btn"
                        onclick="return confirm('Bạn có chắc chắn muốn đổi mật khẩu không?')">Xác nhận</button>
                    <button type="button" class="my-account-btn" id="closeChangePassword">Hủy</button>
                </div>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    </body>
@endsection
