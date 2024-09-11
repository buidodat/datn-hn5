@extends('admin.layouts.master')

@section('title')
    Cập nhật tài khoản
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Cập nhật tài khoản</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active ">Cập nhật</li>
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
        <form action="">

        </form>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Thông tin tài khoản</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="tab-content">
                                <div class="" id="pills-info-desc" role="tabpanel"
                                    aria-labelledby="pills-info-desc-tab">
                                    <div>
                                        <div class="text-center">
                                            <div class="profile-user position-relative d-inline-block mx-auto mb-2">
                                                @if (!empty($user->img_thumbnail))
                                                    <img src="{{ Storage::url($user->img_thumbnail) }}"
                                                        class="rounded-circle avatar-lg img-thumbnail user-profile-image"
                                                        alt="user-profile-image">
                                                @else
                                                    <img src="{{ asset('theme/admin/assets/images/users/user-dummy-img.jpg') }}"
                                                        class="rounded-circle avatar-lg img-thumbnail user-profile-image"
                                                        alt="user-profile-image">
                                                @endif
                                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                    <input id="profile-img-file-input" type="file"
                                                        class="profile-img-file-input" accept="image/png, image/jpeg" name="img_thumbnail">
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
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <span class='text-danger'>*</span>
                                                        <label class="form-label">Họ và tên</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Họ và tên" name="name" value="{{ $user->name }}" >
                                                            @error('name')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <span class='text-danger'>*</span>
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="user123@gmail.com" name="email"  value="{{ $user->email }}">
                                                            @error('email')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <span class='text-danger'>*</span>
                                                        <label class="form-label">Số điện thoại</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="0965263725" name="phone" value="{{ $user->phone }}">
                                                            @error('phone')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                {{-- <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <span class='text-danger'>*</span>
                                                        <label class="form-label">Mật khẩu</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Mật khẩu" name="password" >
                                                            @error('password')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <span class='text-danger'>*</span>
                                                        <label class="form-label">Xác nhận mật khẩu</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Xác nhận mật khẩu" name="password_confirmation" >
                                                            @error('password_confirmation')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div> --}}

                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Ngày sinh</label>
                                                        <input type="date" class="form-control" name="birthday" value="{{ $user->birthday }}">
                                                            @error('birthday')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Giới tính</label>
                                                        <select name="gender" id="" class="form-select">
                                                            @foreach ($genders as $gender)
                                                                <option value="{{ $gender }}" @selected($user->gender == $gender)>{{ $gender }}</option>
                                                            @endforeach
                                                        </select>
                                                            @error('gender')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">

                                                        <label class="form-label">Loại tài khoản</label>
                                                        <select name="type" id="" class="form-select">
                                                            <option value="{{ $typeAdmin }}" @selected($user->type == $typeAdmin)>Quản trị viên</option>
                                                            <option value="{{ $typeMember }}"@selected($user->type == $typeMember)>Khách hàng</option>
                                                        </select>
                                                            @error('type')
                                                                <div class='mt-1'>
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Địa chỉ</label>
                                                        <textarea name="address" id="" cols="2" rows="2" class="form-control" placeholder="Tòa FPT, Trịnh Văn Bô, Nam Từ Liêm, Hà Nội.">{{ $user->address }}</textarea>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                       <a href="{{ route("admin.users.index") }}" class="btn btn btn-link text-decoration-none btn-label previestab"> <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Trở về</a>
                                        <button type="submit"
                                            class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                            data-nexttab="pills-success-tab"><i
                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Cập nhật</button>
                                    </div>
                                </div>

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
            <script src="{{ asset('theme/admin/assets/js/pages/form-wizard.init.js') }}"></script>
    @endsection
