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
            <div class="card card-left">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Sơ đồ ghế</h4>
                </div><!-- end card header -->
                <div class="card-body mb-3">
                    @php
                        $rowSeatRegular = $room->row_seat_regular ;
                        $rowStartSeatDouble = $matrixSeat['max_col']-$room->row_seatDouble;
                    @endphp
                    <table class="table-chart-chair table-none align-middle mx-auto text-center mb-5">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            @for ($row = 0; $row < $matrixSeat['max_row']; $row++)
                                <tr>
                                    {{-- cột hàng ghế A,B,C --}}
                                    <td class="box-item">
                                        {{ chr(65 + $row) }}
                                    </td>
                                    @for ($col = 0; $col < $matrixSeat['max_col']; $col++)
                                        @foreach ($seats as $seat)
                                            @if ($seat->coordinates_x === $col + 1 && $seat->coordinates_y === chr(65 + $row))
                                                <td
                                                    class="box-item border-1 {{ $seat->type_seat_id == 1 ? 'light-orange' : 'light-blue' }}">
                                                    <div class="box-item-seat" data-seat-id="{{ $seat->id }}"
                                                        data-seat-row="{{ chr(65 + $row) }}"
                                                        data-seat-type-id="{{ $seat->type_seat_id }}">
                                                        @if ($seat->trashed())
                                                            <img src="{{ asset('svg/seat-add.svg') }}" class='seat'
                                                                width="60%">
                                                        @else
                                                            @if ($seat->type_seat_id == 1)
                                                                <img src="{{ asset('svg/seat-regular.svg') }}"
                                                                    class='seat' width="100%">
                                                            @else
                                                                <img src="{{ asset('svg/seat-vip.svg') }}" class='seat'
                                                                    width="100%">
                                                            @endif
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                        @endforeach
                                    @endfor
                                    <td class='box-item border-1'>
                                        <span data-bs-toggle="offcanvas" data-bs-target="#rowSeat{{ chr(65 + $row) }}">
                                            <i class="fas fa-edit "></i>
                                        </span>

                                        <div class="offcanvas offcanvas-start" tabindex="-1"
                                            id="rowSeat{{ chr(65 + $row) }}">
                                            <div class="offcanvas-header border-bottom">
                                                <h5 class="offcanvas-title">Chỉnh sửa hàng ghế {{ chr(65 + $row) }}</h5>
                                                <button type="button"
                                                    class="btn-close text-reset"data-bs-dismiss="offcanvas"></button>
                                            </div>
                                            <div class="offcanvas-body">
                                                <div class="row">
                                                    <!-- Custom Radio Color -->
                                                    <div class="col-md-12 mb-3">
                                                        {{-- @foreach ($typeSeats as $id => $name)
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" type="radio" name="typeSeatRow{{ chr(65 + $row) }}"
                                                                    value="{{ $id }}"
                                                                    {{ ($row < 4 && $id == 1) ? 'checked' : ($row >= 4 && $id == 2 ? 'checked' : '') }}>
                                                                <label class="form-check-label">{{ $name }}</label>
                                                            </div>
                                                        @endforeach --}}
                                                        @if ($row < $rowSeatRegular + 1) {{--hiển thị input ghế thường ở 1 hàng ghế kế tiếp--}}
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" type="radio"
                                                                    name="typeSeatRow{{ chr(65 + $row) }}" value="1"
                                                                    @checked($row < $rowSeatRegular)
                                                                    data-row="{{ chr(65 + $row) }}" @disabled($row < $rowSeatRegular -1)>
                                                                <label class="form-check-label">Ghế thường</label>
                                                            </div>
                                                        @endif
                                                        @if ($row >= $rowSeatRegular -1)
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" type="radio"
                                                                    name="typeSeatRow{{ chr(65 + $row) }}" value="2"
                                                                    @checked($row >= $rowSeatRegular && $row <= $rowStartSeatDouble)
                                                                    data-row="{{ chr(65 + $row) }}" @disabled($row >= $rowSeatRegular+1)>
                                                                <label class="form-check-label">Ghế vip</label>
                                                            </div>
                                                        @endif

                                                        {{-- <div class="form-check form-radio-primary mb-3">
                                                            <input class="form-check-input" type="radio" name="typeSeatRow{{ chr(65 + $row) }}" value="3">
                                                            <label class="form-check-label">Ghế đôi</label>
                                                        </div> --}}
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <button class="btn btn-danger btn-remove-all mx-1"
                                                            data-row="{{ chr(65 + $row) }}"><i
                                                                class="mdi mdi-trash-can-outline me-1"></i>Bỏ tất
                                                            cả</button>
                                                        <button class="btn btn-info btn-restore-all mx-1"
                                                            data-row="{{ chr(65 + $row) }}"><i
                                                                class="ri-add-line align-bottom me-1"></i>Chọn tất
                                                            cả</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.rooms.update',$room) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="card card-seat ">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Xuất bản</h4>
                            </div><!-- end card header -->
                            <div class="card-body ">
                                <div class="row ">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Trạng thái:</label>
                                        <span class="text-muted">{{ $room->is_publish == true  ? 'Đã xuất bản' : 'Bản nháp' }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3 ">
                                        <label class="form-label">Hoạt động:</label>
                                        <span class="text-muted">{{ $room->is_active == true  ? 'Đang hoạt động' : 'Chưa hoạt động' }}</span>
                                    </div>
                                </div>
                                <div class='text-end'>
                                    <a href="{{ route('admin.rooms.index') }}" class='btn btn-light mx-1'>Lưu nháp</a>
                                    <button type="submit" class='btn btn-primary mx-1'>Xuất bản</button>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-md-12">
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
                               
                            </tbody>
                        </table>

                    </div>
                    {{-- <div class="card-body ">
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
                                    <td class="text-center"> <img src="{{ asset('svg/seat-double.svg') }}" height="30px">
                                    </td>
                                <tr class="table-active">
                                    <th colspan='2' class="text-center">Tổng {{ $seats->count() }} chỗ ngồi</th>

                                </tr>
                            </tbody>
                        </table>

                    </div> --}}
                </div>
            </div>

        </div>
    </div>
@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/mainstyle.css') }}">
@endsection


@section('script-libs')
    {{-- xóa mềm và khôi phục trên 1 ghế --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.box-item-seat').forEach(function(seatElement) {
                seatElement.addEventListener('click', function() {
                    const seatId = seatElement.getAttribute('data-seat-id');
                    const seatType = seatElement.getAttribute('data-seat-type-id');
                    const seatImg = seatElement.querySelector('img.seat');

                    // Kiểm tra xem ghế đang ở trạng thái xóa mềm hay không
                    if (seatImg.src.includes('seat-add.svg')) {
                        // Gửi yêu cầu khôi phục ghế
                        fetch('{{ route('seats.restore') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    seat_id: seatId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Khôi phục ghế (cập nhật lại hình ảnh)
                                    if (seatType == 1) {
                                        seatImg.src = "{{ asset('svg/seat-regular.svg') }}";
                                    } else {
                                        seatImg.src = "{{ asset('svg/seat-vip.svg') }}";
                                    }
                                    seatImg.style.width = "100%";
                                } else {
                                    alert('Thao tác quá nhanh.');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    } else {
                        // Gửi yêu cầu xóa mềm ghế
                        fetch('{{ route('seats.soft-delete') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    seat_id: seatId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Xóa mềm ghế (hiển thị hình ảnh xóa mềm)
                                    seatImg.src = "{{ asset('svg/seat-add.svg') }}";
                                    seatImg.style.width = "60%";
                                } else {
                                    alert('Thao tác quá nhanh.');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>

    {{-- xóa mềm và khôi phục trên 1 hàng ghế --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý khi nhấn "Bỏ tất cả"
            document.querySelectorAll('.btn-remove-all').forEach(function(button) {
                button.addEventListener('click', function() {
                    const row = button.getAttribute('data-row');

                    fetch('{{ route('seats.soft-delete-row') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                row: row
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Tìm tất cả ghế trong hàng và thay đổi trạng thái
                                document.querySelectorAll(`[data-seat-row='${row}'] img.seat`)
                                    .forEach(function(seatImg) {
                                        seatImg.src = "{{ asset('svg/seat-add.svg') }}";
                                        seatImg.style.width = "60%";
                                    });
                            } else {
                                alert('Lỗi: ' + data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            // Xử lý khi nhấn "Chọn tất cả"
            document.querySelectorAll('.btn-restore-all').forEach(function(button) {
                button.addEventListener('click', function() {
                    const row = button.getAttribute('data-row');

                    fetch('{{ route('seats.restore-row') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                row: row
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Tìm tất cả ghế trong hàng và khôi phục trạng thái
                                document.querySelectorAll(`[data-seat-row='${row}'] img.seat`)
                                    .forEach(function(seatImg) {
                                        const seatType = seatImg.closest('.box-item-seat')
                                            .getAttribute('data-seat-type-id');
                                        if (seatType == 1) {
                                            seatImg.src =
                                                "{{ asset('svg/seat-regular.svg') }}";
                                        } else {
                                            seatImg.src =
                                                "{{ asset('svg/seat-vip.svg') }}";
                                        }
                                        seatImg.style.width = "100%";
                                    });
                            } else {
                                alert('Lỗi: ' + data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
    {{-- thay đổi loại ghế trên 1 hàng ghế --}}
    <script>
        document.querySelectorAll('input[name^="typeSeatRow"]').forEach(function(radio) {
            radio.addEventListener('click', function() {
                const selectedRow = this.getAttribute('data-row'); // Lấy hàng ghế (A, B, C...)
                const roomId = {{ $room->id }}; // ID của phòng chiếu
                const typeSeatId = this.value; // Lấy giá trị loại ghế (1: Ghế thường, 2: Ghế VIP)

                // Gửi yêu cầu AJAX để cập nhật loại ghế trong database
                fetch("{{ route('seats.update-type') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            row: selectedRow,
                            type_seat_id: typeSeatId,
                            room_id: roomId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cập nhật giao diện ghế sau khi nhận được phản hồi thành công từ server
                            const seatsInRow = document.querySelectorAll(
                                `.box-item-seat[data-seat-row="${selectedRow}"]`);
                            seatsInRow.forEach(function(seat) {
                                seat.setAttribute('data-seat-type-id', typeSeatId);

                                // Cập nhật hình ảnh và màu sắc ghế
                                const seatImage = seat.querySelector('img.seat');
                                seatImage.style.width = '100%'
                                if (typeSeatId == 2) {
                                    seatImage.src = "{{ asset('svg/seat-vip.svg') }}";
                                    seat.closest('td').classList.remove('light-orange');
                                    seat.closest('td').classList.add('light-blue');
                                } else {
                                    seatImage.src = "{{ asset('svg/seat-regular.svg') }}";
                                    seat.closest('td').classList.remove('light-blue');
                                    seat.closest('td').classList.add('light-orange');
                                }
                            });
                        } else {
                            alert('Cập nhật thất bại');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
