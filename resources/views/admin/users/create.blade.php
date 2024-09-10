@extends('admin.layouts.master')

@section('title')
    Thêm mới tài khoản
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới tài khoản</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active ">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- thông tin -->
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('error'))
                <div class="alert alert-danger m-3">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Tiến trình cách bước</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form action="#" class="form-steps" autocomplete="off">
                            <div class="text-center pt-3 pb-4 mb-1">
                                <h5>Đăng ký tài khoản</h5>
                            </div>
                            <div id="custom-progress-bar" class="progress-nav mb-4">
                                <div class="progress" style="height: 1px;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded-pill active" data-progressbar="custom-progress-bar"
                                            id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info"
                                            type="button" role="tab" aria-controls="pills-gen-info"
                                            aria-selected="true">1</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar"
                                            id="pills-info-desc-tab" data-bs-toggle="pill" data-bs-target="#pills-info-desc"
                                            type="button" role="tab" aria-controls="pills-info-desc"
                                            aria-selected="false">2</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar"
                                            id="pills-success-tab" data-bs-toggle="pill" data-bs-target="#pills-success"
                                            type="button" role="tab" aria-controls="pills-success"
                                            aria-selected="false">3</button>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel"
                                    aria-labelledby="pills-gen-info-tab">
                                    <div>
                                        <div class="mb-4">
                                            <div>
                                                <h5 class="mb-1">Thông tin đăng nhập</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="gen-info-email-input">Email</label>
                                                    <input type="email" class="form-control"
                                                        placeholder="user123@gmail.com" name="email" >
                                                        @error('email')
                                                            <div class='mt-1'>
                                                                <span class="text-danger">{{ $message }}</span>
                                                            </div>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="gen-info-username-input">Số điện thoại</label>
                                                    <input type="text" class="form-control" id="gen-info-username-input"
                                                        placeholder="0965263725" required>
                                                    @error('email')
                                                        <div class='mt-1'>
                                                            <span class="text-danger">{{ $message }}</span>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="gen-info-password-input">Mật khẩu</label>
                                            <input type="password" class="form-control" id="gen-info-password-input"
                                                placeholder="Mật khẩu" required>
                                            <div class="invalid-feedback">Please enter a password</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="gen-info-password-input">Xác nhận mật khẩu</label>
                                            <input type="password" class="form-control" id="gen-info-password-input"
                                                placeholder="Xác nhận mật khẩu" required>
                                            <div class="invalid-feedback">Please enter a password</div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button"
                                            class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                            data-nexttab="pills-info-desc-tab"><i
                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to
                                            more info</button>
                                    </div>
                                </div>
                                <!-- end tab pane -->

                                <div class="tab-pane fade" id="pills-info-desc" role="tabpanel"
                                    aria-labelledby="pills-info-desc-tab">
                                    <div>
                                        <div class="text-center">
                                            <div class="profile-user position-relative d-inline-block mx-auto mb-2">
                                                <img src="{{ asset('theme/admin/assets/images/users/user-dummy-img.jpg') }}"
                                                    class="rounded-circle avatar-lg img-thumbnail user-profile-image"
                                                    alt="user-profile-image">
                                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                    <input id="profile-img-file-input" type="file"
                                                        class="profile-img-file-input" accept="image/png, image/jpeg">
                                                    <label for="profile-img-file-input"
                                                        class="profile-photo-edit avatar-xs">
                                                        <span class="avatar-title rounded-circle bg-light text-body">
                                                            <i class="ri-camera-fill"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <h5 class="fs-14">Hình ảnh</h5>

                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="gen-info-email-input">Họ và tên</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="user123@gmail.com" name="email" >
                                                            @error('email')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="gen-info-email-input">Ngày sinh</label>
                                                        <input type="date" class="form-control"
                                                            placeholder="user123@gmail.com" name="email" >
                                                            @error('email')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="gen-info-email-input">Giới tính</label>
                                                        <select name="" id="" class="form-control">
                                                            <option value="Nam">Nam</option>
                                                            <option value="Nữ">Nữ</option>
                                                            <option value="Khác">Khác</option>
                                                        </select>
                                                            @error('email')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="gen-info-email-input">Loại tài khoản</label>
                                                        <select name="" id="" class="form-control">
                                                            <option value="Nam">Quản trị viên</option>
                                                            <option value="Nữ">Khách hàng</option>
                                                        </select>
                                                            @error('email')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="gen-info-email-input">Địa chỉ</label>
                                                        <textarea name="" id="" cols="3"  class="form-control"></textarea>
                                                            @error('email')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button"
                                            class="btn btn-link text-decoration-none btn-label previestab"
                                            data-previous="pills-gen-info-tab"><i
                                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                            General</button>
                                        <button type="button"
                                            class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                            data-nexttab="pills-success-tab"><i
                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                    </div>
                                </div>
                                <!-- end tab pane -->

                                <div class="tab-pane fade" id="pills-success" role="tabpanel"
                                    aria-labelledby="pills-success-tab">
                                    <div>
                                        <div class="text-center">

                                            <div class="mb-4">
                                                <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                                                    colors="primary:#0ab39c,secondary:#405189"
                                                    style="width:120px;height:120px"></lord-icon>
                                            </div>
                                            <h5>Hoàn thành !</h5>
                                            <p class="text-muted">Bạn đã đăng ký tài khoản thành công</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end tab pane -->
                            </div>
                            <!-- end tab content -->
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
    @endsection

    @section('style-libs')
    @endsection

    @section('script-libs')

    @endsection
