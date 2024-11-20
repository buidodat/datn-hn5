@extends('admin.layouts.master')

@section('title')
    Danh sách Rạp
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
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Rạp</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Danh sách</a></li>
                        <li class="breadcrumb-item active">Rạp</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Danh sách Rạp</h5>
                    <a href="{{ route('admin.cinemas.create') }}" class="btn btn-primary mb-3 ">Thêm mới</a>
                </div>

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-success">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên rạp</th>
                                <th>Chi nhánh</th>
                                <th>Địa chỉ</th>
                                <th>Hoạt động</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->branch->name }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>
                                        <div class="form-check form-switch form-switch-success">
                                            <input class="form-check-input switch-is-active changeActive" name="is_active"
                                                type="checkbox" role="switch" data-cinema-id="{{ $item->id }}"
                                                @checked($item->is_active)
                                                onclick="return confirm('Bạn có chắc muốn thay đổi ?')">
                                        </div>
                                    </td>
                                    <td>
                                        {{-- <a href="">
                                            <button title="xem" class="btn btn-success btn-sm " type="button">
                                                <i class="fas fa-eye"></i></button>
                                        </a> --}}
                                        <a href="{{ route('admin.cinemas.edit', $item) }}">
                                            <button title="xem" class="btn btn-warning btn-sm " type="button">
                                                <i class="fas fa-edit"></i></button>
                                        </a>
                                        @if ($item->rooms()->count() == 0)
                                            <form action="{{ route('admin.cinemas.destroy', $item) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có muốn xóa không')">
                                                    <i class="ri-delete-bin-7-fill"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection


@section('script-libs')
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
        $(document).ready(function() {
            // Khởi tạo DataTable
            let table = $('#example').DataTable({
                order: [
                ],
            });
            // Xử lý sự kiện change cho checkbox .changeActive
            $(document).on('change', '.changeActive', function() {
                let cinemaId = $(this).data('cinema-id');
                let is_active = $(this).is(':checked') ? 1 : 0;

                // Gửi yêu cầu AJAX để thay đổi trạng thái
                $.ajax({
                    url: '{{ route('cinemas.change-active') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: cinemaId,
                        is_active: is_active
                    },
                    success: function(response) {
                        if (response.success) {
                            let row = table.row($(`[data-cinema-id="${cinemaId}"]`).closest(
                                'tr'));

                            // Cập nhật cột trạng thái (cột thứ 2) trong dòng này
                            let statusHtml = response.data.is_active ?
                                `<div class="form-check form-switch form-switch-success">
                                    <input class="form-check-input switch-is-active changeActive"
                                        type="checkbox" data-cinema-id="${cinemaId}" checked   onclick="return confirm('Bạn có chắc muốn thay đổi ?')">
                                </div><span class='small text-success'>Đã kích hoạt</span>` :
                                `<div class="form-check form-switch form-switch-success">
                                    <input class="form-check-input switch-is-active changeActive"
                                        type="checkbox" data-cinema-id="${cinemaId}"   onclick="return confirm('Bạn có chắc muốn thay đổi ?')">
                                </div>  <span class='small text-secondary'>Dừng hoạt động</span>`;
                            row.cell(row.index(), 4).data(statusHtml).draw(false);

                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Lỗi kết nối hoặc server không phản hồi.');
                        console.error(error);
                    }
                });

                console.log('Đã thay đổi trạng thái active');
            });
        });
    </script>
@endsection
