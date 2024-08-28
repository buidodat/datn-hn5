@extends('admin.layouts.master')

@section('title')
    Thêm mới bài viết
@endsection

@section('content')
<form action="" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới Bài viết</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Basic Elements</li>
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
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thông tin bài viết</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label ">Tiêu đề:</label>
                                    <input type="text" class="form-control fs-4 fw-semibold" id="title" name="title" value="{{ old('title') }}">
                                    @error("title")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả ngắn:</label>
                                    <textarea class="form-control fs-5 fw-semibold" rows="3" name="description"></textarea>
                                    @error("description")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Nội dung:</label>
                                    <textarea class="form-control" cols="50" rows="50" name="content" ></textarea>
                                    @error("content")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                <label for="" class="form-label">Ảnh đại diện:</label>
                                <input type="file" name="image" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-2">
                                <label for="category_id" class="form-label">Thể loại:</label>
                                <select name="category_id" id="" class="form-select">

                                    {{-- @foreach ($categories as $key => $value )
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach --}}
                                    @error("category_id")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-2">
                                <label for="author_id" class="form-label">Tác giả:</label>
                                <select name="author_id" id="" class="form-select">
                                    {{-- @foreach ($authors as $key => $value  )
                                        <option value="{{ $key}}">{{ $value }}</option>
                                    @endforeach --}}
                                    @error("author_id")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </select>
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
                                        <label class="form-check-label" for="is_active">Is Active</label>
                                        <div class="form-check form-switch form-switch-default">
                                            <input class="form-check-input" type="checkbox" role=""
                                                name="is_active" checked>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-check-label" for="is_active">Is Popular</label>
                                        <div class="form-check form-switch form-switch-success">
                                            <input class="form-check-input" type="checkbox" role=""
                                                name="is_popular" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-check-label" for="is_active">Is Hot</label>
                                        <div class="form-check form-switch form-switch-danger">
                                            <input class="form-check-input" type="checkbox" role=""
                                                name="is_hot_post" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-2">
                                <label class="form-check-label mb-2" for="is_active">Tags</label>
                                <select class="js-example-basic-multiple" name="tags[]" multiple="multiple">
                                    {{-- @foreach ($tags as $key => $value )
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach --}}
                                </select>
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
                    <button type:s class="btn btn-info">Save</button>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</form>
@endsection
@section('style-libs')
     <!-- App favicon -->
     <link rel="shortcut icon" href="assets/images/favicon.ico">

     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

     <!-- Layout config Js -->
     <script src="assets/js/layout.js"></script>
     <!-- Bootstrap Css -->
     <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <!-- Icons Css -->
     <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
     <!-- App Css-->
     <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
     <!-- custom Css-->
     <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/select2.init.js') }}"></script>

    <script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("content",{
            width: "100%",
            height: "750px"
        });
    </script>
@endsection
