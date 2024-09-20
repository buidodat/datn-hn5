@extends('client.layouts.master')

@section('title')
Tài khoản của tôi
@endsection

@section('content')
<body>
    <div class="my-account-container">
        <div class="my-account-tabs">
            <div class="my-account-tab my-account-active">THÔNG TIN TÀI KHOẢN</div>
            <div class="my-account-tab">THẺ THÀNH VIÊN</div>
            <div class="my-account-tab">HÀNH TRÌNH ĐIỆN ẢNH</div>
            <div class="my-account-tab">ĐIỂM BETA</div>
            <div class="my-account-tab">VOUCHER</div>
        </div>
        
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
                     <input type="file" id="file-upload" name="img_thumbnail" accept="image/*" style="display: none;" />   
                     <label for="img_thumbnail" class="my-account-upload-btn" id="uploadBtn">Tải ảnh lên</label>
                </div>
                
            </div>

            <div class="my-account-form-row">
                <div class="my-account-form-group">
                    <div class="my-account-mb-3">
                        <label for="name"><span style="color: red;">*</span>&nbsp;Họ tên</label>
                        <input type="text" class="my-account-form-control" placeholder="Họ và tên" name="name"
                            id="name" value="{{ old('name', $user->name) }}">
                        @error("name")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-account-mb-3">
                        <label for="phone"><span style="color: red;">*</span>&nbsp;Số điện thoại</label>
                        <i class="fa fa-phone-square phone-icon"></i>
                        <input type="text" id="phone" class="my-account-form-control" name="phone"
                            placeholder="Nhập số điện thoại của bạn" value="{{ old('phone', $user->phone) }}">
                        @error("phone")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-account-mb-3">
                        <label for="birthday"><span style="color: red;">*</span>&nbsp;Ngày sinh</label>
                        <i class="fa fa-calendar birthday-icon"></i>
                        <input type="date" id="birthday" value="{{ old('birthday', $user->birthday) }}" class="my-account-form-control" name="birthday"
                            placeholder="Ngày sinh" data-date-format="yyyy-mm-dd" />
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
                                    <option value="{{ $gender }}"
                                        @selected($user->gender == $gender)>{{ $gender }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="my-account-mb-3">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="my-account-form-control" placeholder="Số nhà, đường, ngõ xóm"
                            name="address" id="address" value="{{ old('address', $user->address) }}">
                    </div>
                </div>
            </div>

            <div class="my-account-text-center my-account-my-3">
                <button type="submit" class="my-account-btn">Cập nhật</button>
            </div>
        </form>
    </div>

    <!-- Modal Đổi mật khẩu -->
    <div class="my-account-overlay" id="overlay">
    <div class="my-account-modal" id="changePasswordForm">
        {{-- <h4>Đổi mật khẩu</h4> --}}
        <form>
            <div class="my-account-mb-3">
                <label for="password"><span style="color: red;">*</span>&nbsp;Mật khẩu hiện tại</label>
                <input type="password" class="my-account-form-control" id="password" name="password" placeholder="Nhập mật khẩu hiện tại">
                @error("password")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-account-mb-3">
                <label for="password"><span style="color: red;">*</span>&nbsp;Mật khẩu mới</label>
                <input type="password" class="my-account-form-control" id="password" name="password" placeholder="Nhập mật khẩu mới">
                @error("password")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-account-mb-3">
                <label for="password_confirmation"><span style="color: red;">*</span>&nbsp;Nhập lại mật khẩu mới</label>
                <input type="password" class="my-account-form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
                @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-account-text-center">
                <button type="submit" class="my-account-btn" onclick="return confirm('Bạn có chắc chắn muốn đổi mật khẩu không')">Xác nhận</button>
                <button type="button" class="my-account-btn" id="closeChangePassword">Hủy</button>
            </div>
        </form>
    </div>
</div>

    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
</body>


@endsection