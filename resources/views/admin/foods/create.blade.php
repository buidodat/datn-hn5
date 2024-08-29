@extends('admin.layouts.master')

@section('title')
    Thêm mới Đồ Ăn
@endsection

@section('content')
    <form action="{{route('admin.foods.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thêm mới Đồ Ăn</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.foods.index') }}">Danh sách</a></li>
                            <li class="breadcrumb-item active">Thêm mới</li>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm thông tin Đồ Ăn</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label ">Tên </label>
                                        <input type="text" class="form-control fs-4 fw-semibold" id="name"
                                            name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="img_food" class="form-label">Hình ảnh</label>
                                        <input type="file" name="img_food" id="img_food" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label ">Giá </label>
                                        <input type="text" class="form-control fs-4 fw-semibold" id="price"
                                            name="price" value="{{ old('price') }}">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-check-label" for="is_active">Is Active</label>
                                            <div class="form-check form-switch form-switch-default">
                                                <input class="form-check-input" type="checkbox" role=""
                                                    name="is_active" checked value="1">
                                            </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô tả ngắn:</label>
                                        <textarea class="form-control fs-5 fw-semibold" rows="3" name="description"></textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    
                                </div>
                                <div class="col-lg-12">
                                    <a href="{{ route('admin.foods.create') }}" class="btn btn-warning">Quay lại</a>
                                    <button type="submit" class="btn btn-primary">Thêm mới</button>

                                </div>

                                
                            </div>

                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection

