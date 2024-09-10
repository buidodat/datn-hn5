@extends('admin.layouts.master')

@section('title')
    Thêm mới phòng chiếu
@endsection

@section('content')
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <form action="{{ route('admin.rooms.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thêm mới phòng chiếu</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.rooms.index') }}">Danh sách</a></li>
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
                <div class="card card-left">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin phòng chiếu</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div class="row ">
                                        <div class="col-md-12 mb-3">
                                            <label for="name" class="form-label ">Tên phòng chiếu:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}" placeholder="Nhập tên phòng chiếu">
                                            @error('name')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="surcharge" class="form-label ">Chi nhánh:</label>
                                            <select name="rating" id="" class="form-select">
                                                <option value="">Chọn chi nhánh</option>
                                                {{-- @foreach ($ratings as $rating)
                                                    <option value="{{ $rating }}" @selected(old('rating') == $rating )>{{ $rating }}</option>
                                                @endforeach --}}
                                            </select>
                                            @error('surcharge')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-8 mb-3">
                                            <label for="surcharge" class="form-label ">Rạp chiếu:</label>
                                            <select name="rating" id="" class="form-select">
                                                <option value="">Chọn rạp chiếu</option>
                                                {{-- @foreach ($ratings as $rating)
                                                    <option value="{{ $rating }}" @selected(old('rating') == $rating )>{{ $rating }}</option>
                                                @endforeach --}}
                                            </select>
                                            @error('surcharge')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="surcharge" class="form-label ">Loại phòng chiếu:</label>
                                            <select name="rating" id="" class="form-select">
                                                <option value="">Chọn loại phòng chiếu</option>
                                                @foreach ($typeRooms as $typeRoom)
                                                    <option value="{{ $typeRoom }}" @selected(old('typeRoom') == $typeRoom )>{{ $typeRoom }}</option>
                                                @endforeach
                                            </select>
                                            @error('surcharge')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="surcharge" class="form-label ">Tổng số ghế:</label>
                                            <select name="rating" id="" class="form-select">
                                                <option value="">Chọn tổng số ghế</option>
                                                @foreach ($totalSeats as $totalSeat)
                                                    <option value="{{ $totalSeat }}" @selected(old('totalSeat') == $totalSeat)>
                                                        {{ $totalSeat }}</option>
                                                @endforeach
                                            </select>
                                            @error('surcharge')
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

        </div>

        <div class="row">
            <div class="col-lg-9">
                <div class="card card-left">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Sơ đồ ghế</h4>
                    </div><!-- end card header -->
                    <div class="card-body">

                        <table class="table table-bordered dt-responsive nowrap table-striped align-middle">
                            <tbody>
                                <!-- Row A -->
                                <tr>
                                    <td>
                                        <div class="seat">A1</div>
                                    </td>
                                    <td>
                                        <div class="seat">A2</div>
                                    </td>
                                    <td>
                                        <div class="seat">A3</div>
                                    </td>
                                    <td>
                                        <div class="seat">A4</div>
                                    </td>
                                    <td>
                                        <div class="seat">A5</div>
                                    </td>
                                    <td>
                                        <div class="seat">A6</div>
                                    </td>
                                    <td>
                                        <div class="seat">A7</div>
                                    </td>
                                    <td>
                                        <div class="seat">A8</div>
                                    </td>
                                    <td>
                                        <div class="seat">A9</div>
                                    </td>
                                    <td>
                                        <div class="seat">A10</div>
                                    </td>
                                    <td>
                                        <div class="seat">A11</div>
                                    </td>
                                    <td>
                                        <div class="seat">A12</div>
                                    </td>
                                    <td>
                                        <button class="btn btn-link edit-btn">
                                            <i class="fas fa-edit edit-icon"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row B -->
                                <tr>
                                    <td>
                                        <div class="seat">B1</div>
                                    </td>
                                    <td>
                                        <div class="seat">B2</div>
                                    </td>
                                    <td>
                                        <div class="seat">B3</div>
                                    </td>
                                    <td>
                                        <div class="seat">B4</div>
                                    </td>
                                    <td>
                                        <div class="seat">B5</div>
                                    </td>
                                    <td>
                                        <div class="seat">B6</div>
                                    </td>
                                    <td>
                                        <div class="seat">B7</div>
                                    </td>
                                    <td>
                                        <div class="seat">B8</div>
                                    </td>
                                    <td>
                                        <div class="seat">B9</div>
                                    </td>
                                    <td>
                                        <div class="seat">B10</div>
                                    </td>
                                    <td>
                                        <div class="seat">B11</div>
                                    </td>
                                    <td>
                                        <div class="seat">B12</div>
                                    </td>
                                    <td>
                                        <button class="btn btn-link edit-btn">
                                            <i class="fas fa-edit edit-icon"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
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

        </div>

        {{-- <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Thông tin phòng chiếu</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form action="#" class="form-steps" autocomplete="off">
                            <div class="text-center pt-3 pb-4 mb-1 d-flex justify-content-center">
                                <img src="assets/images/logo-dark.png" class="card-logo card-logo-dark" alt="logo dark" height="17">
                                <img src="assets/images/logo-light.png" class="card-logo card-logo-light" alt="logo light" height="17">
                            </div>
                            <div class="step-arrow-nav mb-4">

                                <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link done" id="steparrow-gen-info-tab" data-bs-toggle="pill"
                                            data-bs-target="#steparrow-gen-info" type="button" role="tab"
                                            aria-controls="steparrow-gen-info" aria-selected="true">Thông tin
                                            chung</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="steparrow-description-info-tab"
                                            data-bs-toggle="pill" data-bs-target="#steparrow-description-info"
                                            type="button" role="tab" aria-controls="steparrow-description-info"
                                            aria-selected="false">Sơ đồ ghế</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-experience" type="button" role="tab"
                                            aria-controls="pills-experience" aria-selected="false">Hoàn thành</button>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade" id="steparrow-gen-info" role="tabpanel"
                                    aria-labelledby="steparrow-gen-info-tab">
                                    <div class="row ">
                                        <div class="col-md-12 mb-3">
                                            <label for="name" class="form-label ">Tên phòng chiếu:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}" placeholder="Nhập tên phòng chiếu">
                                            @error('name')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="surcharge" class="form-label ">Chi nhánh:</label>
                                            <select name="rating" id="" class="form-select">
                                                <option value="">Chọn chi nhánh</option>

                                            </select>
                                            @error('surcharge')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-8 mb-3">
                                            <label for="surcharge" class="form-label ">Rạp chiếu:</label>
                                            <select name="rating" id="" class="form-select">
                                                <option value="">Chọn rạp chiếu</option>

                                            </select>
                                            @error('surcharge')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="surcharge" class="form-label ">Loại phòng chiếu:</label>
                                            <select name="rating" id="" class="form-select">
                                                <option value="">Chọn loại phòng chiếu</option>

                                            </select>
                                            @error('surcharge')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="surcharge" class="form-label ">Tổng số ghế:</label>
                                            <select name="rating" id="" class="form-select">
                                                <option value="">Chọn tổng số ghế</option>
                                                @foreach ($totalSeats as $totalSeat)
                                                    <option value="{{ $totalSeat }}" @selected(old('totalSeat') == $totalSeat)>
                                                        {{ $totalSeat }}</option>
                                                @endforeach
                                            </select>
                                            @error('surcharge')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button"
                                            class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                            data-nexttab="steparrow-description-info-tab"><i
                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to
                                            more info</button>
                                    </div>
                                </div>
                                <!-- end tab pane -->

                                <div class="tab-pane fade show active" id="steparrow-description-info" role="tabpanel"
                                    aria-labelledby="steparrow-description-info-tab">
                                    <div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Upload Image</label>
                                            <input class="form-control" type="file" id="formFile" />
                                        </div>
                                        <div>
                                            <label class="form-label" for="des-info-description-input">Description</label>
                                            <textarea class="form-control" placeholder="Enter Description" id="des-info-description-input" rows="3"
                                                required></textarea>
                                            <div class="invalid-feedback">Please enter a description</div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button" class="btn btn-light btn-label previestab"
                                            data-previous="steparrow-gen-info-tab"><i
                                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                            General</button>
                                        <button type="button"
                                            class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                            data-nexttab="pills-experience-tab"><i
                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                    </div>
                                </div>
                                <!-- end tab pane -->

                                <div class="tab-pane fade" id="pills-experience" role="tabpanel">
                                    <div class="text-center">

                                        <div class="avatar-md mt-5 mb-4 mx-auto">
                                            <div class="avatar-title bg-light text-success display-4 rounded-circle">
                                                <i class="ri-checkbox-circle-fill"></i>
                                            </div>
                                        </div>
                                        <h5>Well Done !</h5>
                                        <p class="text-muted">You have Successfully Signed Up</p>
                                    </div>
                                </div>
                                <!-- end tab pane -->
                            </div>
                            <!-- end tab content -->
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
        </div> --}}



        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-info">Danh sách</a>
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
