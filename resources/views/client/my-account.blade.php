@extends('client.layouts.master')

@section('title')
My Account
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
        <div class="my-account-upload-container">
            <div class="my-account-image-upload-container" id="imagePlaceholder" >
                <p>No Image</p>
            </div>
            <div class="my-account-buttons">
                <input type="file" id="file-upload" accept="image/*" hidden />
                <button class="my-account-upload-btn" id="uploadBtn" style="font-size: 14px;">Tải ảnh lên</button>
                <button class="my-account-save-btn" style="font-size: 14px;">Lưu ảnh</button>
            </div>
        </div>
        <form action="">
            <div class="my-account-form-row">
                <div class="my-account-form-group">
                    <div class="my-account-mb-3">
                        <label for="hoTen"><span style="color: red;">*</span>&nbsp;Họ tên</label>
                        <input type="text" class="my-account-form-control" placeholder="Họ và tên" name="hoTen"
                            id="hoTen">

                    </div>
                    <div class="my-account-mb-3">
                        <label for="txtDienThoai"><span style="color: red;">*</span>&nbsp;Số điện thoại</label>
                        <i class="fa fa-phone-square phone-icon"></i>
                        <input type="text" id="txtDienThoai" value="" class="my-account-form-control"
                            placeholder="0975098710">

                    </div>
                    <div class="my-account-mb-3">
                        <label for="txtNgaySinh"><span style="color: red;">*</span>&nbsp;Ngày sinh</label>
                        <i class="fa fa-calendar birthday-icon"></i>
                        <input type="date" id="txtNgaySinh" value="2004-05-14" class="my-account-form-control"
                            placeholder="Ngày sinh" data-date-format="yyyy-mm-dd" />

                    </div>
                    <div class="my-account-mb-3">
                        <label for="tinh">Tỉnh/Thành phố</label>
                        <select name="tinh" class="my-account-form-select" id="tinh">
                            <option value="">Chọn tỉnh thành phố</option>
                            <option value="haNoi">Thành phố Hà Nội</option>
                            <option value="hoChiMinh">Thành phố Hồ Chí Minh</option>
                        </select>
                    </div>
                    <div class="my-account-mb-3">
                        <label for="xa">Xã/Phường/Thị Trấn</label>
                        <select name="xa" class="my-account-form-select" id="xa">
                            <option value="">Xã/Phường/Thị Trấn</option>
                        </select>
                    </div>
                    <div class="my-account-mb-3">
                        <a href="#" id="changePasswordBtn" class="my-account-d-block">Đổi mật khẩu?</a>
                    </div>
                </div>

                <div class="my-account-form-group">
                    <div class="my-account-mb-3">
                        <label for="txtEmail"><span style="color: red;">*</span>&nbsp;Email</label>
                        <i class="fa fa-envelope email-icon"></i>
                        <input type="email" id="txtEmail" disabled class="my-account-form-control"
                            placeholder="example@gmail.com">

                    </div>
                    <div class="my-account-mb-3">
                        <label for="txtCMND"><span style="color: red;">*</span>&nbsp;CMND/Hộ chiếu</label>
                        <i class="fa fa-credit-card cccd-icon"></i>
                        <input type="text" id="txtCMND" class="my-account-form-control" placeholder="CMND/Hộ chiếu">

                    </div>
                    <div class="my-account-mb-3">
                        <label for="cboSex">Giới tính</label>
                        <i class="fa fa-male sex-icon"></i>
                        <div class="my-account-input-icon">
                            <select id="cboSex" class="my-account-form-select">
                                <option value="0">Giới tính</option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                                <option value="3">Khác</option>
                            </select>
                        </div>
                    </div>
                    <div class="my-account-mb-3">
                        <label for="huyen">Quận/Huyện</label>
                        <select name="huyen" class="my-account-form-select" id="huyen">
                            <option value="">Quận/Huyện</option>
                        </select>
                        <label for="huyen" class="my-account-error-message"></label>
                    </div>
                    <div class="my-account-mb-3">
                        <label for="thonNgoXom">Địa chỉ</label>
                        <input type="text" class="my-account-form-control" placeholder="Số nhà, đường, ngõ xóm"
                            name="thonNgoXom" id="thonNgoXom">
                        <label for="thonNgoXom" class="my-account-error-message"></label>
                    </div>
                </div>
            </div>

            <div class="my-account-text-center my-account-my-3">
                <button type="submit" class="my-account-btn">Cập nhật</button>
            </div>
        </form>
    </div>

    <!-- Modal Đổi mật khẩu -->
    <div class="my-account-overlay" id="overlay"></div>
    <div class="my-account-modal" id="changePasswordForm">
        {{-- <h4>Đổi mật khẩu</h4> --}}
        <form>
            <div class="my-account-mb-3">
                <label for="txtOldPassword"><span style="color: red;">*</span>&nbsp;Mật khẩu cũ</label>
                <input type="password" class="my-account-form-control" id="txtOldPassword" required>
            </div>
            <div class="my-account-mb-3">
                <label for="txtNewPassword"><span style="color: red;">*</span>&nbsp;Mật khẩu mới</label>
                <input type="password" class="my-account-form-control" id="txtNewPassword" required>
            </div>
            <div class="my-account-mb-3">
                <label for="txtConfirmNewPassword"><span style="color: red;">*</span>&nbsp;Nhập lại mật khẩu mới</label>
                <input type="password" class="my-account-form-control" id="txtConfirmNewPassword" required>
            </div>
            <div class="my-account-text-center">
                <button type="submit" class="my-account-btn">Xác nhận</button>
                <button type="button" class="my-account-btn" id="closeChangePassword">Hủy</button>
            </div>
        </form>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
</body>


@endsection