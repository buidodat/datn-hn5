@extends('admin.layouts.master')

@section('title')
    Cập nhật phòng chiếu
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
                <h4 class="mb-sm-0">Quản lý phòng chiếu</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.rooms.index') }}">Phòng chiếu</a></li>
                        <li class="breadcrumb-item active">Cập nhật</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
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
                                        <label for="name" class="form-label "><span class="text-danger">*</span> Tên
                                            phòng chiếu:</label>
                                        <input type="text" class="form-control" value="{{ $room->name }}">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="branchId" class="form-label"><span class="text-danger">*</span> Chi
                                            Nhánh</label>
                                        <select class="form-select" id="branchId" name="branch_id"
                                            onchange="loadCinemas()">
                                            <option value="" disabled selected>Chọn chi nhánh</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}" @selected($room->branch->id == $branch->id)>
                                                    {{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="cinemaId" class="form-label"><span class="text-danger">*</span> Rạp
                                            Chiếu</label>
                                        <select class="form-select" id="cinemaId" name="cinema_id" required>
                                            @foreach ($cinemas as $cinema)
                                                <option value="{{ $cinema->id }}" @selected($room->cinema->id == $cinema->id)>
                                                    {{ $cinema->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="surcharge" class="form-label "><span class="text-danger">*</span> Loại
                                            phòng chiếu:</label>
                                        <select class="form-select" id="type_room_id" name="type_room_id" required>
                                            @foreach ($typeRooms as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="matrix_id" class="form-label "><span class="text-danger">*</span> Ma
                                            trận ghế:</label>
                                        <select name="" id="" class='form-select' disabled>
                                            @foreach (App\Models\Room::MATRIXS as $matrix)
                                                <option value="{{ $matrix['name'] }}">
                                                    {{ $matrix['name'] }}
                                                </option>
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
            <div class="card card-seat ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Xuất bản</h4>
                </div><!-- end card header -->
                <div class="card-body ">
                    <table class="table table-borderless   align-middle mb-0">
                        <tbody>
                            <tr>
                                <td>Ghế thường</td>
                                <td class="text-center"> <img src="{{ asset('svg/seat-regular.svg') }}" height="30px">
                                </td>
                            </tr>
                            <tr>
                                <td>Ghế vip</td>
                                <td class="text-center"> <img src="{{ asset('svg/seat-vip.svg') }}" height="30px">
                                </td>
                            </tr>
                            <tr>
                                <td>Ghế đôi</td>
                                <td class="text-center"> <img src="{{ asset('svg/seat-double.svg') }}" height="30px"></td>
                            <tr class="table-active">
                                <th colspan='2' class="text-center">Tổng {{ $seats->count() }} chỗ ngồi</th>

                            </tr>
                        </tbody>
                    </table>

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
                    <div class="card-body mb-3">

                        <table class="table-chart-chair table-none align-middle mx-auto text-center mb-5">
                            <thead>
                                <tr>
                                    <th></th> <!-- Ô trống góc trên bên trái -->
                                    @for ($col = 0; $col < $matrixSeat['max_col']; $col++)
                                        <th class="box-item">
                                            {{-- thao tác 1 loạt trên 1 cột --}}
                                            {{-- <i class="fas fa-edit primary"></i> --}}
                                        </th>
                                    @endfor
                                    <th></th> <!-- Ô trống góc trên bên trái -->
                                </tr>
                            </thead>
                            <tbody>
                                @for ($row = 0; $row < $matrixSeat['max_row']; $row++)
                                    <tr>
                                        {{-- cột hàng ghế A,B,C --}}
                                        <td class="box-item">
                                            {{ chr(65 + $row) }}
                                        </td>
                                        @for ($col = 0; $col < $matrixSeat['max_col']; $col++)
                                            @if ($row <  4)
                                                {{-- bắt đầu hàng ghế thường --}}
                                                <td class="box-item-seat border-1 light-orange">
                                                    <div class="box-item-seat-selected">
                                                        <img src="{{ asset('svg/seat-regular.svg') }}" class='seat'
                                                            width="100%">
                                                        <input type="hidden" name="seatJsons[]"
                                                            value='{"coordinates_x": {{ $col + 1 }}, "coordinates_y": "{{ chr(65 + $row) }}"}'>
                                                    </div>
                                                </td>
                                                {{-- kết thúchàng ghế thường --}}
                                            @else
                                                {{-- bắt đầu hàng ghế vip --}}
                                                <td class="box-item-seat border-1 light-blue">
                                                    <div class="box-item-seat-selected">
                                                        <img src="{{ asset('svg/seat-vip.svg') }}" class='seat'
                                                            width="100%">
                                                        <input type="hidden" name="seatJsons[]"
                                                            value='{"coordinates_x": {{ $col + 1 }}, "coordinates_y": "{{ chr(65 + $row) }}"}'>
                                                    </div>
                                                </td>
                                                {{-- kết thúc hàng ghế vip --}}
                                            @endif
                                        @endfor
                                        <td class="box-item">
                                            {{-- thao tác 1 loạt trên 1 hàng --}}
                                            <i class="fas fa-edit primary"></i>
                                        </td>
                                    </tr>
                                @endfor

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-seat ">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Chú thích</h4>
                    </div><!-- end card header -->
                    <div class="card-body ">
                        <table class="table table-borderless   align-middle mb-0">
                            <tbody>
                                <tr>
                                    <td>Hàng ghế thường</td>
                                    <td class="text-center">
                                        <div class='box-item border light-orange'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hàng ghế vip</td>
                                    <td class="text-center">
                                        <div class='box-item border light-blue'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hàng ghế đôi</td>
                                    <td class="text-center">
                                        <div class='box-item border light-pink'></div>
                                    </td>
                                <tr class="table-active">
                                    <th colspan='2' class="text-center">Tổng {{ $seats->count() }} chỗ ngồi</th>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 mb-5 text-end">

                <div class="">
                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-info">Danh sách</a>
                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-primary mx-2">Cập nhật</a>
                </div>

            </div>
            <!--end col-->
        </div>

    @endsection

    @section('style-libs')
        <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/mainstyle.css') }}">
    @endsection


    @section('script-libs')
        <script>
            function loadCinemas() {
                const branchId = document.getElementById('branchId').value;
                const cinemaSelect = document.getElementById('cinemaId');
                cinemaSelect.innerHTML = '<option value="" disabled selected>Chọn rạp chiếu</option>'; // Reset options

                if (branchId) {
                    console.log();

                    fetch(`http://datn-hn5.me/api/cinemas/${branchId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data && data.length > 0) {
                                data.forEach(cinema => {
                                    const option = document.createElement('option');
                                    option.value = cinema.id;
                                    option.textContent = cinema.name;
                                    cinemaSelect.appendChild(option);
                                });
                            } else {
                                cinemaSelect.innerHTML +=
                                    '<option value="" disabled selected>Không có rạp chiếu nào</option>';
                            }
                        })
                        .catch(error => console.error('Error loading cinemas:', error));
                } else {
                    cinemaSelect.innerHTML = '<option value="" disabled selected>Chọn rạp chiếu</option>';
                }
            }

        </script>
         <script>
            document.querySelectorAll('.box-item-seat').forEach(function(seat) {
                // Lưu trữ nội dung ban đầu của .box-item-seat-selected
                let originalContent = seat.querySelector('.box-item-seat-selected').innerHTML;

                seat.addEventListener('click', function() {
                    let seatSelected = seat.querySelector('.box-item-seat-selected');

                    // Kiểm tra nếu div đang chứa nội dung ban đầu
                    if (seatSelected.innerHTML.trim() === originalContent.trim()) {
                        // Nếu là nội dung ban đầu, thay đổi thành hình ảnh mới
                        seatSelected.innerHTML =
                            `<img src="{{ asset('svg/seat-add.svg') }}" class='seat' width="60%" >`;
                    } else {
                        // Nếu không phải nội dung ban đầu, khôi phục lại nội dung ban đầu
                        seatSelected.innerHTML = originalContent;
                    }
                });
            });
        </script>
    @endsection
