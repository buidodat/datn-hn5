@extends('admin.layouts.master')

@section('title')
    Thêm mới Combo
@endsection

@section('content')
    <form action="{{ route('admin.combos.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thêm mới Combo</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.combos.index') }}">Danh sách</a></li>
                            <li class="breadcrumb-item active">Thêm mới</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <!-- thông tin -->
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm thông tin Combo</h4>
                    </div><!-- end card header -->

                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-success">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="name" class="form-label "> <span class="text-danger">*</span>Tên combo
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}" placeholder="Nhập tên combo">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="food_id" class="form-label ">Đồ ăn</label>
                                            <select name="food_id" id="food_id" class="form-control">
                                                <option value="1">Bimbim oishi</option>
                                                <option value="1">Bỏng</option>
                                                <option value="1">Bỏng vị caramel</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="qty_food" class="form-label "> <span class="text-danger">*</span>Số lượng</label>
                                            <input type="number" class="form-control" id="qty_food" name="qty_food"
                                                value="{{ old('qty_food') }}" placeholder="Nhập số lượng đồ ăn" min="1">
                                            @error('qty_food')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="drink_id" class="form-label ">Nước uống</label>
                                            <select name="drink_id" id="drink_id" class="form-control">
                                                <option value="1">Nước Coca</option>
                                                <option value="1">Nước cam</option>
                                                <option value="1">Nước 7up</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="qty_drink" class="form-label "> <span class="text-danger">*</span>Số lượng</label>
                                            <input type="number" class="form-control" id="qty_drink" name="qty_drink"
                                                value="{{ old('qty_drink') }}" placeholder="Nhập số lượng nước uống" min="1">
                                            @error('qty_drink')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="price" class="form-label "> <span class="text-danger">*</span>Giá gốc</label>
                                            <input type="number" class="form-control" id="price" name="price"
                                                placeholder="80.000 Vnd"  disabled>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="price_sale" class="form-label "> <span class="text-danger">*</span>Giá bán</label>
                                            <input type="number" class="form-control" id="price_sale" name="price_sale"
                                                value="{{ old('price_sale') }}" placeholder="Nhập giá bán">
                                            @error('price_sale')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="description" class="form-label"> <span class="text-danger">*</span>Mô tả
                                                ngắn</label>
                                            <textarea class="form-control" rows="3" name="description" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-2">
                                    <label for="img_thumbnail" class="form-label"> <span class="text-danger">*</span>Hình
                                        ảnh</label>
                                    <input type="file" name="img_thumbnail" id="img_thumbnail" class="form-control">
                                    @error('img_thumbnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-check-label" for="is_active">Is active:</label>
                                            <div class="form-check form-switch form-switch-default">
                                                <input class="form-check-input" type="checkbox" role=""
                                                    name="is_active" checked value="1">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <a href="{{ route('admin.combos.index') }}" class="btn btn-info">Danh sách</a>
                        <button type="submit" class="btn btn-primary mx-1">Thêm mới</button>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection
