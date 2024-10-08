@extends('admin.layouts.master')

@section('title')
    Sơ đồ ghế
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
                <h4 class="mb-sm-0">Quản lý sơ đồ ghế</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sơ đồ ghế</a></li>
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
                            <h5 class="card-title mb-0">Danh sách sơ đồ ghế</h5>
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

                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
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
                                    <td>{{ $item->name }}</td>
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

                                        <a href="{{ route('admin.branches.edit', $item) }}">
                                            <button title="xem" class="btn btn-warning btn-sm " type="button"><i
                                                    class="fas fa-edit"></i></button>
                                        </a>
                                        <form action="{{ route('admin.branches.destroy', $item) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có muốn xóa không')">
                                                <i class="ri-delete-bin-7-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Modal thêm mới phòng chiếu-->
    <div class="modal fade" id="createSeatTemplate" tabindex="-1" aria-labelledby="createSeatTemplateLabel" aria-hidden="true">
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
                            <!-- Tên phòng chiếu -->
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label"><span class="text-danger">*</span> Tên mẫu</label>
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
                                <textarea name="description" class='form-control' rows="3" placeholder="Mẫu sơ đồ ghế tiêu chuẩn: 4 hàng hế thường, 8 hàng ghế vip."></textarea>
                                <span class="text-danger mt-3" id="createDescriptionError"></span> <!-- Thêm thông báo lỗi -->
                            </div>
                            <!-- Chọn Chi Nhánh -->

                            <input type="hidden" name="capacity" value='5'> <!-- Giá trị cố định cho capacity -->
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
@endsection


@section('script-libs')
    <script>
        document.getElementById('createSeatTemplateBtn').addEventListener('click', function(event) {
                const form = document.getElementById('createSeatTemplateForm');
                const formData = new FormData(form);
                let hasErrors = false; // Biến để theo dõi có lỗi hay không
                const url = APP_URL + `/api/seat-templates`
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
                            $('#createSeatTemplateModal').modal('hide');
                            form.reset();
                            alert('thêm mới thành công');
                            window.reload();
                            // window.location.href =
                            //     `${APP_URL}/admin/rooms/seat-diagram/${data.room.id}`;
                        }
                    })
                    .catch(error => console.error('Error adding room:', error));
            });

            function handleErrors(errors, prefix) {
            // Reset thông báo lỗi trước đó
            document.getElementById(`${prefix}NameError`).innerText = '';
            document.getElementById(`${prefix}BranchError`).innerText = '';
            document.getElementById(`${prefix}CinemaError`).innerText = '';
            document.getElementById(`${prefix}MatrixSeatError`).innerText = '';
            document.getElementById(`${prefix}TypeRoomError`).innerText = '';

            // Kiểm tra và hiển thị lỗi cho từng trường
            if (errors.name) {
                document.getElementById(`${prefix}NameError`).innerText = errors.name.join(', ');
            }
            if (errors.cinema_id) {
                document.getElementById(`${prefix}DescriptionError`).innerText = errors.cinema_id.join(', ');
            }
            if (errors.matrix_id) {
                document.getElementById(`${prefix}MatrixSeatError`).innerText = errors.matrix_id.join(', ');
            }
            if (errors.type_room_id) {
                document.getElementById(`${prefix}TypeRoomError`).innerText = errors.type_room_id.join(', ');
            }
        }
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
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });

    </script>
@endsection
