@extends('admin.layouts.master')

@section('title')
    Chi tiết tài khoản
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Chi tiết tài khoản</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active ">Chi tiết</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>


    {{-- thông tin tài khoản --}}
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
                        <h4 class="card-title mb-0">Thông tin tài khoản</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                            <div class="tab-content">
                                <div class="" id="pills-info-desc" role="tabpanel"
                                    aria-labelledby="pills-info-desc-tab">
                                    <div>
                                        <div class="text-center">
                                            <div class="profile-user position-relative d-inline-block mx-auto mb-2">
                                                @php
                                                    $url = $user->img_thumbnail;

                                                    if (!\Str::contains($url, 'http')) {
                                                        $url = Storage::url($url);
                                                    }

                                                @endphp
                                                @if (!empty($user->img_thumbnail))
                                                    <img src="{{ $url}}"
                                                        class="rounded-circle avatar-lg img-thumbnail user-profile-image"
                                                        alt="user-profile-image">
                                                @else
                                                    <img src="{{ asset('theme/admin/assets/images/users/user-dummy-img.jpg') }}"
                                                        class="rounded-circle avatar-lg img-thumbnail user-profile-image"
                                                        alt="user-profile-image">
                                                @endif

                                            </div>
                                            <h5 class="fs-14">Hình ảnh</h5>

                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Họ và tên</label>
                                                        <input type="text" class="form-control" placeholder="Họ và tên"
                                                            name="name" value="{{ $user->name }}" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="user123@gmail.com" name="email"
                                                            value="{{ $user->email }}" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Số điện thoại</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="0965263725" name="phone"
                                                            value="{{ $user->phone }}" disabled>

                                                    </div>
                                                </div>


                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Ngày sinh</label>
                                                        <input type="date" class="form-control" name="birthday"
                                                            value="{{ $user->birthday }}" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Giới tính</label>
                                                        <input type="text" value="{{ $user->gender }}" disabled class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="mb-3">

                                                        <label class="form-label">Loại tài khoản</label>
                                                        <input type="text" value="{{ $user->type == $typeAdmin ? 'Quản trị viên' :'Khách hàng' }}" disabled class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Địa chỉ</label>
                                                        <textarea name="address" id="" cols="2" rows="2" class="form-control"
                                                            placeholder="Tòa FPT, Trịnh Văn Bô, Nam Từ Liêm, Hà Nội." disabled>{{ $user->address }}</textarea>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <a href="{{ route('admin.users.index') }}"
                                            class="btn btn btn-link text-decoration-none btn-label previestab"> <i
                                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Trở
                                            về</a>

                                    </div>
                                </div>

                            </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
    @endsection

