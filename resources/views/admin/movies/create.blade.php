@extends('admin.layouts.master')

@section('title')
    Thêm mới phim
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.movies.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thêm mới phim</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.movies.index') }}">Danh sách</a></li>
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
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin phim</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="name" class="form-label ">Tên phim:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}" placeholder="Nhập tên phim">
                                            @error('name')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="director" class="form-label ">Đạo diễn:</label>
                                            <input type="text" class="form-control" id="director" name="director"
                                                value="{{ old('director') }}" placeholder="Eiichiro Oda">
                                            @error('director')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-8 mb-3">
                                            <label for="cast" class="form-label ">Diễn viên:</label>
                                            <input type="text" class="form-control" id="cast" name="cast"
                                                value="{{ old('cast') }}" placeholder="Monkey D.Luffy, Rononoa Zoro">
                                            @error('cast')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="col-md-4 mb-3">
                                            <label for="release_date" class="form-label ">Ngày khởi chiếu:</label>
                                            <input type="date" class="form-control" id="release_date" name="release_date"
                                                value="{{ old('release_date', now()->format('Y-m-d')) }}">
                                            @error('release_date')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="end_date" class="form-label ">Ngày kết thúc:</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date"
                                                value="{{ old('end_date', now()->addDays(30)->format('Y-m-d')) }}">
                                            @error('end_date')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="duration" class="form-label ">Thời lượng:</label>
                                            <input type="number" class="form-control" id="duration" name="duration"
                                                value="{{ old('duration') }}" placeholder="127 (phút)">
                                            @error('duration')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="category" class="form-label ">Thể loại:</label>
                                            <input type="text" class="form-control" id="category" name="category"
                                                value="{{ old('category') }}" placeholder="Hoạt hình, Khám phá">
                                            @error('category')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="rating" class="form-label ">Giới hạn độ tuổi:</label>
                                            <select name="rating" id="" class="form-select">
                                                @foreach ($ratings as $rating)
                                                    <option value="{{ $rating }}">{{ $rating }}</option>
                                                @endforeach
                                            </select>
                                            @error('rating')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-check-label mb-2" for="is_active">Ngôn ngữ:</label>
                                            <select class="js-example-basic-multiple" name="languages[]"
                                                multiple="multiple">
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language }}" selected>{{ $language }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('languages')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="description" class="form-label">Mô tả phim:</label>
                                            <textarea class="form-control " rows="3" name="description"
                                                placeholder='Hành trình ra khơi của những băng hải tặc, phiêu lưu trên bờ biển "Đại hải trình" để truy tìm, khám phá kho báu One Piece của vua hải tặc tiền nhiệm God D Roger. '></textarea>
                                            @error('description')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
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
                                    <label for="" class="form-label">Hình ảnh:</label>
                                    <input type="file" name="img_thumbnail" id="" class="form-control">
                                    @error('img_thumbnail')
                                        <div class='mt-1'>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-2">
                                    <label for="trailer_url" class="form-label">URL Trailer:</label>
                                    <input type="text" class="form-control" id="trailer_url" name="trailer_url"
                                        value="{{ old('trailer_url') }}" placeholder="ZQkU_oI2NOU">
                                    @error('trailer_url')
                                        <div class='mt-1'>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
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
                                            <label class="form-check-label" for="is_active">Is Active</label>
                                            <div class="form-check form-switch form-switch-default">
                                                <input class="form-check-input" type="checkbox" role=""
                                                    name="is_active" checked>
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
                        <a href="{{ route('admin.movies.index') }}" class="btn btn-info">Danh sách</a>
                        <button type="submit" class="btn btn-primary mx-1">Thêm mới</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/select2.init.js') }}"></script>

    <script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("content", {
            width: "100%",
            height: "750px"
        });
    </script>
@endsection
