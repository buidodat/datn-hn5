@extends('admin.layouts.master')

@section('title')
    Danh sách phòng chiếu
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection



@section('content')
    <!-- start page title -->
    <!-- Button to trigger modal -->


    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý phòng chiếu</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Phòng chiếu</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header border-0">
                    <div class="row align-items-center gy-3">
                        <div class="col-sm">
                            <h5 class="card-title mb-0">Danh sách phòng chiếu</h5>
                        </div>
                        <div class="col-sm-auto">
                            <div class="d-flex gap-1 flex-wrap">
                                <button class="btn btn-primary mb-3 " data-bs-toggle="modal"
                                    data-bs-target="#createRoomModal">Thêm
                                    mới</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- giao diện bộ lọc, bộ tìm kiếm  --}}
                {{-- <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-6">
                                <div class="search-box">
                                    <input type="text" class="form-control search"
                                        placeholder="Search for order ID, customer, order status or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-6">
                                <div>
                                    <input type="text" class="form-control" data-provider="flatpickr"
                                        data-date-format="d M, Y" data-range-date="true" id="demo-datepicker"
                                        placeholder="Select date">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control" data-choices="" data-choices-search-false=""
                                        name="choices-single-default" id="idStatus">
                                        <option value="">Status</option>
                                        <option value="all" selected="">All</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Inprogress">Inprogress</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Pickups">Pickups</option>
                                        <option value="Returns">Returns</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control" data-choices="" data-choices-search-false=""
                                        name="choices-single-default" id="idPayment">
                                        <option value="">Select Payment</option>
                                        <option value="all" selected="">All</option>
                                        <option value="Mastercard">Mastercard</option>
                                        <option value="Paypal">Paypal</option>
                                        <option value="Visa">Visa</option>
                                        <option value="COD">COD</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <button type="button" class="btn btn-info w-100" onclick="SearchData();"> <i
                                            class="ri-equalizer-fill me-1 align-bottom"></i>
                                        Lọc
                                    </button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div> --}}

                <div class="card-body pt-0">

                    <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link  All py-3" data-bs-toggle="tab" href="#allRoom" role="tab"
                                aria-selected="true">
                                Tất cả
                                <span class="badge bg-dark align-middle ms-1">{{ $rooms->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-3 active isPublish" data-bs-toggle="tab" href="#isPublish" role="tab"
                                aria-selected="false">
                                Đã xuất bản
                                <span class="badge bg-success align-middle ms-1">{{ $roomPublishs->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-3 isDraft" data-bs-toggle="tab" href="#isDraft" role="tab"
                                aria-selected="false">
                                Bản nháp<span class="badge bg-warning align-middle ms-1">{{ $roomDrafts->count() }}</span>
                            </a>
                        </li>
                        @foreach ($cinemas as $cinema)
                            <li class="nav-item">
                                <a class="nav-link py-3 isDraft" data-bs-toggle="tab" href="#cinemaID{{ $cinema->id }}"
                                    role="tab" aria-selected="false">
                                    {{ $cinema->name }}
                                    {{-- <span class="badge bg-warning align-middle ms-1">{{ $cinema->rooms->count() }}</span> --}}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                    <div class="card-body tab-content ">
                        <div class="tab-pane " id="allRoom" role="tabpanel">
                            <table class="table table-bordered dt-responsive nowrap align-middle w-100" id="tableAllRoom">
                                <thead class='table-light'>
                                    <tr>
                                        <th>#</th>
                                        <th>Phòng chiếu</th>
                                        <th>Rạp chiếu</th>
                                        <th>Loại Phòng</th>
                                        <th>Sức chứa</th>
                                        <th>Trạng thái</th>
                                        <th>Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $index => $room)
                                        <tr>
                                            <td>{{ $room->id }}</td>
                                            <td>
                                                <div class='room-name'>
                                                   <div class='mb-1 fs-6'> {{ $room->name }}</div>
                                                    <div>
                                                        <a class=" link-opacity-75-hover link-opacity-50 " href="{{ route('admin.rooms.show',$room) }}">Chi tiết</a>
                                                         <a class="cursor-pointer link-opacity-75-hover link-opacity-50 mx-1">Chỉnh sửa</a>
                                                        <a class=" link-opacity-75-hover link-opacity-50 " href="{{ route('admin.rooms.seat-diagram',$room) }}">Sơ đồ ghế</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $room->cinema->name }}</td>
                                            <td>{{ $room->typeRoom->name }}</td>
                                            <td>{{ $room->seats->whereNull('deleted_at')->where('is_active',true)->count() }} / {{ $room->seats->whereNull('deleted_at')->count() }} chỗ ngồi</td>
                                            <td>
                                                {!! $room->is_publish == 1
                                                    ? '<span class="badge bg-success-subtle text-success">Đã xuất bản</span>'
                                                    : '<span class="badge bg-danger-subtle text-danger">Bản nháp</span>' !!}
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input switch-is-active" name="is_active"
                                                        type="checkbox" role="switch" data-id="{{ $room->id }}"
                                                        @checked($room->is_active)
                                                        onclick="return confirm('Bạn có chắc muốn thay đổi ?')" @disabled(!$room->is_publish)>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>


                        <div class="tab-pane active " id="isPublish" role="tabpanel">
                            <table class="table table-bordered dt-responsive nowrap align-middle w-100"
                                id="tableIsPublish">
                                <thead class='table-light'>
                                    <tr>
                                        <th>#</th>
                                        <th>Phòng chiếu</th>
                                        <th>Rạp chiếu</th>
                                        <th>Loại Phòng</th>
                                        <th>Sức chứa</th>
                                        <th>Trạng thái</th>
                                        <th>Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roomPublishs as $index => $room)
                                        <tr>
                                            <td>{{ $room->id }}</td>
                                            <td>
                                                <div class='room-name'>
                                                   <div class='mb-1 fs-6'> {{ $room->name }}</div>
                                                    <div>
                                                        <a class=" link-opacity-75-hover link-opacity-50 " href="{{ route('admin.rooms.show',$room) }}">Chi tiết</a>
                                                         <a class="cursor-pointer link-opacity-75-hover link-opacity-50 mx-1">Chỉnh sửa</a>
                                                        <a class=" link-opacity-75-hover link-opacity-50 " href="{{ route('admin.rooms.seat-diagram',$room) }}">Sơ đồ ghế</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $room->cinema->name }}</td>
                                            <td>{{ $room->typeRoom->name }}</td>
                                            <td>{{ $room->seats->whereNull('deleted_at')->where('is_active',true)->count() }} / {{ $room->seats->whereNull('deleted_at')->count() }} chỗ ngồi</td>
                                            <td>
                                                {!! $room->is_publish == 1
                                                    ? '<span class="badge bg-success-subtle text-success">Đã xuất bản</span>'
                                                    : '<span class="badge bg-danger-subtle text-danger">Bản nháp</span>' !!}
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input switch-is-active" name="is_active"
                                                        type="checkbox" role="switch" data-id="{{ $room->id }}"
                                                        @checked($room->is_active)
                                                        onclick="return confirm('Bạn có chắc muốn thay đổi ?')" >
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="isDraft" role="tabpanel">

                            <table class="table table-bordered dt-responsive nowrap align-middle w-100" id="tableIsDraft">
                                <thead class='table-light'>
                                    <tr>
                                        <th>#</th>
                                        <th>Phòng chiếu</th>
                                        <th>Rạp chiếu</th>
                                        <th>Loại Phòng</th>
                                        <th>Sức chứa</th>
                                        <th>Trạng thái</th>
                                        <th>Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roomDrafts as $index => $room)
                                        <tr>
                                            <td>{{ $room->id }}</td>
                                            <td>
                                                <div class='room-name'>
                                                   <div class='mb-1 fs-6'> {{ $room->name }}</div>
                                                    <div>
                                                        <a class=" link-opacity-75-hover link-opacity-50 " href="{{ route('admin.rooms.show',$room) }}">Chi tiết</a>
                                                         <a class="cursor-pointer link-opacity-75-hover link-opacity-50 mx-1">Chỉnh sửa</a>
                                                        <a class=" link-opacity-75-hover link-opacity-50 " href="{{ route('admin.rooms.seat-diagram',$room) }}">Sơ đồ ghế</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $room->cinema->name }}</td>
                                            <td>{{ $room->typeRoom->name }}</td>
                                            <td>{{ $room->seats->whereNull('deleted_at')->where('is_active',true)->count() }} / {{ $room->seats->whereNull('deleted_at')->count() }} chỗ ngồi</td>
                                            <td>
                                                {!! $room->is_publish == 1
                                                    ? '<span class="badge bg-success-subtle text-success">Đã xuất bản</span>'
                                                    : '<span class="badge bg-danger-subtle text-danger">Bản nháp</span>' !!}
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input switch-is-active" name="is_active"
                                                        type="checkbox" role="switch"
                                                        @checked($room->is_active)
                                                        disabled>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        @foreach ($cinemas as $cinema)
                            <div class="tab-pane " id="cinemaID{{ $cinema->id }}" role="tabpanel">
                                <table class="table table-bordered dt-responsive nowrap align-middle w-100"
                                    id="tableCinemaID{{ $cinema->id }}">
                                    <thead class='table-light'>
                                        <tr>
                                            <th>#</th>
                                            <th>Phòng chiếu</th>
                                            <th>Rạp chiếu</th>
                                            <th>Loại Phòng</th>
                                            <th>Sức chứa</th>
                                            <th>Trạng thái</th>
                                            <th>Hoạt động</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cinema->rooms as $index => $room)
                                            <tr>
                                                <td>{{ $room->id }}</td>
                                                <td>
                                                <div class='room-name'>
                                                   <div class='mb-1 fs-6'> {{ $room->name }}</div>
                                                    <div>
                                                        <a class=" link-opacity-75-hover link-opacity-50 " href="{{ route('admin.rooms.show',$room) }}">Chi tiết</a>
                                                         <a class="cursor-pointer link-opacity-75-hover link-opacity-50 mx-1">Chỉnh sửa</a>
                                                        <a class=" link-opacity-75-hover link-opacity-50 " href="{{ route('admin.rooms.seat-diagram',$room) }}">Sơ đồ ghế</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $room->cinema->name }}</td>
                                                <td>{{ $room->typeRoom->name }}</td>
                                                <td>{{ $room->seats->whereNull('deleted_at')->where('is_active',true)->count() }} / {{ $room->seats->whereNull('deleted_at')->count() }} chỗ ngồi</td>
                                                <td>
                                                    {!! $room->is_publish == 1
                                                        ? '<span class="badge bg-success-subtle text-success">Đã xuất bản</span>'
                                                        : '<span class="badge bg-danger-subtle text-danger">Bản nháp</span>' !!}
                                                </td>
                                                <td>
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input switch-is-active" name="is_active"
                                                        type="checkbox" role="switch" data-id="{{ $room->id }}"
                                                        @checked($room->is_active)
                                                        onclick="return confirm('Bạn có chắc muốn thay đổi ?')" @disabled(!$room->is_publish)>
                                                </div>
                                            </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>


                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Modal thêm mới phòng chiếu-->
    <div class="modal fade" id="createRoomModal" tabindex="-1" aria-labelledby="createRoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoomModalLabel">Thêm Phòng Chiếu Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createRoomForm">
                        @csrf
                        <div class="row">
                            <!-- Tên phòng chiếu -->
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label"><span class="text-danger">*</span> Tên
                                    Phòng</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    placeholder="Poly 202">
                                <span class="text-danger mt-3" id="nameError"></span> <!-- Thêm thông báo lỗi -->
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="branchId" class="form-label"><span class="text-danger">*</span> Chi
                                    Nhánh</label>
                                <select class="form-select" id="branchId" name="branch_id" onchange="loadCinemas()"
                                    required>
                                    <option value="" disabled selected>Chọn chi nhánh</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger mt-3" id="branchError"></span> <!-- Thêm thông báo lỗi -->
                            </div>

                            <!-- Chọn Rạp Chiếu -->
                            <div class="col-md-7 mb-3">
                                <label for="cinemaId" class="form-label"><span class="text-danger">*</span> Rạp
                                    Chiếu</label>
                                <select class="form-select" id="cinemaId" name="cinema_id" required>
                                    <option value="" disabled selected>Chọn rạp chiếu</option>
                                </select>
                                <span class="text-danger mt-3" id="cinemaError"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="type_room_id" class="form-label"><span class="text-danger">*</span> Loại
                                    phòng chiếu</label>
                                <select class="form-select" id="type_room_id" name="type_room_id" required>
                                    @foreach ($typeRooms as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger mt-3" id="typeRoomError"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="matrix_id" class="form-label"><span class="text-danger">*</span> Ma trận
                                    ghế</label>
                                <select class="form-select" id="matrix_id" name="matrix_id" required>
                                    @foreach (App\Models\Room::MATRIXS as $matrix)
                                        <option value="{{ $matrix['id'] }}">{{ $matrix['name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger mt-3" id="matrixSeatError"></span>
                            </div>
                            <!-- Chọn Chi Nhánh -->

                            <input type="hidden" name="capacity" value='5'> <!-- Giá trị cố định cho capacity -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="saveRoomBtn">Thêm mới</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script-libs')
    <script>
        // Hàm load các rạp chiếu khi chọn chi nhánh
        function loadCinemas() {
            const branchId = document.getElementById('branchId').value;
            const cinemaSelect = document.getElementById('cinemaId');
            cinemaSelect.innerHTML = '<option value="" disabled selected>Chọn rạp chiếu</option>'; // Reset options
            if (branchId) {
                const url = APP_URL + `/api/cinemas/${branchId}`
                fetch(url)
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

        document.getElementById('saveRoomBtn').addEventListener('click', function(event) {
            const form = document.getElementById('createRoomForm');
            const formData = new FormData(form);
            let hasErrors = false; // Biến để theo dõi có lỗi hay không
            const url = APP_URL + `/api/rooms`
            fetch(url, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        // Nếu có lỗi (400, 422, 500, ...), chuyển đến phần xử lý lỗi
                        return response.json().then(errorData => {
                            handleErrors(errorData.error); // Gọi hàm xử lý lỗi
                            hasErrors = true; // Đánh dấu có lỗi
                        });
                    }
                    return response.json(); // Chuyển đổi phản hồi thành JSON
                })
                .then(data => {
                    if (!hasErrors) { // Chỉ đóng modal và reset form khi không có lỗi
                        console.log(data);
                        $('#createRoomModal').modal('hide');
                        form.reset();
                        window.location.href =
                            `${APP_URL}/admin/rooms/seat-diagram/${data.room.id}`; // Sử dụng room.id vừa thêm
                    }
                })
                .catch(error => console.error('Error adding room:', error));
        });

        // Hàm để hiển thị lỗi xác thực
        function handleErrors(errors) {
            // Reset thông báo lỗi trước đó
            document.getElementById('nameError').innerText = '';
            document.getElementById('branchError').innerText = '';
            document.getElementById('cinemaError').innerText = '';
            document.getElementById('matrixSeatError').innerText = '';
            document.getElementById('typeRoomError').innerText = '';
            // Kiểm tra và hiển thị lỗi cho từng trường
            if (errors.name) {
                document.getElementById('nameError').innerText = errors.name.join(', ');
            }
            if (errors.branch_id) {
                document.getElementById('branchError').innerText = errors.branch_id.join(', ');
            }
            if (errors.cinema_id) {
                document.getElementById('cinemaError').innerText = errors.cinema_id.join(', ');
            }
            if (errors.matrix_id) {
                document.getElementById('matrixSeatError').innerText = errors.matrix_id.join(', ');
            }
            if (errors.type_room_id) {
                document.getElementById('typeRoomError').innerText = errors.type_room_id.join(', ');
            }
            // Thêm các trường khác nếu cần
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Lắng nghe sự kiện thay đổi của tất cả các checkbox có lớp 'switch-is-active'
            $('.switch-is-active').on('change', function() {
                // Lấy ID của room từ thuộc tính 'data-id'
                let roomId = $(this).data('id');
                // Lấy trạng thái hiện tại của checkbox
                let isActive = $(this).is(':checked') ? 1 : 0;

                // Gửi yêu cầu AJAX
                $.ajax({
                    url: '{{ route('admin.rooms.update-active') }}', // URL để cập nhật trạng thái (sẽ tạo sau)
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Bảo vệ CSRF
                        id: roomId,
                        is_active: isActive
                    },
                    success: function(response) {
                        // Hiển thị thông báo thành công
                        if (!response.success) {
                            alert('Có lỗi xảy ra, vui lòng thử lại.');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi khi yêu cầu không thành công
                        alert('Lỗi kết nối hoặc server không phản hồi.');
                        console.error(error);
                    }
                });
            });
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script>
        new DataTable("#tableAllRoom", {
            order: [
                [0, 'desc']
            ]
        });
        new DataTable("#tableIsPublish", {
            order: [
                [0, 'desc']
            ]
        });
        new DataTable("#tableIsDraft", {
            order: [
                [0, 'desc']
            ]
        });
        @foreach ($cinemas as $cinema)
            new DataTable("#tableCinemaID{{ $cinema->id }}", {
                order: [
                [0, 'desc']
            ]
            });
        @endforeach
    </script>
@endsection
