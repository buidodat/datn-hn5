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

                        <form id="seatForm" method="POST" action="{{ route('admin.seat-templates.update', $seatTemplate) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="seats" id="seatsData">
                            <table class="table-chart-chair table-none align-middle mx-auto text-center mb-5">
                                <tbody>
                                    @for ($row = 0; $row < $matrix['max_row']; $row++)
                                        @php
                                            $rowChar = chr(65 + $row);
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
                                            <td class="box-item">{{ $rowChar }}</td>
                                            @for ($col = 0; $col < $matrix['max_col']; $col++)
                                                @php
                                                    // Lấy thông tin ghế từ seatMap
                                                    $seatType = isset($seatMap[$rowChar][$col + 1]) ? $seatMap[$rowChar][$col + 1] : null;
                                                @endphp
                                                <td class="box-item border-1 {{ $rowClass }}" data-row="{{ $rowChar }}">
                                                    <div class="box-item-seat"
                                                        data-type="{{ $seatType ? ($seatType == 3 ? 'double' : ($seatType == 2 ? 'vip' : 'regular')) : 'add' }}">
                                                        @if ($seatType)
                                                            <img src="{{ $seatType == 3 ? asset('svg/seat-double.svg') : ($seatType == 2 ? asset('svg/seat-vip.svg') : asset('svg/seat-regular.svg')) }}"
                                                                class='seat' width="{{ $seatType == 3 ? '90%' : '100%' }}">
                                                        @else
                                                            <img src="{{ asset('svg/seat-add.svg') }}" class='seat' width="60%">
                                                        @endif
                                                    </div>
                                                </td>
                                            @endfor
                                            <td class='box-item border-1'>
                                                <span data-bs-toggle="offcanvas" data-bs-target="#rowSeat{{ $rowChar }}">
                                                    <i class="fas fa-edit"></i>
                                                </span>

                                                <div class="offcanvas offcanvas-start" tabindex="-1" id="rowSeat{{ $rowChar }}">
                                                    <div class="offcanvas-header border-bottom">
                                                        <h5 class="offcanvas-title">Chỉnh sửa hàng ghế {{ $rowChar }}</h5>
                                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                                                    </div>
                                                    <div class="offcanvas-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="typeSeatRow{{ $rowChar }}" value="1" @checked($isAllRegular) data-row="{{ $rowChar }}">
                                                                    <label class="form-check-label">Ghế thường</label>
                                                                </div>
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="typeSeatRow{{ $rowChar }}" value="2" @checked($isAllVip) data-row="{{ $rowChar }}">
                                                                    <label class="form-check-label">Ghế VIP</label>
                                                                </div>
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="typeSeatRow{{ $rowChar }}" value="3" @checked($isAllDouble) data-row="{{ $rowChar }}">
                                                                    <label class="form-check-label">Ghế đôi</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 text-center">
                                                                <button class="btn btn-danger btn-remove-all mx-1" data-row="{{ $rowChar }}">
                                                                    <i class="mdi mdi-trash-can-outline me-1"></i>Bỏ tất cả
                                                                </button>
                                                                <button class="btn btn-info btn-restore-all mx-1" data-row="{{ $rowChar }}">
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
                            <button type="submit" class='btn btn-info'>Lưu Ghế</button>
                        </form>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                let seatsData = [];

                                // Lấy dữ liệu ghế cũ từ seatMap (mỗi ghế sẽ có thuộc tính là type_seat_id)
                                @foreach ($seatMap as $rowChar => $cols)
                                    @foreach ($cols as $colIndex => $seatType)
                                        @if ($seatType !== null)
                                            seatsData.push({
                                                coordinates_x: {{ $colIndex }},
                                                coordinates_y: '{{ $rowChar }}',
                                                type_seat_id: {{ $seatType }}
                                            });
                                        @endif
                                    @endforeach
                                @endforeach

                                // Cập nhật giá trị của trường ẩn
                                document.getElementById('seatsData').value = JSON.stringify(seatsData);

                                // Lắng nghe sự kiện click trên ghế
                                document.querySelectorAll('.box-item-seat').forEach(function(seat) {
                                    seat.addEventListener('click', function() {
                                        const img = this.querySelector('img');
                                        const currentSrc = img.src;
                                        const seatType = this.dataset.type;
                                        const tdElement = this.closest('td');
                                        const rowIndex = tdElement.parentElement.rowIndex; // Lấy chỉ số hàng
                                        const colIndex = tdElement.cellIndex; // Lấy chỉ số cột
                                        const rowChar = String.fromCharCode(65 + rowIndex); // Chuyển chỉ số hàng thành chữ cái

                                        let typeSeatId;
                                        if (seatType === 'double') {
                                            typeSeatId = 3; // Đôi
                                        } else if (seatType === 'vip') {
                                            typeSeatId = 2; // VIP
                                        } else {
                                            typeSeatId = 1; // Thường
                                        }

                                        if (currentSrc.includes('seat-add.svg')) {
                                            if (seatType === 'double') {
                                                const nextTd = tdElement.nextElementSibling;
                                                if (nextTd && nextTd.querySelector('img').src.includes('seat-add.svg')) {
                                                    tdElement.colSpan = 2;
                                                    nextTd.style.display = 'none';
                                                    img.src = "{{ asset('svg/seat-double.svg') }}";
                                                    img.style.width = "90%";
                                                    // Cập nhật hoặc thêm ghế mới
                                                    seatsData.push({
                                                        coordinates_x: colIndex , // Cộng 1 vì cột bắt đầu từ 0
                                                        coordinates_y: rowChar,
                                                        type_seat_id: typeSeatId
                                                    });
                                                } else {
                                                    alert('Bên phải không còn chỗ trống để đặt ghế đôi.');
                                                }
                                            } else {
                                                img.src = seatType === 'regular' ?
                                                    "{{ asset('svg/seat-regular.svg') }}" :
                                                    "{{ asset('svg/seat-vip.svg') }}";
                                                img.style.width = "100%";
                                                // Cập nhật hoặc thêm ghế mới
                                                seatsData.push({
                                                    coordinates_x: colIndex , // Cộng 1 vì cột bắt đầu từ 0
                                                    coordinates_y: rowChar,
                                                    type_seat_id: typeSeatId
                                                });
                                            }
                                        } else {
                                            img.src = "{{ asset('svg/seat-add.svg') }}";
                                            img.style.width = "60%";
                                            // Xóa ghế khỏi dữ liệu
                                            seatsData = seatsData.filter(seat => !(seat.coordinates_x === colIndex  && seat.coordinates_y === rowChar));
                                            if (seatType === 'double') {
                                                const nextTd = tdElement.nextElementSibling;
                                                if (nextTd) {
                                                    nextTd.style.display = '';
                                                    tdElement.colSpan = 1;
                                                }
                                            }
                                        }

                                        // Cập nhật dữ liệu ghế ẩn
                                        document.getElementById('seatsData').value = JSON.stringify(seatsData);
                                    });
                                });

                                // Xử lý sự kiện click cho nút "Bỏ tất cả"
                                document.querySelectorAll('.btn-remove-all').forEach(function(button) {
                                    button.addEventListener('click', function(event) {
                                        event.preventDefault();
                                        const rowChar = this.dataset.row;
                                        const tdElements = document.querySelectorAll(`td[data-row="${rowChar}"]`);
                                        tdElements.forEach(td => {
                                            const img = td.querySelector('img');
                                            img.src = "{{ asset('svg/seat-add.svg') }}";
                                            img.style.width = "60%";
                                            if (!img.src.includes('seat-add.svg')) {
                                                // Xóa tất cả ghế của hàng này khỏi dữ liệu
                                                seatsData = seatsData.filter(seat => seat.coordinates_y !== rowChar);
                                            }
                                        });
                                        document.getElementById('seatsData').value = JSON.stringify(seatsData); // Cập nhật dữ liệu ghế ẩn
                                    });
                                });

                                // Xử lý sự kiện click cho nút "Chọn tất cả"
                                document.querySelectorAll('.btn-restore-all').forEach(function(button) {
                                    button.addEventListener('click', function(event) {
                                        event.preventDefault();
                                        const rowChar = this.dataset.row;
                                        const tdElements = document.querySelectorAll(`td[data-row="${rowChar}"]`);
                                        tdElements.forEach(td => {
                                            const img = td.querySelector('img');
                                            if (img.src.includes('seat-add.svg')) {
                                                img.src = "{{ asset('svg/seat-regular.svg') }}";
                                                img.style.width = "100%";
                                                seatsData.push({
                                                    coordinates_x: td.cellIndex , // Cộng 1 vì cột bắt đầu từ 0
                                                    coordinates_y: rowChar,
                                                    type_seat_id: 1
                                                }); // Cập nhật dữ liệu ghế
                                            }
                                        });
                                        document.getElementById('seatsData').value = JSON.stringify(seatsData); // Cập nhật dữ liệu ghế ẩn
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
