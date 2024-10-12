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
                                    data-bs-target="#createSeatTemplate">Thêm
                                    mới</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">

                    <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link  All active py-3" data-bs-toggle="tab" href="#allSeatTemplate" role="tab"
                                aria-selected="true">
                                Tất cả
                                <span class="badge bg-dark align-middle ms-1">1</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-3  isPublish" data-bs-toggle="tab" href="#isPublish" role="tab"
                                aria-selected="false">
                                Đã xuất bản
                                <span class="badge bg-success align-middle ms-1">2</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-3 isDraft" data-bs-toggle="tab" href="#isDraft" role="tab"
                                aria-selected="false">
                                Bản nháp<span class="badge bg-warning align-middle ms-1">3</span>
                            </a>
                        </li>
                    </ul>
                    <div class="card-body tab-content ">
                        <div class="tab-pane active " id="allSeatTemplate" role="tabpanel">
                            <table id="tableAllSeatTemplate"
                                class="table table-bordered dt-responsive nowrap align-middle w-100" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên mẫu</th>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th>Hoạt động</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($seatTemplates as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                <div class='seat-template-name'>
                                                    <div class='mb-1 fs-6'> {{ $item->name }}</div>
                                                    <div>

                                                        @if (!$item->is_publish)
                                                            <a class="link-opacity-75-hover link-opacity-50"
                                                                href="{{ route('admin.rooms.destroy', $item) }}"
                                                                onclick="return confirm('Sau khi xóa sẽ không thể khôi phục, bạn có chắc chắn ?')">Xóa
                                                                bỏ</a>
                                                        @else
                                                            <a class=" link-opacity-75-hover link-opacity-50 "
                                                                href="{{ route('admin.rooms.show', $item) }}">Chi tiết</a>
                                                        @endif



                                                        <a class="cursor-pointer link-opacity-75-hover link-opacity-50 mx-1 openUpdateSeatTemplateModal"
                                                            data-seat-template-id="{{ $item->id }}"
                                                            data-seat-template-name="{{ $item->name }}"
                                                            data-seat-template-description="{{ $item->description }}"
                                                            data-matrix-id="{{ $item->matrix_id }}"
                                                            data-is-publish={{ $item->is_publish }}>Chỉnh
                                                            sửa</a>

                                                        <a class=" link-opacity-75-hover link-opacity-50 "
                                                            href="{{ route('admin.rooms.seat-diagram', $item) }}">Sơ đồ
                                                            ghế</a>


                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                {!! $item->is_publish == 1
                                                    ? '<span class="badge bg-success-subtle text-success">Đã xuất bản</span>'
                                                    : '<span class="badge bg-danger-subtle text-danger">Bản nháp</span>' !!}
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input switch-is-active channge-is-active"
                                                        name="is_active" type="checkbox" role="switch"
                                                        data-id="{{ $item->id }}" @checked($item->is_active)
                                                        onclick="return confirm('Bạn có chắc muốn thay đổi ?')"
                                                        @disabled(!$item->is_publish)>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <a href="">
                                                <button title="xem" class="btn btn-success btn-sm " type="button"><i
                                                        class="fas fa-eye"></i></button></a> --}}

                                                <a href="{{ route('admin.seat-templates.edit', $item) }}">
                                                    <button title="xem" class="btn btn-warning btn-sm " type="button"><i
                                                            class="fas fa-edit"></i></button>
                                                </a>
                                                {{-- <form action="{{ route('admin.seat-templates.destroy', $item) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có muốn xóa không')">
                                                    <i class="ri-delete-bin-7-fill"></i>
                                                </button>
                                            </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        {{-- <div class="tab-pane active " id="isPublish" role="tabpanel">
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
                                    @foreach ($roomPublishs as $index => $room)
                                        <tr>
                                            <td>{{ $room->id }}</td>
                                            <td>
                                                <div class='room-name'>
                                                    <div class='mb-1 fs-6'> {{ $room->name }}</div>
                                                    <div>
                                                        @if (!$room->is_publish)
                                                            <a class="link-opacity-75-hover link-opacity-50"
                                                                href="{{ route('admin.rooms.destroy', $room) }}"
                                                                onclick="return confirm('Sau khi xóa sẽ không thể khôi phục, bạn có chắc chắn ?')">Xóa
                                                                bỏ</a>
                                                        @else
                                                            <a class=" link-opacity-75-hover link-opacity-50 "
                                                                href="{{ route('admin.rooms.show', $room) }}">Chi tiết</a>
                                                        @endif
                                                        <a class="cursor-pointer link-opacity-75-hover link-opacity-50 mx-1 openUpdateSeatTemplateModal"
                                                            data-room-id="{{ $room->id }}"
                                                            data-room-name="{{ $room->name }}"
                                                            data-branch-id="{{ $room->branch_id }}"
                                                            data-cinema-id="{{ $room->cinema_id }}"
                                                            data-type-room-id="{{ $room->type_room_id }}"
                                                            data-matrix-id="{{ $room->matrix_id }}"
                                                            data-is-publish={{ $room->is_publish }}>Chỉnh
                                                            sửa</a>
                                                        <a class=" link-opacity-75-hover link-opacity-50 "
                                                            href="{{ route('admin.rooms.seat-diagram', $room) }}">Sơ đồ
                                                            ghế</a>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $room->cinema->name }}</td>
                                            <td>{{ $room->typeRoom->name }}</td>
                                            <td>{{ $room->seats->whereNull('deleted_at')->where('is_active', true)->count() }}
                                                / {{ $room->seats->whereNull('deleted_at')->count() }} chỗ ngồi</td>
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
                                    @foreach ($roomDrafts as $index => $room)
                                        <tr>
                                            <td>{{ $room->id }}</td>
                                            <td>
                                                <div class='room-name'>
                                                    <div class='mb-1 fs-6'> {{ $room->name }}</div>
                                                    <div>
                                                        @if (!$room->is_publish)
                                                            <a class="link-opacity-75-hover link-opacity-50"
                                                                href="{{ route('admin.rooms.destroy', $room) }}"
                                                                onclick="return confirm('Sau khi xóa sẽ không thể khôi phục, bạn có chắc chắn ?')">Xóa
                                                                bỏ</a>
                                                        @else
                                                            <a class=" link-opacity-75-hover link-opacity-50 "
                                                                href="{{ route('admin.rooms.show', $room) }}">Chi tiết</a>
                                                        @endif
                                                        <a class="cursor-pointer link-opacity-75-hover link-opacity-50 mx-1 openUpdateSeatTemplateModal"
                                                            data-room-id="{{ $room->id }}"
                                                            data-room-name="{{ $room->name }}"
                                                            data-branch-id="{{ $room->branch_id }}"
                                                            data-cinema-id="{{ $room->cinema_id }}"
                                                            data-type-room-id="{{ $room->type_room_id }}"
                                                            data-matrix-id="{{ $room->matrix_id }}"
                                                            data-is-publish={{ $room->is_publish }}>Chỉnh
                                                            sửa</a>
                                                        <a class=" link-opacity-75-hover link-opacity-50 "
                                                            href="{{ route('admin.rooms.seat-diagram', $room) }}">Sơ đồ
                                                            ghế</a>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $room->cinema->name }}</td>
                                            <td>{{ $room->typeRoom->name }}</td>
                                            <td>{{ $room->seats->whereNull('deleted_at')->where('is_active', true)->count() }}
                                                / {{ $room->seats->whereNull('deleted_at')->count() }} chỗ ngồi</td>
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
                        </div> --}}

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Modal thêm mới mẫu sơ đồ ghế-->
    <div class="modal fade" id="createSeatTemplate" tabindex="-1" aria-labelledby="createSeatTemplateLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSeatTemplateLabel">Thêm mới mẫu sơ đồ ghế</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createSeatTemplateForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label"><span class="text-danger">*</span> Tên
                                    mẫu</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    placeholder="Tiêu chuẩn">
                                <span class="text-danger mt-3" id="createNameError"></span> <!-- Thêm thông báo lỗi -->
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="matrix_id" class="form-label"><span class="text-danger">*</span> Ma trận
                                    ghế</label>
                                <select class="form-select" id="matrix_id" name="matrix_id" required>
                                    @foreach (App\Models\Room::MATRIXS as $matrix)
                                        <option value="{{ $matrix['id'] }}">{{ $matrix['name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger mt-3" id="createMatrixSeatError"></span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label"><span class="text-danger">*</span> Mô tả</label>
                                <textarea name="description" class='form-control' rows="3"
                                    placeholder="Mẫu sơ đồ ghế tiêu chuẩn: 4 hàng hế thường, 8 hàng ghế vip."></textarea>
                                <span class="text-danger mt-3" id="createDescriptionError"></span>
                                <!-- Thêm thông báo lỗi -->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="createSeatTemplateBtn">Thêm mới</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal cập nhật mẫu sơ đồ ghế -->
    <div class="modal fade" id="updateSeatTemplateModal" tabindex="-1" aria-labelledby="updateSeatTemplateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSeatTemplateModalLabel">Cập Nhật Mẫu Sơ Đồ Ghế</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateSeatTemplateForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <input type="hidden" id="updateSeatTemplateId" name="seat_template_id">
                            <div class="col-md-12 mb-3">
                                <label for="updateName" class="form-label"><span class="text-danger">*</span> Tên
                                    mẫu</label>
                                <input type="text" class="form-control" id="updateName" name="name" required
                                    placeholder="Poly 202">
                                <span class="text-danger mt-3" id="updateNameError"></span>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="updateMatrixId" class="form-label"><span class="text-danger">*</span> Ma trận
                                    ghế</label>
                                <select class="form-select" id="updateMatrixId" name="matrix_id" required>
                                    @foreach (App\Models\Room::MATRIXS as $matrix)
                                        <option value="{{ $matrix['id'] }}">{{ $matrix['name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger mt-3" id="updateMatrixSeatError"></span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label"><span class="text-danger">*</span> Mô tả</label>
                                <textarea name="description" class='form-control' rows="3" id="updateDescription"
                                    placeholder="Mẫu sơ đồ ghế tiêu chuẩn: 4 hàng hế thường, 8 hàng ghế vip."></textarea>
                                <span class="text-danger mt-3" id="updateDescriptionError"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="updateSeatTemplateBtn">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script-libs')
    {{-- Hàm load các rạp chiếu khi chọn chi nhánh & modal create rạp chiếu --}}
    <script>
        document.getElementById('createSeatTemplateBtn').addEventListener('click', function(event) {
            const form = document.getElementById('createSeatTemplateForm');
            const formData = new FormData(form);
            let hasErrors = false; // Biến để theo dõi có lỗi hay không
            const url = APP_URL + `/api/seat-templates/store`
            fetch(url, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        // Nếu có lỗi (400, 422, 500, ...), chuyển đến phần xử lý lỗi
                        return response.json().then(errorData => {
                            handleErrors(errorData.errors, 'create'); // Gọi hàm xử lý lỗi
                            hasErrors = true; // Đánh dấu có lỗi
                        });
                    }
                    return response.json(); // Chuyển đổi phản hồi thành JSON
                })
                .then(data => {
                    if (!hasErrors) { // Chỉ đóng modal và reset form khi không có lỗi
                        console.log(data);
                        $('#createSeatTemplateModal').modal('hide');
                        form.reset();
                        alert('thêm mới thành công');
                        window.location.reload();
                        // window.location.href =
                        //     `${APP_URL}/admin/rooms/seat-diagram/${data.room.id}`;
                    }
                })
                .catch(error => console.error('Error adding room:', error));
        });
        document.querySelectorAll('.openUpdateSeatTemplateModal').forEach(button => {
            button.addEventListener('click', function() {
                const seatTemplateId = this.getAttribute('data-seat-template-id'); // Lấy roomId từ data attribute
                const seatTemplateName = this.getAttribute('data-seat-template-name');
                const seatTemplateDescription = this.getAttribute('data-seat-template-description');
                const matrixId = this.getAttribute('data-matrix-id');
                const isPublish = this.getAttribute('data-is-publish');

                // Điền dữ liệu vào modal
                document.getElementById('updateSeatTemplateId').value = seatTemplateId; // Gán giá trị roomId
                document.getElementById('updateName').value = seatTemplateName;
                document.getElementById('updateDescription').value = seatTemplateDescription;
                document.getElementById('updateMatrixId').value = matrixId;
                if (isPublish == 1) {
                    document.getElementById('updateMatrixId').disabled = true;
                } else {
                    // Nếu chưa publish, cho phép chỉnh sửa tất cả

                    document.getElementById('updateMatrixId').disabled = false;
                }

                // Mở modal

                $('#updateSeatTemplateModal').modal('show');
            });
        });

        // Hàm để cập nhật thông tin phòng chiếu
        document.getElementById('updateSeatTemplateBtn').addEventListener('click', function(event) {
            const form = document.getElementById('updateSeatTemplateForm');
            const formData = new FormData(form);
            console.log([...formData]);
            const seatTemplateId = document.getElementById('updateSeatTemplateId').value; // Lấy ID phòng từ hidden input
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
                        $('#updateSeatTemplateModal').modal('hide');
                        form.reset();

                        alert('Thao tác thành công!'); // Hiển thị thông báo trước khi reload trang
                        location.reload();

                    }

                })
                .catch(error => console.error('Error updating room:', error));
        });

        function handleErrors(errors, prefix) {
            // Reset thông báo lỗi trước đó
            document.getElementById(`${prefix}NameError`).innerText = '';
            document.getElementById(`${prefix}MatrixSeatError`).innerText = '';
            document.getElementById(`${prefix}DescriptionError`).innerText = '';

            // Kiểm tra và hiển thị lỗi cho từng trường
            if (errors.name) {
                document.getElementById(`${prefix}NameError`).innerText = errors.name.join(', ');
            }
            if (errors.description) {
                document.getElementById(`${prefix}DescriptionError`).innerText = errors.description.join(', ');
            }
            if (errors.matrix_id) {
                document.getElementById(`${prefix}MatrixSeatError`).innerText = errors.matrix_id.join(', ');
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
        new DataTable("#tableAllSeatTemplate", {
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
    </script>
@endsection
