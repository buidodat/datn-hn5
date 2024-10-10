@extends('admin.layouts.master')

@section('title')
    Cập nhật sơ đồ ghế
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
                <h4 class="mb-sm-0">Quản lý sơ đồ ghế</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.rooms.index') }}">Sơ đồ ghế</a></li>
                        <li class="breadcrumb-item active">Cập nhật</li>
                    </ol>
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

                    @php
                        $scopeRegular = App\Models\Room::SCOPE_REGULAR;
                        $scopeDouble = App\Models\Room::SCOPE_DOUBLE;
                        $regularRows = range(0, $scopeRegular['default'] - 1); // Các hàng ghế thường
                        $doubleRows = range($matrix['max_row'] - $scopeDouble['default'], $matrix['max_row'] - 1); // Các hàng ghế đôi
                        $vipRows = range($scopeRegular['default'], $matrix['max_row'] - $scopeDouble['default'] - 1); // Các hàng ghế VIP
                    @endphp

                    <table class="table-chart-chair table-none align-middle mx-auto text-center mb-5">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            @for ($row = 0; $row < $matrix['max_row']; $row++)
                                @php
                                    $rowChar = chr(65 + $row);
                                    $rowClass = '';
                                    $isAllRegular = $isAllVip = false; // Khởi tạo trạng thái

                                    if (in_array($row, $regularRows)) {
                                        $rowClass = 'light-orange'; // Ghế thường
                                        $isAllRegular = true; // Đặt trạng thái là ghế thường
                                    } elseif (in_array($row, $doubleRows)) {
                                        $rowClass = 'light-pink'; // Ghế đôi
                                    } else {
                                        $rowClass = 'light-blue'; // Ghế VIP
                                        $isAllVip = true; // Đặt trạng thái là ghế VIP
                                    }
                                @endphp
                                <tr>
                                    {{-- cột hàng ghế A,B,C --}}
                                    <td class="box-item">
                                        {{ $rowChar }}
                                    </td>
                                    @for ($col = 0; $col < $matrix['max_col']; $col++)
                                        <td class="box-item border-1 {{ $rowClass }}" data-row="{{ $rowChar }}">
                                            <div class="box-item-seat"
                                                data-type="{{ in_array($row, $regularRows) ? 'regular' : (in_array($row, $doubleRows) ? 'double' : 'vip') }}">
                                                <img src="{{ asset('svg/seat-add.svg') }}" class='seat' width="60%">
                                            </div>
                                        </td>
                                    @endfor
                                    <td class='box-item border-1'>
                                        <span data-bs-toggle="offcanvas" data-bs-target="#rowSeat{{ $rowChar }}">
                                            <i class="fas fa-edit"></i>
                                        </span>

                                        <div class="offcanvas offcanvas-start" tabindex="-1"
                                            id="rowSeat{{ $rowChar }}">
                                            <div class="offcanvas-header border-bottom">
                                                <h5 class="offcanvas-title">Chỉnh sửa hàng ghế {{ $rowChar }}</h5>
                                                <button type="button" class="btn-close text-reset"
                                                    data-bs-dismiss="offcanvas"></button>
                                            </div>
                                            <div class="offcanvas-body">
                                                <div class="row">
                                                    <!-- Custom Radio Color -->
                                                    <div class="col-md-12 mb-3">

                                                        <div class="form-check form-radio-primary mb-3">
                                                            <input class="form-check-input" type="radio"
                                                                name="typeSeatRow{{ $rowChar }}" value="1"
                                                                @checked($isAllRegular)
                                                                data-row="{{ $rowChar }}">
                                                            <label class="form-check-label">Ghế thường</label>
                                                        </div>

                                                        <div class="form-check form-radio-primary mb-3">
                                                            <input class="form-check-input" type="radio"
                                                                name="typeSeatRow{{ $rowChar }}" value="2"
                                                                @checked($isAllVip)
                                                                data-row="{{ $rowChar }}">
                                                            <label class="form-check-label">Ghế VIP</label>
                                                        </div>

                                                        <div class="form-check form-radio-primary mb-3">
                                                            <input class="form-check-input" type="radio"
                                                                name="typeSeatRow{{ $rowChar }}" value="3"
                                                                data-row="{{ $rowChar }}">
                                                            <label class="form-check-label">Ghế đôi</label>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <button class="btn btn-danger btn-remove-all mx-1"
                                                            data-row="{{ $rowChar }}">
                                                            <i class="mdi mdi-trash-can-outline me-1"></i>Bỏ tất cả
                                                        </button>
                                                        <button class="btn btn-info btn-restore-all mx-1"
                                                            data-row="{{ $rowChar }}">
                                                            <i class="ri-add-line align-bottom me-1"></i>Chọn tất cả
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            // Lắng nghe sự kiện click trên ghế
                            document.querySelectorAll('.box-item-seat').forEach(function(seat) {
                                seat.addEventListener('click', function() {
                                    var img = this.querySelector('img');
                                    var currentSrc = img.src;
                                    var seatType = this.dataset.type; // Lấy loại ghế từ data-type
                                    var tdElement = this.closest('td'); // Thẻ td hiện tại

                                    // Kiểm tra trạng thái hiện tại của ghế
                                    if (currentSrc.includes('seat-add.svg')) {
                                        if (seatType === 'double') {
                                            // Gộp thẻ td bên cạnh
                                            var nextTd = tdElement.nextElementSibling;
                                            if (nextTd && nextTd.querySelector('img').src.includes(
                                                    'seat-add.svg')) {
                                                tdElement.colSpan = 2; // Gộp 2 cột
                                                nextTd.style.display = 'none'; // Ẩn thẻ td bên cạnh
                                                img.src = "{{ asset('svg/seat-double.svg') }}"; // Hiển thị ghế đôi
                                                img.style.width = "90%"; // Đặt chiều rộng hình ảnh
                                            }else{
                                                alert('Bên phải không còn chỗ trống để đặt ghế đôi.')
                                            }
                                        } else {
                                            if (seatType === 'regular') {
                                                img.src = "{{ asset('svg/seat-regular.svg') }}";
                                            } else if (seatType === 'vip') {
                                                img.src = "{{ asset('svg/seat-vip.svg') }}";
                                            }
                                            img.style.width = "100%";
                                        }
                                    } else {
                                        // Nếu ghế đã được chọn, trả về hình ảnh mặc định và phục hồi thẻ td
                                        img.style.width = "60%";
                                        img.src = "{{ asset('svg/seat-add.svg') }}"; // Không chọn


                                        if (seatType === 'double' && tdElement.colSpan == 2) {
                                            // Phục hồi ghế đôi
                                            var nextTd = tdElement.nextElementSibling;
                                            tdElement.colSpan = 1; // Đặt lại thành 1 cột
                                            nextTd.style.display = ''; // Hiện lại thẻ td bên cạnh
                                        }
                                    }
                                });
                            });

                            // Lắng nghe sự kiện thay đổi radio button trong Offcanvas
                            document.querySelectorAll('.form-check-input').forEach(function(radio) {
                                radio.addEventListener('change', function() {
                                    var row = this.dataset.row; // Lấy ký hiệu hàng từ thuộc tính data-row
                                    var seatType = this.value; // Loại ghế đã chọn (1: Thường, 2: VIP, 3: Đôi)

                                    // Xóa class hiện tại của các ghế trong hàng
                                    var seats = document.querySelectorAll(`td[data-row="${row}"]`);
                                    seats.forEach(function(seat) {
                                        seat.classList.remove('light-orange', 'light-blue', 'light-pink');
                                    });

                                    // Thêm class mới dựa vào loại ghế đã chọn
                                    var newClass = '';
                                    if (seatType == 1) {
                                        newClass = 'light-orange'; // Ghế thường
                                    } else if (seatType == 2) {
                                        newClass = 'light-blue'; // Ghế VIP
                                    } else if (seatType == 3) {
                                        newClass = 'light-pink'; // Ghế đôi
                                    }

                                    // Áp dụng class mới cho tất cả các ghế trong hàng
                                    seats.forEach(function(seat) {
                                        seat.classList.add(newClass);
                                    });
                                });
                            });

                            // Xử lý nút "Bỏ tất cả" để xóa toàn bộ ghế trong hàng
                            document.querySelectorAll('.btn-remove-all').forEach(function(btn) {
                                btn.addEventListener('click', function() {
                                    var row = this.dataset.row; // Lấy ký hiệu hàng từ thuộc tính data-row
                                    var seats = document.querySelectorAll(`td[data-row="${row}"]`);

                                    // Xóa toàn bộ class của ghế trong hàng
                                    seats.forEach(function(seat) {
                                        seat.classList.remove('light-orange', 'light-blue', 'light-pink');
                                        // Đặt lại hình ảnh về mặc định
                                        var img = seat.querySelector('img');
                                        img.src = "{{ asset('svg/seat-add.svg') }}"; // Không chọn
                                        img.style.width = "60%";
                                    });
                                });
                            });

                            // Xử lý nút "Chọn tất cả" để chọn toàn bộ ghế trong hàng với một class mặc định
                            document.querySelectorAll('.btn-restore-all').forEach(function(btn) {
                                btn.addEventListener('click', function() {
                                    var row = this.dataset.row; // Lấy ký hiệu hàng từ thuộc tính data-row
                                    var seats = document.querySelectorAll(`td[data-row="${row}"]`);

                                    // Áp dụng class 'light-orange' (ghế thường) mặc định cho tất cả các ghế trong hàng
                                    seats.forEach(function(seat) {
                                        seat.classList.remove('light-blue', 'light-pink');
                                        seat.classList.add('light-orange');

                                        // Cập nhật hình ảnh về ghế thường
                                        var img = seat.querySelector('img');
                                        img.src = "{{ asset('svg/seat-regular.svg') }}"; // Ghế thường
                                    });
                                });
                            });
                        });
                    </script>








                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="row">
                <div class="col-md-12">
                    @if ($seatTemplate->is_publish == 1)
                        <div class="card card-seat ">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Cập nhật</h4>
                            </div><!-- end card header -->
                            <div class="card-body ">
                                <div class="row ">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Trạng thái:</label>
                                        <span class="text-muted">Đã xuất bản</span>
                                    </div>
                                    <div class="col-md-12 mb-3 d-flex ">
                                        <label class="form-label">Hoạt động:</label>
                                        <span class="text-muted mx-2">
                                            <div class="form-check form-switch form-switch-success">
                                                <input class="form-check-input switch-is-active channge-is-active-room"
                                                    type="checkbox" role="switch" data-id="{{ $seatTemplate->id }}"
                                                    @checked($seatTemplate->is_active)
                                                    onclick="return confirm('Bạn có chắc muốn thay đổi trạng thái hoạt động ?')">
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class='text-end'>
                                    <a href="{{ route('admin.rooms.index') }}" class='btn btn-light mx-1'>Quay
                                        lại</a>
                                    <button type="button" id="submitFormSeatDiagram" class='btn btn-primary mx-1'>Cập
                                        nhật</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card card-seat ">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Xuất bản</h4>
                            </div><!-- end card header -->
                            <div class="card-body ">
                                <form action="{{ route('admin.rooms.publish', $seatTemplate) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row ">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Trạng thái:</label>
                                            <span class="text-muted">Bản nháp</span>
                                        </div>
                                        <div class="col-md-12 mb-3 ">
                                            <label class="form-label">Hoạt động:</label>
                                            <span class="text-muted">Chưa hoạt động</span>
                                        </div>
                                    </div>
                                    <div class='text-end'>
                                        <a href="{{ route('admin.rooms.index') }}" class='btn btn-light mx-1'>Lưu
                                            nháp</a>
                                        <button type="submit" class='btn btn-primary mx-1'>Xuất bản</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-seat ">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Chú thích</h4>
                    </div><!-- end card header -->
                    <div class="card-body ">
                        <table class="table table-borderless   align-middle mb-0">
                            @if ($seatTemplate->is_publish == true)
                                <tbody>
                                    <tr>
                                        <td class="text-muted m-0 p-0" colspan='2'>
                                            **Khi thay đổi trạng thái ghế sẽ không ảnh hưởng đến suất chiếu trước đó.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ghế hỏng</td>
                                        <td class="text-center"> <img src="{{ asset('svg/seat-regular-broken.svg') }}"
                                                height="30px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ghế thường</td>
                                        <td class="text-center"> <img src="{{ asset('svg/seat-regular.svg') }}"
                                                height="30px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ghế vip</td>
                                        <td class="text-center"> <img src="{{ asset('svg/seat-vip.svg') }}"
                                                height="30px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ghế đôi</td>
                                        <td class="text-center"> <img src="{{ asset('svg/seat-double.svg') }}"
                                                height="30px">
                                        </td>
                                    </tr>

                                    <tr class="table-active">
                                        <th colspan='2' class="text-center">Tổng
                                            {{ $seatTemplate->seats->whereNull('deleted_at')->where('is_active', true)->count() }}
                                            /
                                            {{ $seats->whereNull('deleted_at')->count() }} chỗ ngồi</th>

                                    </tr>

                                </tbody>
                            @else
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

                                </tbody>
                            @endif

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/mainstyle.css') }}">
@endsection


@section('script-libs')
@endsection
