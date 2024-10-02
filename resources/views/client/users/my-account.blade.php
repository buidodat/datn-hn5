@extends('client.layouts.master')

@section('title')
Tài khoản của tôi
@endsection

@section('content')

<body>
    <div class="container" style="margin-top: 70px; margin-bottom: 100px;">
        <div class="my-account-tabs">
            <a href="#my-account" aria-controls="best" role="tab" data-toggle="tab">
                <div class="my-account-tab" role="presentation">Thông tin tài khoản</div>
            </a>
            <a href="#">
                <div class="my-account-tab">THẺ THÀNH VIÊN</div>
            </a>
            <a href="#cinema-journey" aria-controls="trand" role="tab" data-toggle="tab">
                <div class="my-account-tab" role="presentation">Hành trình điện ảnh</div>
            </a>
            <a href="#">
                <div class="my-account-tab">ĐIỂM BETA</div>
            </a>
            <a href="#">
                <div class="my-account-tab">VOUCHER</div>
            </a>
        </div>
        
        <div class="col-md-12">
            <div class="tab-content">
                {{-- Thông tin tài khoản --}}
                <div id="my-account" class="tab-pane active">
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
                                    @error("name")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="my-account-mb-3">
                                    <label for="phone"><span style="color: red;">*</span>&nbsp;Số điện thoại</label>
                                    <i class="fa fa-phone-square phone-icon"></i>
                                    <input type="text" id="phone" class="my-account-form-control" name="phone"
                                        placeholder="Nhập số điện thoại của bạn"
                                        value="{{ old('phone', $user->phone) }}">
                                    @error("phone")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="my-account-mb-3">
                                    <label for="birthday"><span style="color: red;">*</span>&nbsp;Ngày sinh</label>
                                    <i class="fa fa-calendar birthday-icon"></i>
                                    <input type="date" id="birthday" value="{{ old('birthday', $user->birthday) }}"
                                        class="my-account-form-control" name="birthday" placeholder="Ngày sinh"
                                        data-date-format="yyyy-mm-dd" />
                                    @error("birthday")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="my-account-mb-3">
                                    <a href="#" id="changePasswordBtn" class="my-account-d-block">Đổi mật khẩu?</a>
                                </div>
                            </div>

                            <div class="my-account-form-group">
                                <div class="my-account-mb-3">
                                    <label for="email"><span style="color: red;">*</span>&nbsp;Email</label>
                                    <i class="fa fa-envelope email-icon"></i>
                                    <input type="email" id="email" disabled class="my-account-form-control" name="email"
                                        placeholder="example@gmail.com" value="{{ old('email', $user->email) }}">
                                </div>
                                <div class="my-account-mb-3">
                                    <label for="gender">Giới tính</label>
                                    <i class="fa fa-male sex-icon"></i>
                                    <div class="my-account-input-icon">
                                        <select name="gender" id="" class="my-account-form-select">
                                            @foreach ($genders as $gender)
                                            <option value="{{ $gender }}" @selected($user->gender == $gender)>{{ $gender
                                                }}
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
                <div id="cinema-journey" class="tab-pane fade">
                    <div class="cinema-journey-container">
                        <table class="cinema-journey-table">
                            <thead class="cinema-journey-thead">
                                <tr>
                                    <th class="cinema-journey-th">Mã Hóa Đơn</th>
                                    <th class="cinema-journey-th">Phim</th>
                                    <th class="cinema-journey-th">Rạp Chiếu</th>
                                    <th class="cinema-journey-th">Suất Chiếu</th>
                                    <th class="cinema-journey-th">Ghế Đã Đặt</th>
                                    <th class="cinema-journey-th">Combo/Package</th>
                                    <th class="cinema-journey-th">Ngày Đặt</th>
                                    <th class="cinema-journey-th">Điểm</th>
                                </tr>
                            </thead>
                            <tbody class="cinema-journey-tbody">
                                <tr>
                                    <td class="cinema-journey-td">4811201174585152</td>
                                    <td class="cinema-journey-td">
                                        <img src="{{ asset('theme/client/images/image.png') }}" alt="Movie Poster"
                                            class="cinema-journey-movie-poster" />
                                        <p class="cinema-journey-movie-title">Ma Da</p>
                                    </td>
                                    <td class="cinema-journey-td">Beta Mỹ Đình P1</td>
                                    <td class="cinema-journey-td">27/08/2024 16:00</td>
                                    <td class="cinema-journey-td">2D Happy Day V.I.P F5, F6, F8, F7<br />Tổng tiền:
                                        180.000 đ</td>
                                    <td class="cinema-journey-td">
                                        Sweet Combo 69oz<br />Số lượng: 2<br />Tổng tiền: 176.000 đ
                                    </td>
                                    <td class="cinema-journey-td">27/08/2024 15:54</td>
                                    <td class="cinema-journey-td">
                                        +23000 Điểm tích lũy<br />
                                        - 0 Điểm tiêu dùng<br />
                                        Điểm hết hạn vào 26/10/2024 23:59
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
                @error("old_password")
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-account-mb-3">
                <label for="password"><span style="color: red;">*</span>&nbsp;Mật khẩu mới</label>
                <input type="password" class="my-account-form-control" id="password" name="password"
                    placeholder="Nhập mật khẩu mới">
                @error("password")
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

{{--
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
</body>


@endsection