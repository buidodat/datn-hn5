@extends('admin.layouts.master')

@section('title')
    Cập nhật phim
@endsection

@section('content')

    <form action="{{ route('admin.movies.update', $movie) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Cập nhật phim</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.movies.index') }}">Danh sách</a></li>
                            <li class="breadcrumb-item active">Cập nhật</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <!-- thông tin -->
        <div class="row">
            <div class="col-md-12   ">
                @if (session()->has('error'))
                    <div class="alert alert-danger m-3">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-lg-9 col-md-9 ">
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
                                            <label for="name" class="form-label "><span class='text-danger'>*</span> Tên
                                                phim:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name', $movie->name) }}" placeholder="Nhập tên phim">
                                            @error('name')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="director" class="form-label "><span class='text-danger'>*</span> Đạo
                                                diễn:</label>
                                            <input type="text" class="form-control" id="director" name="director"
                                                value="{{ old('director', $movie->director) }}" placeholder="Eiichiro Oda">
                                            @error('director')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-8 mb-3">
                                            <label for="cast" class="form-label "><span class='text-danger'>*</span>
                                                Diễn viên:</label>
                                            <input type="text" class="form-control" id="cast" name="cast"
                                                value="{{ old('cast', $movie->cast) }}"
                                                placeholder="Monkey D.Luffy, Rononoa Zoro">
                                            @error('cast')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="col-md-4 mb-3">
                                            <label for="release_date" class="form-label "><span class='text-danger'>*</span>
                                                Ngày khởi chiếu:</label>
                                            <input type="date" class="form-control" id="release_date" name="release_date"
                                                value="{{ old('release_date', $movie->release_date) }}"
                                                @disabled($movie->is_publish)>
                                            @error('release_date')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="end_date" class="form-label "><span class='text-danger'>*</span>
                                                Ngày kết thúc:</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date"
                                                value="{{ old('end_date', $movie->end_date) }}" @disabled($movie->is_publish)>
                                            @error('end_date')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="duration" class="form-label "><span class='text-danger'>*</span>
                                                Thời lượng:</label>
                                            <input type="number" class="form-control" id="duration" name="duration"
                                                value="{{ old('duration', $movie->duration) }}" placeholder="127 (phút)"
                                                @disabled($movie->is_publish)>
                                            @error('duration')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="category" class="form-label "><span class='text-danger'>*</span> Thể
                                                loại:</label>
                                            <input type="text" class="form-control" id="category" name="category"
                                                value="{{ old('category', $movie->category) }}"
                                                placeholder="Hoạt hình, Khám phá">
                                            @error('category')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-8 mb-3">
                                            <label for="rating" class="form-label "><span class='text-danger'>*</span>
                                                Giới hạn độ tuổi:</label>
                                            <select name="rating" id="" class="form-select">
                                                @foreach ($ratings as $rating)
                                                    <option value="{{ $rating['name'] }}" @selected(old('rating', $movie->rating) == $rating['name'])>
                                                        {{ $rating['name'] }} - {{ $rating['description'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('rating')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class='versionOld'>
                                                <label class="form-check-label mb-2" for="versions[]"><span
                                                        class='text-danger'>*</span> Phiên bản:</label>
                                                <select class="js-example-basic-multiple" @disabled($movie->is_publish)
                                                    name="versions[]" multiple="multiple">

                                                    @foreach ($versions as $version)
                                                        <option @selected(in_array($version['name'], old('versions', $movieVersions)))>{{ $version['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('versions')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="description" class="form-label"><span
                                                    class='text-danger'>*</span> Mô tả phim:</label>
                                            <textarea class="form-control " rows="5" name="description"
                                                placeholder='Hành trình ra khơi của những băng hải tặc, phiêu lưu trên bờ biển "Đại hải trình" để truy tìm, khám phá kho báu One Piece của vua hải tặc tiền nhiệm God D Roger. '>{{ old('description',$movie->description )}}</textarea>
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
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Phụ thu</h4>
                        <div class="text-end">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <table class="table table-bordered rounded align-middle " style="width:100%">
                                        {{-- <thead>
                                            <tr class='table-light'>
                                                <th colspan='2' class="text-center">Loại ghế</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($typeSeats as $seat)
                                                <tr>
                                                    <td>{{ $seat->name }}</td>
                                                    <td>
                                                        <input type="number"
                                                            class="form-control"
                                                            value="{{  $seat->price}}" disabled>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <thead>
                                            <tr class='table-light'>
                                                <th colspan='2' class="text-center">PHỤ THU</th>
                                            </tr>
                                        </thead> --}}
                                        <tbody>
                                            {{-- @foreach ($typeRooms as $room)
                                                @if ($room->surcharge > 0)
                                                    <tr>
                                                        <td>{{ $room->name }}</td>
                                                        <td>
                                                            <input type="number"
                                                                class="form-control" value="{{ $room->surcharge }}" disabled>

                                                        </td>
                                                    </tr>
                                                @endif

                                            @endforeach --}}
                                            <tr>
                                                <td><span class='text-danger'></span> Giá vé thu thêm</td>
                                                <td>
                                                    <input type="number" name="surcharge" class="form-control"
                                                        onwheel="return false;" placeholder="0đ"
                                                        value="{{ old('surcharge',$movie->surcharge) }}">

                                                    @error('surcharge')
                                                        <div class='mt-1'>
                                                            <span class="text-danger">{{ $message }}</span>
                                                        </div>
                                                    @enderror
                                                </td>

                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <!--end row-->
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="text-end">
                            @if ($movie->is_publish)
                                <a href="{{ route('admin.movies.index') }}" class="btn btn-light">Danh sách</a>
                                <button type="submit" class="btn btn-primary mx-2">Cập nhật</button>
                            @else
                                <button type="submit" class="btn btn-light" name="action" value="draft">Lưu
                                    nháp</button>
                                <button type="submit" class="btn btn-primary mx-2" name="action" value="publish">Xuất
                                    bản</button>
                            @endif
                        </div>
                    </div>
                    <!--end col-->
                </div>
            </div>
            <div class="col-lg-3 col-md-3 ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-seat ">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Cập nhật</h4>
                                @if ($movie->is_publish)
                                    <span class="badge fs-11 bg-success-subtle text-success">
                                        Đã xuất bản
                                    </span>
                                @else
                                    <span class="badge fs-11 bg-primary-subtle text-primary">
                                        Bản nháp
                                    </span>
                                @endif


                            </div><!-- end card header -->
                            <div class="card-body ">

                                <div class="row ">
                                    {{-- <div class="col-md-12 mb-2">
                                        <label class="form-label">Trạng thái:</label>
                                        <span class="text-muted">{{ $movie->is_publish ? "Đã xuất bản":'Bản nháp' }}</span>
                                    </div> --}}
                                    <div class="col-md-12 mb-2 d-flex ">
                                        <label class="form-label">Hoạt động:</label>
                                        <span class="text-muted mx-2">
                                            <div class="form-check form-switch form-switch-success">
                                                <input class="form-check-input switch-is-active" name="is_active"
                                                    type="checkbox" role="switch" @checked(old('is_active', $movie->is_active))>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-md-12 mb-2 d-flex ">
                                        <label class="form-label">Nổi bật:</label>
                                        <span class="text-muted mx-2">
                                            <div class="form-check form-switch form-switch-danger">
                                                <input class="form-check-input switch-is-active" name="is_hot"
                                                    type="checkbox" role="switch" @checked(old('is_hot', $movie->is_hot))>
                                            </div>
                                        </span>
                                    </div>


                                </div>
                                <div class="text-end">
                                    @if ($movie->is_publish)
                                        <a href="{{ route('admin.movies.index') }}" class="btn btn-light">Danh sách</a>
                                        <button type="submit" class="btn btn-primary mx-2">Cập nhật</button>
                                    @else
                                        <button type="submit" class="btn btn-light" name="action" value="draft">Lưu
                                            nháp</button>
                                        <button type="submit" class="btn btn-primary mx-2" name="action"
                                            value="publish">Xuất bản</button>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-2">
                                    <label for="" class="form-label"><span class='text-danger'>*</span> Hình
                                        ảnh:</label>
                                    <input type="file" name="img_thumbnail" id="" class="form-control">
                                    {{-- @if ($movie->img_thumbnail && \Storage::exists($movie->img_thumbnail))
                                        <div class="text-center mt-2">
                                            <img src="{{ Storage::url($movie->img_thumbnail) }}" alt=""
                                            width="35%" >
                                        </div>
                                    @else
                                        No image !
                                    @endif --}}

                                    @php
                                        $url = $movie->img_thumbnail;

                                        if (!\Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }

                                    @endphp
                                    @if (!empty($movie->img_thumbnail))
                                        <div class="text-center mt-2">
                                            <img src="{{ $url }}" alt="" width="45%">
                                        </div>
                                    @else
                                        No image !
                                    @endif
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
                                    <label for="trailer_url" class="form-label"><span class='text-danger'>*</span> Code
                                        Youtube:</label>
                                    <input type="text" class="form-control" id="trailer_url" name="trailer_url"
                                        value="{{ old('trailer_url',$movie->trailer_url) }}" placeholder="ZQkU_oI2NOU">
                                    @if ($movie->trailer_url)
                                        <div class="text-center">
                                            <iframe class="w-100 mt-2"
                                                src="https://www.youtube.com/embed/{{ $movie->trailer_url }}"
                                                title="YouTube video player" allowfullscreen>
                                            </iframe>
                                        </div>
                                    @endif
                                    @error('trailer_url')
                                        <div class='mt-1'>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
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
    <script>
        function toggleInput() {
            const toggleDiv = document.getElementById('toggleDiv');
            const inputContainer = document.getElementById('inputContainer');

            if (inputContainer.style.display === 'none') {
                inputContainer.style.display = 'block';
                toggleDiv.style.display = 'none'; // Hide "Thêm mới ?"
            } else {
                inputContainer.style.display = 'none';
                toggleDiv.style.display = 'block'; // Show "Thêm mới ?"
            }
        }

        function cancelInput() {
            const inputContainer = document.getElementById('inputContainer');
            const toggleDiv = document.getElementById('toggleDiv');
            const versionsSelect = document.getElementById('versionsSelect');

            // Clear selected options
            $(versionsSelect).val([]).trigger('change'); // Sử dụng jQuery để xóa select

            inputContainer.style.display = 'none';
            toggleDiv.style.display = 'block'; // Show "Thêm mới ?"
        }
    </script>
@endsection
