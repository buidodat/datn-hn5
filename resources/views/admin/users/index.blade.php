@extends('admin.layouts.master')

@section('title')
    Danh sách tài khoản
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
                <h4 class="mb-sm-0">Danh sách tài khoản</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">tài khoản</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
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
                    <h5 class="card-title mb-0">Danh sách tài khoản</h5>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3 ">Thêm mới</a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success m-3">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Họ và tên</th>
                                <th>Hình ảnh</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Ngày sinh</th>
                                <th>Giới tính</th>
                                <th>Loại người dùng</th>
                                <th>Chức năng</th>
                            </tr>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>

                                        @if (!empty($user->img_thumbnail))
                                            <img src="{{ Storage::url($user->img_thumbnail) }}"
                                                class="rounded-circle avatar-lg img-thumbnail user-profile-image "
                                                alt="user-profile-image">
                                        @else
                                            <img src="{{ asset('theme/admin/assets/images/users/user-dummy-img.jpg') }}"
                                                class="rounded-circle avatar-lg img-thumbnail user-profile-image"
                                                alt="user-profile-image">
                                        @endif


                                    </td>
                                    <td>{{ $user->email }}
                                    </td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{  Carbon\Carbon::parse($user->birthday)->format('d/m/Y') ?? 'null' }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>
                                        @if ($user->type == App\Models\User::TYPE_ADMIN)
                                        <span class="badge badge-gradient-success">Quản trị viên</span>
                                        @else
                                        <span class="badge rounded-pill bg-primary-subtle text-primary">Khách hàng</span>
                                        @endif
                                    </td>


                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.users.show', $user) }}">
                                                <button title="xem" class="btn btn-success btn-sm " type="button"><i
                                                        class="fas fa-eye"></i></button></a>
                                            <a href="{{ route('admin.users.edit', $user) }}">
                                                <button title="xem" class="btn btn-warning btn-sm mx-1 " type="button"><i
                                                        class="fas fa-edit"></i></button>
                                            </a>
                                            {{-- <form action="{{ route('admin.users.destroy', $user) }}" method="POST" >
                                                @method("DELETE")
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm " onclick="return confirm('Bạn có muốn xóa ?')"><i class="fas fa-trash-alt"></i></button>
                                            </form> --}}
                                        </div>
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
