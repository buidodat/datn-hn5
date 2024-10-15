@extends('admin.layouts.master')

@section('title')
    Đặt vé tại quầy
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

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Đặt vé tại quầy</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.rooms.index') }}">Lịch chiếu</a></li>
                        <li class="breadcrumb-item active">Chọn ghế</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- thông tin -->
    {{-- <div class="row mb-2">
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
                                            <input type="text" class="form-control" value="{{ $room->name }}" disabled>

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="branch" class="form-label">Chi nhánh:</label>
                                            <input type="text" class="form-control"
                                                value="{{ $room->cinema->branch->name }}" disabled>
                                        </div>

                                        <div class="col-md-4 mb-3">

                                            <label for="cinema" class="form-label">Rạp chiếu:</label>
                                            <input type="text" class="form-control" value="{{ $room->cinema->name }}"
                                                disabled>

                                        </div>
                                        <div class="col-md-4 mb-3">

                                            <label for="surcharge" class="form-label ">Loại phòng chiếu:</label>
                                            <select name="type_room_id" id="" class="form-select" disabled>
                                                @foreach ($typeRooms as $id => $name)
                                                    <option value="{{ $id }}" @selected($room->type_room_id == $id)>
                                                        {{ $name }}</option>
                                                @endforeach
                                            </select>

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

        </div> --}}


    <div class="row">

    </div>
    <div class="row">

        <div class="col-lg-8">
            <div class="row">
                {{-- <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Thông tin phòng chiếu</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div class="row ">
                                            <div class="col-md-12 mb-2">
                                                <label for="name" class="form-label ">Tên phòng chiếu:</label>
                                                <input type="text" class="form-control" value="{{ $room->name }}"
                                                    disabled>
                                            </div>


                                            <div class="col-md-3 mb-2">
                                                <label for="branch" class="form-label">Chi nhánh:</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $room->cinema->branch->name }}" disabled>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="cinema" class="form-label">Rạp chiếu:</label>
                                                <input type="text" class="form-control" value="{{ $room->cinema->name }}"
                                                    disabled>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="surcharge" class="form-label ">Loại phòng chiếu:</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $room->typeRoom->name }}" disabled>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="surcharge" class="form-label ">Ma trận ghế:</label>
                                                <input type="text" class="form-control" value=""
                                                    disabled>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <!--end row-->
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Sơ đồ ghế</h4>
                        </div><!-- end card header -->
                        <div class="card-body mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="list-seats my-3">
                                        <div class="list-seat">
                                            <span class='seat-vip-svg '></span>
                                            <span class="status-seat">Ghế trống</span>
                                        </div>
                                        <div class="list-seat"> <span class='seat-vip-svg seat-selected'></span>
                                            <span class="status-seat">Ghế đang chọn</span>
                                        </div>
                                        <div class="list-seat"><span class='seat-vip-svg seat-hold'></span>
                                            <span class="status-seat">Ghế đang được giữ</span>
                                        </div>
                                        <div class="list-seat"><span class='seat-vip-svg seat-sold'></span>
                                            <span class="status-seat">Ghế đã bán</span>
                                        </div>
                                    </div>
                                    <div class="srceen mb-4">
                                        Màn Hình Chiếu
                                    </div>
                                </div>
                            </div>
                            <table class="table-chart-chair table-none align-middle mx-auto text-center">
                                <tbody>
                                    @for ($row = 0; $row < $matrix['max_row']; $row++)
                                        <tr>
                                            <td class="box-item">{{ chr(65 + $row) }}</td>
                                            @for ($col = 0; $col < $matrix['max_col']; $col++)
                                                @php
                                                    // Kiểm tra xem ô hiện tại có trong seatMap không
                                                    $seatType =
                                                        isset($seatMap[chr(65 + $row)]) &&
                                                        isset($seatMap[chr(65 + $row)][$col + 1])
                                                            ? $seatMap[chr(65 + $row)][$col + 1]
                                                            : null;
                                                @endphp
                                                @if ($seatType == 3)
                                                    <!-- Nếu là ghế đôi -->
                                                    <td class="box-item" colspan="2">
                                                        <div class="seat-item">
                                                            <!-- 3 cho ghế đôi -->
                                                            <span class="seat-double-svg"></span>
                                                            <span
                                                                class="seat-label-double">{{ chr(65 + $row) . ($col + 1) }}
                                                                {{ chr(65 + $row) . ($col + 2) }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="box-item" style="display: none;">
                                                        <div class="seat-item">
                                                            <img src="{{ asset('svg/seat-add.svg') }}" class='seat'
                                                                width="60%">
                                                        </div>
                                                    </td>
                                                    @php $col++; @endphp
                                                @else
                                                    <td class="box-item">
                                                        <div class="seat-item">
                                                            @switch($seatType)
                                                                @case(1)
                                                                    <img src="{{ asset('svg/seat-regular.svg') }}" class='seat'
                                                                        width="100%">
                                                                    <span class="seat-label">{{ chr(65 + $row) . $col + 1 }}</span>
                                                                @break

                                                                @case(2)
                                                                    <img src="{{ asset('svg/seat-vip.svg') }}" class='seat'
                                                                        width="100%">
                                                                    <span class="seat-label">{{ chr(65 + $row) . $col + 1 }}</span>
                                                                @break
                                                            @endswitch

                                                        </div>
                                                    </td>
                                                @endif
                                            @endfor
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                            <div class="legend">

                                <div><span class="seat-regular-svg"></span> Ghế Thường
                                </div>
                                <div><span class="seat-vip-svg"></span> Ghế Vip</div>
                                <div><span class="seat-double-svg"></span> Ghế Đôi</div>
                                <div>
                                    <p>Thời gian còn lại:</p>
                                    <p id="timer" class="bold">8:16</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header border bg-opacity-75 bg-info-subtle ">
                    <h5 class="card-title mb-0 text-center">Thông tin phim</h5>
                </div>
                <div class="movie-info mt-3 d-flex">
                    <div class='img-movie'>
                        <img src="https://files.betacorp.vn/media%2fimages%2f2024%2f08%2f16%2f400x633%2D5%2D161700%2D160824%2D33.jpg"
                            width="100%">
                    </div>
                    <div class='name-movie mx-3 '>
                        <h3 class='text-primary my-2'>Làm giàu với ma</h3>
                        <div class="fs-5 mt-2">
                            <span>2D Phụ Đề</span>
                        </div>
                    </div>
                </div>
                <div class='card-header border-bottom-dashed border-2'>
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td>Thể loại:</td>
                                    <td class="text-end fw-bold">Kinh dị</td>
                                </tr>
                                <tr>
                                    <td>Thời lượng: </td>
                                    <td class="text-end fw-bold">138 phút</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td>Rạp chiếu: </td>
                                    <td class="text-end fw-bold">Poly Mỹ Đình</td>
                                </tr>
                                <tr>
                                    <td>Ngày chiếu</td>
                                    <td class="text-end fw-bold">14/10/2024</td>
                                </tr>
                                <tr>
                                    <td>Giờ chiếu:</td>
                                    <td class="text-end fw-bold" id="cart-shipping">20:00 ~ 21:38</td>
                                </tr>
                                <tr>
                                    <td>Phòng Chiếu: </td>
                                    <td class="text-end fw-bold" id="cart-tax">P201</td>
                                </tr>
                                <tr>
                                    <td>Ghế ngồi: </td>
                                    <td class="text-end fw-bold" id="cart-tax">L8,L9 </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="text-end my-3">
                <button  class="btn btn-success btn-label right ms-auto"><i class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Tiếp tục</button>
            </div>

        </div>

    </div>


@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/mainstyle.css') }}">
@endsection
