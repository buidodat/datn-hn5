@extends('admin.layouts.master')

@section('title')
    Cập nhật cấu hình website
@endsection

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"> Cập nhật cấu hình website</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="">Danh sách</a></li>
                            <li class="breadcrumb-item active">Cập nhật</li>
                        </ol>
                    </div>
                </div>
            </div>
            
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-6 text-center">
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
            </div>
        </div><br>

        <!-- Thông tin chung -->
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin cơ bản</h4>
                    </div>
                    <div class="card-body">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <label for="site_name" class="form-label">Tên Website</label>
                                <input type="text" class="form-control" id="site_name" name="site_name" >
                            </div>
                            <div class="col-md-6">
                                <label for="brand_name" class="form-label">Tên Thương Hiệu</label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name" >
                            </div>
                            <div class="col-md-6">
                                <label for="slogan" class="form-label">Khẩu hiệu</label>
                                <input type="text" class="form-control" id="slogan" name="slogan" >
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone" >
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" >
                            </div>
                            <div class="col-md-6">
                                <label for="headquarters" class="form-label">Trụ Sở Chính</label>
                                <input type="text" class="form-control" id="headquarters" name="headquarters" >
                            </div>
                            <div class="col-md-6">
                                <label for="business_license" class="form-label">Giấy Phép Kinh Doanh</label>
                                <input type="text" class="form-control" id="business_license" name="business_license" >
                            </div>
                            <div class="col-md-6">
                                <label for="working_hours" class="form-label">Thời Gian Làm Việc</label>
                                <input type="text" class="form-control" id="working_hours" name="working_hours" >
                            </div>
                            <div class="col-md-6">
                                <label for="facebook_link" class="form-label">Link Facebook</label>
                                <input type="text" class="form-control" id="facebook_link" name="facebook_link" >
                            </div>
                            <div class="col-md-6">
                                <label for="youtube_link" class="form-label">Link YouTube</label>
                                <input type="text" class="form-control" id="youtube_link" name="youtube_link" >
                            </div>
                            <div class="col-md-6">
                                <label for="instagram_link" class="form-label">Link Instagram</label>
                                <input type="text" class="form-control" id="instagram_link" name="instagram_link" >
                            </div>
                            <div class="col-md-6">
                                <label for="copyright" class="form-label">Bản Quyền</label>
                                <input type="text" class="form-control" id="copyright" name="copyright" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo Website -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="website_logo" class="form-label">Logo Website</label>
                            <input type="file" name="website_logo" class="form-control">
             
                        </div>

                        <div class="mb-3">
                            <label for="privacy_policy_image" class="form-label">Ảnh Chính Sách Bảo Mật</label>
                            <input type="file" name="privacy_policy_image" class="form-control">
               
                        </div>

                        <div class="mb-3">
                            <label for="terms_of_service_image" class="form-label">Ảnh Điều Khoản Dịch Vụ</label>
                            <input type="file" name="terms_of_service_image" class="form-control">
             
                        </div>

                        <div class="mb-3">
                            <label for="introduction_image" class="form-label">Ảnh Giới Thiệu</label>
                            <input type="file" name="introduction_image" class="form-control">
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chính Sách Bảo Mật -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Chính Sách Bảo Mật</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" name="privacy_policy" placeholder="Nhập nội dung Chính Sách Bảo Mật"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Điều Khoản Dịch Vụ -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Điều Khoản Dịch Vụ</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" name="terms_of_service" placeholder="Nhập nội dung Điều Khoản Dịch Vụ"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Giới Thiệu -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Giới Thiệu</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" name="introduction" placeholder="Nhập nội dung Giới Thiệu"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection