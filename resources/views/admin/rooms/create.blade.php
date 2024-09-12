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
            <div class="col-lg-12">
                <div class="card card-left">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Sơ đồ ghế</h4>
                    </div><!-- end card header -->
                    <div class="card-body">

                        {{-- <table class="table table-none text-center align-middle">
                            <tbody>
                                <!-- Row A -->
                                <tr>
                                    @for ($i =0 ; $i < 10 ; $i++)
                                        <td>
                                            <img src="{{ asset('svg/seat-regular.svg') }}" width="40px">
                                        </td>
                                    @endfor
                                    <td>
                                        <button class="btn btn-link edit-btn">
                                            <i class="fas fa-edit edit-icon"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Row B -->
                                <tr>
                                    @for ($i =0 ; $i < 10 ; $i++)
                                        <td>
                                            <img src="{{ asset('svg/seat-vip.svg') }}" width="40px">
                                        </td>
                                    @endfor
                                    <td>
                                        <button class="btn btn-link edit-btn">
                                            <i class="fas fa-edit edit-icon"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    @for ($i =0 ; $i < 5 ; $i++)
                                        <td colspan="2">
                                            <img src="{{ asset('svg/seat-double.svg') }}" width="70px">
                                        </td>
                                    @endfor
                                    <td>
                                        <button class="btn btn-link edit-btn">
                                            <i class="fas fa-edit edit-icon"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table> --}}

                        <div class="col-md-12 w-75 mx-auto content-room-seat">

                            <div class="list-seats">
                                <div class="row justify-content-center">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="40px">
                                            <span class=" fs-5 mx-2">Ghế thường</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                            <span class=" fs-5 mx-2">Ghế Vip</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center">
                                            {{-- <div class="d-flex"> --}}
                                                <img src="{{ asset('svg/seat-double.svg') }}" class='seat' width="40px">
                                                {{-- <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                                <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px"> --}}
                                            {{-- </div> --}}
                                            <span class=" fs-5 mx-2 ">Ghế Đôi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="srceen">
                                Màn Hình Chiếu
                            </div>

                            <div class="layout-seat">
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 14; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="40px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 16; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="40px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 17; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="40px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 18; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 18; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 18; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                {{-- <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 18; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-double.svg') }}" class='seat' width="45px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 18; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-double.svg') }}" class='seat' width="45px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div> --}}
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
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/mainstyle.css') }}">
@endsection

