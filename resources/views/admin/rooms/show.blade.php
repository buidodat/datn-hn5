@extends('admin.layouts.master')

@section('title')
    Chi tiết phòng chiếu
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
                    <h4 class="mb-sm-0">Chi tiết phòng chiếu</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.rooms.index') }}">Danh sách</a></li>
                            <li class="breadcrumb-item active">Chi tiết</li>
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
                                            <input type="text" class="form-control" value="{{ $room->name }}" disabled>

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="branch" class="form-label">Chi nhánh:</label>
                                            <input type="text" class="form-control"
                                                value="{{ $room->cinema->branch->name }}" disabled>
                                        </div>

                                        <div class="col-md-8 mb-3">

                                            <label for="cinema" class="form-label">Rạp chiếu:</label>
                                            <input type="text" class="form-control" value="{{ $room->cinema->name }}"
                                                disabled>

                                        </div>
                                        <div class="col-md-6 mb-3">

                                            <label for="surcharge" class="form-label ">Loại phòng chiếu:</label>
                                            <select name="type_room_id" id="" class="form-select" disabled>
                                                @foreach ($typeRooms as $id => $name)
                                                    <option value="{{ $id }}" @selected($room->type_room_id == $id)>
                                                        {{ $name }}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="col-md-6 mb-3">

                                            <label for="surcharge" class="form-label ">Sức chứa:</label>
                                            <select name="capacity" id="" class="form-select" disabled>
                                                @foreach ($capacities as $capacity)
                                                    <option value="{{ $capacity }}" @selected($room->capacity == $capacity)>
                                                        {{ $capacity }} chỗ ngồi</option>
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

        </div>


        <div class="row">
            <div class="col-lg-9">
                <div class="card card-left">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Sơ đồ ghế</h4>
                    </div><!-- end card header -->
                    <div class="card-body ">


                        <style>
                            .light-orange {
                                background-color: #fcf5e6;
                                /* Màu cam nhạt */
                            }

                            .light-blue {
                                background-color: #fcfdff;
                                /* Màu xanh da trời nhạt */
                            }

                            .light-pink {
                                background-color: #f9d0d0;
                                /* Màu hồng nhạt */
                            }
                        </style>
                        @php
                            $maxCol = App\Models\Room::MAX_COL;
                            $maxRow = App\Models\Room::MAX_ROW;
                            $rowSeatRegular = App\Models\Room::ROW_SEAT_REGULAR;
                        @endphp
                        <table class="table-chart-chair table-none align-middle mx-auto text-center">

                            <tbody>
                                @for ($row = 0; $row < $maxRow; $row++)
                                    <tr>
                                        {{-- cột hàng ghế A,B,C --}}
                                        <td class="box-item">
                                            {{ chr(65 + $row) }}
                                        </td>
                                        @for ($col = 0; $col < $maxCol; $col++)
                                            @if ($row < $rowSeatRegular)
                                                {{-- bắt đầu hàng ghế thường --}}
                                                <td class="box-item box-item-seat border-1 light-orange">

                                                    @foreach($seatRegulars as $seat)
                                                        @if ($seat->coordinates_x  === $col +1  && $seat->coordinates_y  === chr(65 + $row )    )
                                                            <div class="box-item-seat-selected">

                                                                <img src="{{ asset('svg/seat-regular.svg') }}" class='seat'
                                                                    width="100%">

                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                {{-- kết thúchàng ghế thường --}}
                                            @else
                                                {{-- bắt đầu hàng ghế vip --}}
                                                <td class=" box-item box-item-seat border-1 light-blue">
                                                    @foreach($seatVips as $seat)
                                                        @if ($seat->coordinates_x  == $col +1  && $seat->coordinates_y  == chr(65 + $row )    )
                                        
                                                            <div class="box-item-seat-selected">

                                                                <img src="{{ asset('svg/seat-vip.svg') }}" class='seat'
                                                                    width="100%">

                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                {{-- kết thúc hàng ghế vip --}}
                                            @endif
                                        @endfor

                                    </tr>
                                @endfor
                            </tbody>
                        </table>

                        {{-- <script>
                            document.querySelectorAll('.box-item-seat').forEach(function(seat) {
                                // Lưu trữ nội dung ban đầu của .box-item-seat-selected
                                let originalContent = seat.querySelector('.box-item-seat-selected').innerHTML;

                                seat.addEventListener('click', function() {
                                    let seatSelected = seat.querySelector('.box-item-seat-selected');

                                    // Kiểm tra nếu div đang chứa nội dung ban đầu
                                    if (seatSelected.innerHTML.trim() === originalContent.trim()) {
                                        // Nếu là nội dung ban đầu, thay đổi thành hình ảnh mới
                                        seatSelected.innerHTML =
                                            `<img src="{{ asset('svg/seat-add.svg') }}" class='seat' width="70%" >`;
                                    } else {
                                        // Nếu không phải nội dung ban đầu, khôi phục lại nội dung ban đầu
                                        seatSelected.innerHTML = originalContent;
                                    }
                                });
                            });
                        </script> --}}








                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card ">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Chú thích</h4>
                    </div><!-- end card header -->
                    <div class="card-body ">

                        <div class="row mb-3">
                            <div class="col-lg-8 col-md-8 col-8">
                                <label class="form-label">Hàng ghế thường</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-4 ">
                                <div class='box-item border light-orange'>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-8 col-md-8 col-8">
                                <label class="form-label">Hàng ghế vip</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class='box-item border  light-blue'>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-8 col-md-8 col-8">
                                <label class="form-label">Hàng ghế đôi</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class='box-item border  light-pink'>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>



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


@section('script-libs')
@endsection
