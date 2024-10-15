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
    <form id="seatForm" method="POST" action="{{ route('admin.seat-templates.update', $seatTemplate) }}">
        @csrf
        @method('PUT')
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
                            $regularRows = range(0, $seatTemplate->row_regular - 1); // Các hàng ghế thường

                            // $doubleRows =
                            //     $seatTemplate->row_double > 0
                            //         ? range($matrix['max_row'] - $seatTemplate->row_double, $matrix['max_row'] - 1)
                            //         : []; // Các hàng ghế đôi
                            $doubleRows = range($matrix['max_row'] - $seatTemplate->row_double, $matrix['max_row'] - 1) ;
                            $vipRows = range(
                                $seatTemplate->row_regular,
                                $matrix['max_row'] - $seatTemplate->row_double - 1,
                            ); // Các hàng ghế VIP
                        @endphp
                        @if (!$seatTemplate->is_publish)
                            <input type="hidden" name="seat_structure" id="seatStructure">
                            <input type="hidden" name="action" id="formAction">
                            <input type="hidden" name="row_regular" id="inputRowRegular"
                                value="{{ $seatTemplate->row_regular }}">
                            <input type="hidden" name="row_vip" id="inputRowVip" value="8">

                            <input type="hidden" name="row_double" id="inputRowDouble"
                                value="{{ $seatTemplate->row_double }}">

                            <table class="table-chart-chair table-none align-middle mx-auto text-center mb-5">
                                <tbody>
                                    @for ($row = 0; $row < $matrix['max_row']; $row++)
                                        @php
                                            $rowClass = '';
                                            $isAllRegular = $isAllVip = $isAllDouble = false;

                                            if (in_array($row, $regularRows)) {
                                                $rowClass = 'light-orange'; // Ghế thường
                                                $isAllRegular = true;
                                            } elseif (in_array($row, $doubleRows)) {
                                                $rowClass = 'light-pink'; // Ghế đôi
                                                $isAllDouble = true;
                                            } else {
                                                $rowClass = 'light-blue'; // Ghế VIP
                                                $isAllVip = true;
                                            }
                                        @endphp
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
                                                    <td class="box-item border-1 {{ $rowClass }}"
                                                        data-row="{{ chr(65 + $row) }}" data-col={{ $col + 1 }}
                                                        colspan="2">
                                                        <div class="box-item-seat" data-type-seat-id="3">
                                                            <!-- 3 cho ghế đôi -->
                                                            <img src="{{ asset('svg/seat-double.svg') }}" class='seat'
                                                                width="90%">
                                                        </div>
                                                    </td>
                                                    <td class="box-item border-1 {{ $rowClass }}" style="display: none;"
                                                        data-row="{{ chr(65 + $row) }}" data-col={{ $col + 2 }}
                                                        data-type-seat-id="3">
                                                        <div class="box-item-seat" data-type-seat-id="3">
                                                            <img src="{{ asset('svg/seat-add.svg') }}" class='seat'
                                                                width="60%">
                                                        </div>
                                                    </td>
                                                    @php $col++; @endphp
                                                @else
                                                    <td class="box-item border-1 {{ $rowClass }}"
                                                        data-row="{{ chr(65 + $row) }}" data-col={{ $col + 1 }}>
                                                        <div class="box-item-seat"
                                                            data-type-seat-id="{{ $seatType ?? (in_array($row, $regularRows) ? 1 : (in_array($row, $doubleRows) ? 3 : 2)) }}">
                                                            @switch($seatType)
                                                                @case(1)
                                                                    <img src="{{ asset('svg/seat-regular.svg') }}" class='seat'
                                                                        width="100%">
                                                                @break

                                                                @case(2)
                                                                    <img src="{{ asset('svg/seat-vip.svg') }}" class='seat'
                                                                        width="100%">
                                                                @break

                                                                @default
                                                                    <img src="{{ asset('svg/seat-add.svg') }}" class='seat'
                                                                        width="60%">
                                                            @endswitch
                                                        </div>
                                                    </td>
                                                @endif
                                            @endfor
                                            <td class='box-item border-1'>
                                                <span data-bs-toggle="offcanvas"
                                                    data-bs-target="#rowSeat{{ chr(65 + $row) }}">
                                                    <i class="fas fa-edit"></i>
                                                </span>

                                                <div class="offcanvas offcanvas-start" tabindex="-1"
                                                    id="rowSeat{{ chr(65 + $row) }}">
                                                    <div class="offcanvas-header border-bottom">
                                                        <h5 class="offcanvas-title">Chỉnh sửa hàng ghế {{ chr(65 + $row) }}
                                                        </h5>
                                                        <button type="button" class="btn-close text-reset"
                                                            data-bs-dismiss="offcanvas"></button>
                                                    </div>
                                                    <div class="offcanvas-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="typeSeatRow{{ chr(65 + $row) }}"
                                                                        value="1" @checked($isAllRegular)
                                                                        data-row="{{ chr(65 + $row) }}"
                                                                        data-action="regular">
                                                                    <label class="form-check-label">Ghế thường</label>
                                                                </div>
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="typeSeatRow{{ chr(65 + $row) }}"
                                                                        value="2" @checked($isAllVip)
                                                                        data-row="{{ chr(65 + $row) }}" data-action="vip">
                                                                    <label class="form-check-label">Ghế VIP</label>
                                                                </div>
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="typeSeatRow{{ chr(65 + $row) }}"
                                                                        value="3" data-row="{{ chr(65 + $row) }}"
                                                                        data-action="double" @checked($isAllDouble)>
                                                                    <label class="form-check-label">Ghế đôi</label>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-12 text-center">
                                                                <button type='button'
                                                                    class="btn btn-danger btn-remove-all mx-1"
                                                                    data-row="{{ chr(65 + $row) }}">
                                                                    <i class="mdi mdi-trash-can-outline me-1"></i>Bỏ tất cả
                                                                </button>
                                                                <button type='button'
                                                                    class="btn btn-info btn-restore-all mx-1"
                                                                    data-row="{{ chr(65 + $row) }}">
                                                                    <i class="ri-add-line align-bottom me-1"></i>Chọn tất
                                                                    cả
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
                        @else
                            <div class="srceen w-75 mx-auto mb-4">
                                Màn Hình Chiếu
                            </div>
                            <table class="table-chart-chair table-none align-middle mx-auto text-center mb-5">
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
                                                            <img src="{{ asset('svg/seat-double.svg') }}" class='seat'
                                                                width="100%">
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
                        @endif
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
                                                        type="checkbox" role="switch" name='is_active' value='1'
                                                        @checked($seatTemplate->is_active)>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class='text-end'>
                                        <a href="{{ route('admin.seat-templates.index') }}"
                                            class='btn btn-light mx-1'>Quay
                                            lại</a>
                                        <button type="submit" id="submitFormSeatDiagram"
                                            class='btn btn-primary mx-1'>Cập
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
                                        <button type='submit' name='action' value="draft"
                                            class='btn btn-light mx-1'>Lưu
                                            nháp</button>
                                        <button type="submit" name='action' value="publish"
                                            onclick="return confirm('Sau khi xuất bản không thể thay đổi vị trí ghế, bạn có chắc chắn ?')"
                                            class='btn btn-primary mx-1'>Xuất
                                            bản</button>
                                    </div>

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
                                                {{ $totalSeats }} chỗ ngồi</th>
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
    </form>
@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/mainstyle.css') }}">
@endsection


@section('script-libs')
    @if (!$seatTemplate->is_publish)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Lắng nghe sự kiện click trên ghế
                document.querySelectorAll('.box-item-seat').forEach(function(seat) {
                    seat.addEventListener('click', function() {
                        var img = this.querySelector('img');
                        var currentSrc = img.src;
                        var typeSeatId = this.dataset.typeSeatId;
                        var tdElement = this.closest('td');

                        if (currentSrc.includes('seat-add.svg')) {
                            if (typeSeatId == 3) {
                                var nextTd = tdElement.nextElementSibling;
                                if (nextTd && nextTd.querySelector('img').src.includes(
                                        'seat-add.svg')) {
                                    tdElement.colSpan = 2;
                                    nextTd.style.display = 'none';
                                    img.src = "{{ asset('svg/seat-double.svg') }}";
                                    img.style.width = "90%";
                                } else {
                                    alert('Bên phải không còn chỗ trống để đặt ghế đôi.');
                                }
                            } else {
                                if (typeSeatId == 1) {
                                    img.src = "{{ asset('svg/seat-regular.svg') }}";
                                } else if (typeSeatId == 2) {
                                    img.src = "{{ asset('svg/seat-vip.svg') }}";
                                }
                                img.style.width = "100%";
                            }
                        } else {
                            img.style.width = "60%";
                            img.src = "{{ asset('svg/seat-add.svg') }}";

                            if (typeSeatId == 3 && tdElement.colSpan == 2) {
                                var nextTd = tdElement.nextElementSibling;
                                tdElement.colSpan = 1;
                                nextTd.style.display = '';
                            }
                        }
                    });
                });

                // Lắng nghe sự kiện thay đổi radio button trong Offcanvas
                document.querySelectorAll('.form-check-input').forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        var row = this.dataset.row;
                        var typeSeatRowId = this.value;

                        // Xóa class hiện tại, cập nhật lại hình ảnh và dataset.type
                        var seats = document.querySelectorAll(`td[data-row="${row}"]`);
                        seats.forEach(function(seat) {
                            seat.classList.remove('light-orange', 'light-blue', 'light-pink');
                            var seatDiv = seat.querySelector('.box-item-seat');
                            seatDiv.dataset.typeSeatId = typeSeatRowId;

                            // Cập nhật hình ảnh ghế về trạng thái "add"
                            var img = seatDiv.querySelector('img');
                            img.src = "{{ asset('svg/seat-add.svg') }}";
                            img.style.width = "60%"; // Trả hình ảnh về trạng thái chưa chọn

                            // Kiểm tra nếu ghế là ghế đôi và có colSpan = 2, trả về colSpan = 1
                            var tdElement = seat.closest('td');
                            if (seatDiv.dataset.typeSeatIdSeatId == 3 && tdElement.colSpan ==
                                2) {
                                var nextTd = tdElement.nextElementSibling;
                                tdElement.colSpan = 1;
                                nextTd.style.display = '';
                            }

                            // Cập nhật màu sắc ghế dựa trên loại ghế được chọn
                            if (typeSeatRowId == 1) {
                                seat.classList.add('light-orange'); // Ghế thường
                            } else if (typeSeatRowId == 2) {
                                seat.classList.add('light-blue'); // Ghế VIP
                            } else if (typeSeatRowId == 3) {
                                seat.classList.add('light-pink'); // Ghế đôi
                            }

                            // Nếu chuyển từ ghế đôi về ghế thường hoặc VIP
                            if (typeSeatRowId == 1 || typeSeatRowId == 2) {
                                if (tdElement.colSpan == 2) {
                                    // Chuyển đổi colSpan về 1 nếu cần
                                    tdElement.colSpan = 1;
                                    var nextTd = tdElement.nextElementSibling;
                                    nextTd.style.display = '';
                                }
                            }
                        });
                    });
                });

                // Lắng nghe sự kiện click trên nút "Bỏ tất cả"
                document.querySelectorAll('.btn-remove-all').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var row = this.dataset.row;
                        var seats = document.querySelectorAll(`td[data-row="${row}"] .box-item-seat`);

                        seats.forEach(function(seatDiv) {
                            var img = seatDiv.querySelector('img');
                            img.src =
                                "{{ asset('svg/seat-add.svg') }}"; // Đặt lại hình ảnh ghế về trạng thái "add"
                            img.style.width = "60%"; // Đặt lại kích thước hình ảnh
                        });


                    });
                });

                // Lắng nghe sự kiện click trên nút "Chọn tất cả"
                document.querySelectorAll('.btn-restore-all').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var row = this.dataset.row;
                        var seats = document.querySelectorAll(`td[data-row="${row}"] .box-item-seat`);

                        seats.forEach(function(seatDiv) {
                            var img = seatDiv.querySelector('img');
                            var seatType = document.querySelector(
                                    `input[name="typeSeatRow${row}"]:checked`)
                                .value; // Lấy loại ghế đã chọn

                            // Cập nhật hình ảnh và loại ghế dựa trên loại ghế đã chọn
                            if (seatType == 1) { // Ghế thường
                                img.src = "{{ asset('svg/seat-regular.svg') }}";
                                img.style.width = "100%";
                                seatDiv.dataset.type = 'regular'; // Cập nhật loại ghế
                            } else if (seatType == 2) { // Ghế VIP
                                img.src = "{{ asset('svg/seat-vip.svg') }}";
                                img.style.width = "100%";
                                seatDiv.dataset.type = 'vip'; // Cập nhật loại ghế
                            } else if (seatType == 3) { // Ghế đôi
                                var tdElement = seatDiv.closest('td');
                                var nextTd = tdElement.nextElementSibling;

                                if (nextTd && nextTd.querySelector('img').src.includes(
                                        'seat-add.svg')) {
                                    tdElement.colSpan = 2; // Đặt colspan về 2
                                    nextTd.style.display = 'none'; // Ẩn cột bên cạnh
                                    img.src = "{{ asset('svg/seat-double.svg') }}";
                                    img.style.width = "90%";
                                    seatDiv.dataset.type = 'double'; // Cập nhật loại ghế
                                } else {
                                    alert('Bên phải không còn chỗ trống để đặt ghế đôi.');
                                }
                            }
                        });

                        // Cập nhật màu sắc cho các ô ghế
                        var rowCells = document.querySelectorAll(`td[data-row="${row}"]`);
                        rowCells.forEach(function(cell) {
                            var seatDiv = cell.querySelector('.box-item-seat');
                            var seatType = seatDiv.dataset.type;

                            // Cập nhật màu sắc ghế dựa trên loại ghế
                            if (seatType === 'regular') {
                                cell.classList.add('light-orange'); // Ghế thường
                            } else if (seatType === 'vip') {
                                cell.classList.add('light-blue'); // Ghế VIP
                            } else if (seatType === 'double') {
                                cell.classList.add('light-pink'); // Ghế đôi
                            }
                        });
                    });
                });
            });
        </script>
        {{-- Lấy dữ liệu khi gửi form --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Lắng nghe sự kiện click trên tất cả các button submit
                document.querySelectorAll('button[type="submit"]').forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        // Gán giá trị hành động tương ứng vào input ẩn
                        document.getElementById('formAction').value = this.dataset.action;
                    });
                });

                // Lắng nghe sự kiện submit của form
                document.querySelector('form#seatForm').addEventListener('submit', function(event) {
                    let seatStructure = [];

                    // Duyệt qua tất cả các ghế đã chọn
                    document.querySelectorAll('.box-item-seat').forEach(function(seatDiv) {
                        var img = seatDiv.querySelector('img');
                        if (!img.src.includes('seat-add.svg')) { // Bỏ qua ghế chưa chọn
                            let tdElement = seatDiv.closest('td');
                            let coordinates_x = tdElement.dataset.col; // Tọa độ x (cột)
                            let coordinates_y = tdElement.dataset.row; // Tọa độ y (hàng)
                            let type_seat_id = seatDiv.dataset.typeSeatId; // Loại ghế

                            // Thêm ghế vào mảng
                            seatStructure.push({
                                coordinates_x: coordinates_x,
                                coordinates_y: coordinates_y,
                                type_seat_id: type_seat_id,
                            });
                        }
                    });

                    // Chuyển seatStructure thành JSON và gán vào input hidden
                    document.querySelector('#seatStructure').value = JSON.stringify(seatStructure);
                });
            });
        </script>
    @endif
@endsection
