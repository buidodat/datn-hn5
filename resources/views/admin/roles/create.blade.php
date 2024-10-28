@extends('admin.layouts.master')

@section('title')
    Thêm mới vai trò
@endsection

@section('content')
    <form action="{{ route('admin.roles.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thêm mới vai trò</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Danh sách</a></li>
                            <li class="breadcrumb-item active">Thêm mới</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <!-- thông tin -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm thông tin vai trò</h4>
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
                                <div class="col-md-8 ">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="name" class="form-label "> <span class="text-danger">*</span>Tên
                                                vai trò:
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}"
                                                placeholder="Vd: Người viết bài, Nhân viên hóa đơn,...">
                                           
                                            @error('name')
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
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Thêm quyền hạn cho vai trò</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="row mb-2">
                                    <label for="name" class="form-label col-12">
                                        <span class="text-danger">*</span> Chọn Quyền
                                    </label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12  px-5">
                                        @foreach ($permissions as $permission)
                                            <div class="form-check mb-2 border py-2 px-5 ">
                                                <input type="checkbox" class="form-check-input" id="{{ $permission->id }}"
                                                    name="permissions[]" value="{{ $permission->name }}">
                                                <label for="{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                            
                                        @error('permissions')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-info">Danh sách</a>
                        <button type="submit" class="btn btn-primary mx-1">Thêm mới</button>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection
