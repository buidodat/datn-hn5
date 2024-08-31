@extends('admin.layouts.master')

@section('title')
    Cập nhật Combo
@endsection

@section('content')
    <form action="{{ route('admin.combos.update', $combo) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Cập nhật Combo</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.combos.index') }}">Danh sách</a></li>
                            <li class="breadcrumb-item active">Cập nhật</li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Cập nhật Combo</h4>
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
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label "> <span class="text-danger">*</span>Tên Combo
                                        </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $combo->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="img_thumbnail" class="form-label">
                                            <span class="text-danger">*</span>Hình ảnh</label>
                                        <input type="file" name="img_thumbnail" id="img_thumbnail" class="form-control">

                                        @if ($combo->img_thumbnail && \Storage::exists($combo->img_thumbnail))
                                            <img src="{{ Storage::url($combo->img_thumbnail) }}" alt=""
                                                class="mt-3" width="150px" height="90px">
                                        @else
                                            No image !
                                        @endif

                                        @error('img_thumbnail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label "> <span
                                                class="text-danger">*</span>Giá</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            value="{{ $combo->price }}">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-check-label" for="is_active">Hoạt động</label>
                                        <div class="form-check form-switch form-switch-default">
                                            <input class="form-check-input" type="checkbox" role="" name="is_active"
                                                @checked($combo->is_active) value="1">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label"> <span class="text-danger">*</span>Mô tả
                                            ngắn</label>
                                        <textarea class="form-control" rows="3" name="description">{{ $combo->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <a href="{{ route('admin.combos.index') }}" class="btn btn-warning">Quay lại</a>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
