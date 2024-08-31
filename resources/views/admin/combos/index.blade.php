@extends('admin.layouts.master')

@section('title')
    Danh sách Combo
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
                <h4 class="mb-sm-0">Combo</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Combo</li>
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
                    <h5 class="card-title mb-0">Danh sách Combo</h5>
                    <a href="{{ route('admin.combos.create') }}" class="btn btn-primary mb-3 ">Thêm mới</a>
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
                                <th>Tên combo</th>
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Mô tả</th>
                                <th>Hoạt động</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">
                                        @if ($item->img_thumbnail && \Storage::exists($item->img_thumbnail))
                                            <img src="{{ Storage::url($item->img_thumbnail) }}" alt=""
                                                width="100px" height="60px">
                                        @else
                                            No image !
                                        @endif
                                    </td>
                                    <td>{{ number_format($item->price) }} VNĐ</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{!! $item->is_active
                                        ? '<span class="badge bg-primary">Đang hoạt động</span>'
                                        : '<span class="badge bg-danger">Ngừng hoạt động</span>' !!}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.combos.show', $item) }}">
                                            <button title="xem" class="btn btn-success btn-sm " type="button">
                                                <i class="fas fa-eye"></i></button>
                                        </a>
                                        <a href="{{ route('admin.combos.edit', $item) }}">
                                            <button title="sửa" class="btn btn-warning btn-sm " type="button">
                                                <i class="fas fa-edit"></i></button>
                                        </a>
                                        {{-- <form action="{{ route('admin.combos.destroy', $item) }}" method="post" class="mt-2">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Có muốn xóa không?')">Xóa</button>
                                        </form> --}}
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
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
