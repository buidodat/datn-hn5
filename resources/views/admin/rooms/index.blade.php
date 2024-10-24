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
                                <span class="badge bg-success align-middle ms-1">{{ $rooms->where('is_publish',true)->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-3 isDraft" data-bs-toggle="tab" href="#isDraft" role="tab"
                                aria-selected="false">
                                Bản nháp<span class="badge bg-warning align-middle ms-1">{{ $rooms->where('is_publish',false)->count() }}</span>
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





                                                        <a class="cursor-pointer link-opacity-75-hover link-opacity-50 openUpdateRoomModal"
                                                            data-room-id="{{ $room->id }}"
                                                            data-room-name="{{ $room->name }}"
                                                            data-branch-id="{{ $room->branch_id }}"
                                                            data-cinema-id="{{ $room->cinema_id }}"
                                                            data-type-room-id="{{ $room->type_room_id }}"
                                                            data-seat-template-id="{{ $room->seat_template_id }}"
                                                            data-is-publish={{ $room->is_publish }}>Chỉnh
                                                            sửa</a>

                                                        <a class=" link-opacity-75-hover link-opacity-50  mx-1"
                                                            href="{{ route('admin.rooms.edit', $room) }}">Sơ đồ
                                                            ghế</a>
                                                        @if (!$room->is_publish)
                                                            <a class="link-opacity-75-hover link-opacity-50"
                                                                href="{{ route('admin.rooms.destroy', $room) }}"
                                                                onclick="return confirm('Sau khi xóa sẽ không thể khôi phục, bạn có chắc chắn ?')">Xóa
                                                                bỏ</a>
                                                        @else
                                                            <a class=" link-opacity-75-hover link-opacity-50 "
                                                                href="{{ route('admin.rooms.show', $room) }}">Chi tiết</a>
                                                        @endif


                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $room->cinema->name }}</td>
                                            <td>{{ $room->typeRoom->name }}</td>
                                            <td>{{ $room->seats->where('is_active', true)->count() }}
                                                / {{ $room->seats->count() }} chỗ ngồi</td>
                                            <td>
                                                {!! $room->is_publish == 1
                                                    ? '<span class="badge bg-success-subtle text-success">Đã xuất bản</span>'
                                                    : '<span class="badge bg-danger-subtle text-danger">Bản nháp</span>' !!}
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input switch-is-active channge-is-active"
                                                        name="is_active" type="checkbox" role="switch"
                                                        data-id="{{ $room->id }}" @checked($room->is_active)
                                                        onclick="return confirm('Bạn có chắc muốn thay đổi ?')"
                                                        @disabled(!$room->is_publish)>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane active " id="isPublish" role="tabpanel">
                            <table class="table table-bordered dt-responsive nowrap align-middle w-100" id="tableIsPublish">
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
                                    @foreach ($rooms->where('is_publish',true) as $index => $room)
                                        <tr>
                                            <td>{{ $room->id }}</td>
                                            <td>
                                                <div class='room-name'>
                                                    <div class='mb-1 fs-6'> {{ $room->name }}</div>
                                                    <div>

                                                        <a class="cursor-pointer link-opacity-75-hover link-opacity-50 openUpdateRoomModal"
                                                            data-room-id="{{ $room->id }}"
                                                            data-room-name="{{ $room->name }}"
                                                            data-branch-id="{{ $room->branch_id }}"
                                                            data-cinema-id="{{ $room->cinema_id }}"
                                                            data-type-room-id="{{ $room->type_room_id }}"
                                                            data-seat-template-id="{{ $room->seat_template_id }}"
                                                            data-is-publish={{ $room->is_publish }}>Chỉnh
                                                            sửa</a>
                                                        <a class=" link-opacity-75-hover link-opacity-50  mx-1"
                                                            href="{{ route('admin.rooms.edit', $room) }}">Sơ đồ
                                                            ghế</a>
                                                        @if (!$room->is_publish)
                                                            <a class="link-opacity-75-hover link-opacity-50"
                                                                href="{{ route('admin.rooms.destroy', $room) }}"
                                                                onclick="return confirm('Sau khi xóa sẽ không thể khôi phục, bạn có chắc chắn ?')">Xóa
                                                                bỏ</a>
                                                        @else
                                                            <a class=" link-opacity-75-hover link-opacity-50 "
                                                                href="{{ route('admin.rooms.show', $room) }}">Chi tiết</a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $room->cinema->name }}</td>
                                            <td>{{ $room->typeRoom->name }}</td>
                                            <td>{{ $room->seats->where('is_active', true)->count() }}
                                                / {{ $room->seats->count() }} chỗ ngồi</td>
                                            <td>
                                                {!! $room->is_publish == 1
                                                    ? '<span class="badge bg-success-subtle text-success">Đã xuất bản</span>'
                                                    : '<span class="badge bg-danger-subtle text-danger">Bản nháp</span>' !!}
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input switch-is-active channge-is-active"
                                                        name="is_active" type="checkbox" role="switch"
                                                        data-id="{{ $room->id }}" @checked($room->is_active)
                                                        onclick="return confirm('Bạn có chắc muốn thay đổi ?')">
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
                                    @foreach ($rooms->where('is_publish',false) as $index => $room)
                                        <tr>
                                            <td>{{ $room->id }}</td>
                                            <td>
                                                <div class='room-name'>
                                                    <div class='mb-1 fs-6'> {{ $room->name }}</div>
                                                    <div>

                                                        <a class="cursor-pointer link-opacity-75-hover link-opacity-50 openUpdateRoomModal"
                                                            data-room-id="{{ $room->id }}"
                                                            data-room-name="{{ $room->name }}"
                                                            data-branch-id="{{ $room->branch_id }}"
                                                            data-cinema-id="{{ $room->cinema_id }}"
                                                            data-type-room-id="{{ $room->type_room_id }}"
                                                            data-seat-template-id="{{ $room->seat_template_id }}"
                                                            data-is-publish={{ $room->is_publish }}>Chỉnh
                                                            sửa</a>
                                                        <a class=" link-opacity-75-hover link-opacity-50  mx-1"
                                                            href="{{ route('admin.rooms.edit', $room) }}">Sơ đồ
                                                            ghế</a>
                                                        @if (!$room->is_publish)
                                                            <a class="link-opacity-75-hover link-opacity-50"
                                                                href="{{ route('admin.rooms.destroy', $room) }}"
                                                                onclick="return confirm('Sau khi xóa sẽ không thể khôi phục, bạn có chắc chắn ?')">Xóa
                                                                bỏ</a>
                                                        @else
                                                            <a class=" link-opacity-75-hover link-opacity-50 "
                                                                href="{{ route('admin.rooms.show', $room) }}">Chi tiết</a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $room->cinema->name }}</td>
                                            <td>{{ $room->typeRoom->name }}</td>
                                            <td>{{ $room->seats->where('is_active', true)->count() }}
                                                / {{ $room->seats->count() }} chỗ ngồi</td>
                                            <td>
                                                {!! $room->is_publish == 1
                                                    ? '<span class="badge bg-success-subtle text-success">Đã xuất bản</span>'
                                                    : '<span class="badge bg-danger-subtle text-danger">Bản nháp</span>' !!}
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input switch-is-active channge-is-active"
                                                        name="is_active" type="checkbox" role="switch"
                                                        @checked($room->is_active) disabled>
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
                                                            <a class=" link-opacity-75-hover link-opacity-50 "
                                                                href="{{ route('admin.rooms.show', $room) }}">Chi tiết</a>
                                                            <a
                                                                class="cursor-pointer link-opacity-75-hover link-opacity-50 mx-1">Chỉnh
                                                                sửa</a>
                                                            <a class=" link-opacity-75-hover link-opacity-50 "
                                                                href="{{ route('admin.rooms.edit', $room) }}">Sơ
                                                                đồ
                                                                ghế</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $room->cinema->name }}</td>
                                                <td>{{ $room->typeRoom->name }}</td>
                                                <td>{{ $room->seats->where('is_active', true)->count() }}
                                                    / {{ $room->seats->count() }} chỗ ngồi</td>
                                                <td>
                                                    {!! $room->is_publish == 1
                                                        ? '<span class="badge bg-success-subtle text-success">Đã xuất bản</span>'
                                                        : '<span class="badge bg-danger-subtle text-danger">Bản nháp</span>' !!}
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch form-switch-success">
                                                        <input class="form-check-input switch-is-active channge-is-active"
                                                            name="is_active" type="checkbox" role="switch"
                                                            data-id="{{ $room->id }}" @checked($room->is_active)
                                                            onclick="return confirm('Bạn có chắc muốn thay đổi ?')"
                                                            @disabled(!$room->is_publish)>
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
                                <span class="text-danger mt-3" id="createNameError"></span> <!-- Thêm thông báo lỗi -->
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="branchId" class="form-label"><span class="text-danger">*</span> Chi
                                    Nhánh</label>
                                <select class="form-select" id="branchId" name="branch_id"
                                    onchange="loadCinemas('branchId', 'cinemaId')" required>
                                    <option value="" disabled selected>Chọn chi nhánh</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger mt-3" id="createBranchError"></span> <!-- Thêm thông báo lỗi -->
                            </div>

                            <!-- Chọn Rạp Chiếu -->
                            <div class="col-md-7 mb-3">
                                <label for="cinemaId" class="form-label"><span class="text-danger">*</span> Rạp
                                    Chiếu</label>
                                <select class="form-select" id="cinemaId" name="cinema_id" required>
                                    <option value="" disabled selected>Chọn rạp chiếu</option>
                                </select>
                                <span class="text-danger mt-3" id="createCinemaError"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="type_room_id" class="form-label"><span class="text-danger">*</span> Loại
                                    phòng chiếu</label>
                                <select class="form-select" id="type_room_id" name="type_room_id" required>
                                    @foreach ($typeRooms as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger mt-3" id="createTypeRoomError"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="seat_template_id" class="form-label"><span class="text-danger">*</span> Mẫu
                                    sơ đồ
                                    ghế</label>
                                <select class="form-select" id="seat_template_id" name="seat_template_id" required>
                                    @foreach ($seatTemplates as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger mt-3" id="createSeatTemplateError"></span>
                            </div>
                            <!-- Chọn Chi Nhánh -->

                            <input type="hidden" name="capacity" value='5'> <!-- Giá trị cố định cho capacity -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="createRoomBtn">Thêm mới</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal cập nhật phòng chiếu -->
    <div class="modal fade" id="updateRoomModal" tabindex="-1" aria-labelledby="updateRoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoomModalLabel">Cập Nhật Phòng Chiếu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateRoomForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <input type="hidden" id="updateRoomId" name="room_id">
                            <div class="col-md-12 mb-3">
                                <label for="updateName" class="form-label"><span class="text-danger">*</span> Tên
                                    Phòng</label>
                                <input type="text" class="form-control" id="updateName" name="name" required
                                    placeholder="Poly 202">
                                <span class="text-danger mt-3" id="updateNameError"></span>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="updateBranchId" class="form-label"><span class="text-danger">*</span> Chi
                                    Nhánh</label>
                                <select class="form-select" id="updateBranchId" name="branch_id"
                                    onchange="loadCinemas('updateBranchId', 'updateCinemaId')" required>
                                    <option value="" disabled selected>Chọn chi nhánh</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger mt-3" id="updateBranchError"></span>
                            </div>

                            <div class="col-md-7 mb-3">
                                <label for="updateCinemaId" class="form-label"><span class="text-danger">*</span> Rạp
                                    Chiếu</label>
                                <select class="form-select" id="updateCinemaId" name="cinema_id" required>
                                    <option value="" disabled selected>Chọn rạp chiếu</option>
                                </select>
                                <span class="text-danger mt-3" id="updateCinemaError"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="updateTypeRoomId" class="form-label"><span class="text-danger">*</span> Loại
                                    phòng chiếu</label>
                                <select class="form-select" id="updateTypeRoomId" name="type_room_id" required>
                                    @foreach ($typeRooms as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger mt-3" id="updateTypeRoomError"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="updateSeatTemplateId" class="form-label"><span class="text-danger">*</span>
                                    Mẫu sơ đồ
                                    ghế</label>
                                <select class="form-select" id="updateSeatTemplateId" name="seat_template_id" required>
                                    @foreach ($seatTemplates as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger mt-3" id="updateSeatTemplateError"></span>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="updateRoomBtn">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script-libs')
    {{-- Hàm load các rạp chiếu khi chọn chi nhánh & modal create rạp chiếu --}}
    <script>
        function loadCinemas(branchIdElementId, cinemaSelectElementId, selectedCinemaId = null) {
            const branchId = document.getElementById(branchIdElementId).value;
            const cinemaSelect = document.getElementById(cinemaSelectElementId);
            cinemaSelect.innerHTML = '<option value="" disabled selected>Chọn rạp chiếu</option>'; // Reset options

            if (branchId) {
                const url = APP_URL + `/api/cinemas/${branchId}`;
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

                            // Nếu có cinemaId đã chọn, chọn nó trong danh sách
                            if (selectedCinemaId) {
                                cinemaSelect.value = selectedCinemaId;
                            }
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

        document.getElementById('createRoomBtn').addEventListener('click', function(event) {
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
                            handleErrors(errorData.error, 'create'); // Gọi hàm xử lý lỗi
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
                            `${APP_URL}/admin/rooms/edit/${data.room.id}`; // Sử dụng room.id vừa thêm
                    }
                })
                .catch(error => console.error('Error adding room:', error));
        });
        // Hàm để mở modal phòng chiếu
        document.querySelectorAll('.openUpdateRoomModal').forEach(button => {
            button.addEventListener('click', function() {
                const roomId = this.getAttribute('data-room-id'); // Lấy roomId từ data attribute
                const roomName = this.getAttribute('data-room-name');
                const branchId = this.getAttribute('data-branch-id');
                const cinemaId = this.getAttribute('data-cinema-id');
                const typeRoomId = this.getAttribute('data-type-room-id');
                const seatTemplateId = this.getAttribute('data-seat-template-id');
                const isPublish = this.getAttribute('data-is-publish');

                // Điền dữ liệu vào modal
                document.getElementById('updateRoomId').value = roomId; // Gán giá trị roomId
                document.getElementById('updateName').value = roomName;
                document.getElementById('updateBranchId').value = branchId;

                // Tải danh sách rạp chiếu và chọn rạp đã chọn
                loadCinemas('updateBranchId', 'updateCinemaId', cinemaId);

                document.getElementById('updateTypeRoomId').value = typeRoomId;
                document.getElementById('updateSeatTemplateId').value = seatTemplateId;
                if (isPublish == 1) {
                    // Chỉ cho phép nhập tên, các trường khác disabled
                    document.getElementById('updateBranchId').disabled = true;
                    document.getElementById('updateCinemaId').disabled = true;
                    document.getElementById('updateTypeRoomId').disabled = true;
                    document.getElementById('updateSeatTemplateId').disabled = true;
                } else {
                    // Nếu chưa publish, cho phép chỉnh sửa tất cả
                    document.getElementById('updateBranchId').disabled = false;
                    document.getElementById('updateCinemaId').disabled = false;
                    document.getElementById('updateTypeRoomId').disabled = false;
                    document.getElementById('updateSeatTemplateId').disabled = false;
                }

                // Mở modal
                console.log(roomId, roomName, branchId, cinemaId, typeRoomId, seatTemplateId);
                $('#updateRoomModal').modal('show');
            });
        });

        // Hàm để cập nhật thông tin phòng chiếu
        document.getElementById('updateRoomBtn').addEventListener('click', function(event) {
            const form = document.getElementById('updateRoomForm');
            const formData = new FormData(form);
            console.log([...formData]);
            const roomId = document.getElementById('updateRoomId').value; // Lấy ID phòng từ hidden input
            let hasErrors = false; // Biến để theo dõi có lỗi hay không
            const url = APP_URL + `/api/rooms/${roomId}`; // URL cập nhật phòng chiếu

            fetch(url, {
                    method: 'POST',
                    body: formData,

                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            handleErrors(errorData.error, 'update'); // Gọi hàm xử lý lỗi
                            hasErrors = true; // Đánh dấu có lỗi
                        });
                    }
                    return response.json(); // Chuyển đổi phản hồi thành JSON
                })
                .then(data => {
                    if (!hasErrors) {
                        console.log(data);
                        $('#updateRoomModal').modal('hide');
                        form.reset();
                        location.reload();
                    }

                })
                .catch(error => console.error('Error updating room:', error));
        });


        // Hàm để hiển thị lỗi xác thực
        function handleErrors(errors, prefix) {
            // Reset thông báo lỗi trước đó
            document.getElementById(`${prefix}NameError`).innerText = '';
            document.getElementById(`${prefix}BranchError`).innerText = '';
            document.getElementById(`${prefix}CinemaError`).innerText = '';
            document.getElementById(`${prefix}SeatTemplateError`).innerText = '';
            document.getElementById(`${prefix}TypeRoomError`).innerText = '';

            // Kiểm tra và hiển thị lỗi cho từng trường
            if (errors.name) {
                document.getElementById(`${prefix}NameError`).innerText = errors.name.join(', ');
            }
            if (errors.branch_id) {
                document.getElementById(`${prefix}BranchError`).innerText = errors.branch_id.join(', ');
            }
            if (errors.cinema_id) {
                document.getElementById(`${prefix}CinemaError`).innerText = errors.cinema_id.join(', ');
            }
            if (errors.seat_template_id) {
                document.getElementById(`${prefix}SeatTemplateError`).innerText = errors.seat_template_id.join(', ');
            }
            if (errors.type_room_id) {
                document.getElementById(`${prefix}TypeRoomError`).innerText = errors.type_room_id.join(', ');
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- cập nhật active phòng chiếu --}}
    <script>
        $(document).ready(function() {
            $('.channge-is-active ').on('change', function() {
                // Lấy ID của room từ thuộc tính 'data-id'
                let roomId = $(this).data('id');
                // Lấy trạng thái hiện tại của checkbox
                let isActive = $(this).is(':checked') ? 1 : 0;

                // Gửi yêu cầu AJAX
                $.ajax({
                    url: '{{ route('rooms.update-active') }}', // URL để cập nhật trạng thái (sẽ tạo sau)
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
