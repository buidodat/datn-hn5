@extends('admin.layouts.master')

@section('title')
    Thêm mới Rạp
@endsection

@section('content')
    <form action="{{ route('admin.cinemas.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thêm mới Rạp</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.cinemas.index') }}">Danh sách</a></li>
                            <li class="breadcrumb-item active">Thêm mới</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <!-- thông tin -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm thông tin Rạp</h4>
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
                                <div class="col-md-5 ">
                                    <div class="mb-3">
                                        <label for="name" class="form-label "> <span class="text-danger">*</span>Tên rạp
                                        </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="city_id" class="form-label "> <span class="text-danger">*</span>Thành phố
                                        </label>
                                        <select name="city_id" id="city_id" class="form-control">
                                            <option value="1">Chọn thành phố</option>
                                            <option value="2">Hà Nội</option>
                                            
                                        </select>
                                        @error('city_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label "> <span class="text-danger">*</span>Địa chỉ
                                        </label>
                                        <input type="number" class="form-control" id="address" name="address"
                                            value="{{ old('address') }}">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-7">
                                    <div class="mb-2">
                                        <label class="form-check-label" for="is_active">Hoạt động</label>
                                        <div class="form-check form-switch form-switch-default">
                                            <input class="form-check-input" type="checkbox" role="" name="is_active"
                                                checked value="1">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label"> <span class="text-danger">*</span>Mô tả </label>
                                        <textarea class="form-control" rows="7" name="description" >{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <a href="{{ route('admin.combos.index') }}" class="btn btn-warning">Quay lại</a>
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
