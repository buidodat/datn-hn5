@extends('admin.layouts.master')

@section('title')
    Danh sách suất chiếu
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
                <h4 class="mb-sm-0">Danh sách Suất chiếu</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Suất chiếu</a></li>
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
                <div class="card-header ">
                    {{-- d-flex justify-content-between --}}
                    <div class="row mb-3">
                        <h5 class="card-title mb-0">Danh sách Suất chiếu</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.showtimes.index') }}" method="GET">

                                <div class="row">

                                    <div class="col-md-3">
                                        {{-- <label for="">Rạp:</label> --}}
                                        <select name="cinema_id" id="" class="form-select">
                                            <option value="">Chọn Rạp</option>
                                            @foreach ($cinemas as $cinema)
                                                <option value="{{ $cinema->id }}"
                                                    {{ request('cinema_id') == $cinema->id ? 'selected' : '' }}>
                                                    {{ $cinema->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        {{-- <label for="">Ngày chiếu:</label> --}}
                                        <input type="date" name="date" id="" class="form-control"
                                            value="{{ request('date', now()->format('Y-m-d')) }}">
                                    </div>
                                    <div class="col-md-3">

                                        <button class="btn btn-success" name="btnSearch" type="submit">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="col-md-4" align="right">
                            <a href="{{ route('admin.showtimes.index') }}" class="btn btn-info mb-3 ">Danh sách</a>
                            <a href="{{ route('admin.showtimes.create') }}" class="btn btn-primary mb-3 ">Thêm mới</a>
                        </div>
                    </div>

                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success m-3">
                        {{ session()->get('success') }}
                    </div>
                @endif

                {{-- <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thời gian</th>
                                <th>Tên phim</th>
                                <th>Tên phòng</th>
                                <th>Ngày chiếu</th>
                                <th>Hoạt động</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $lastRoomName = null;
                            @endphp
                            @foreach ($showtimes as $i => $showtime)
                                <tr>
                                    <td>{{ $showtime->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i') }}
                                    </td>
                                    <td>{{ $showtime->movieVersion->movie->name }}</td>
                                    <td>
                                        <b>{{ $showtime->room->cinema->name }} - {{ $showtime->room->name }}</b>
                                    </td>

                                    <td>{{ $showtime->date }}</td>


                                    <td>
                                        {!! $showtime->is_active == 1
                                            ? '<span class="badge bg-success-subtle text-success text-uppercase">Yes</span>'
                                            : '<span class="badge bg-danger-subtle text-danger text-uppercase">No</span>' !!}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.showtimes.edit', $showtime) }}">
                                            <button title="xem" class="btn btn-warning btn-sm " type="button"><i
                                                    class="fas fa-edit"></i></button>
                                        </a>

                                        <form action="{{ route('admin.showtimes.destroy', $showtime) }}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn chắc chắn muốn xóa không?')"><i
                                                    class="ri-delete-bin-7-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div> --}}
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap align-middle"
                        style="width:100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thời gian</th>
                                <th>Tên phim</th>
                                <th>Tên phòng</th>
                                <th>Ngày chiếu</th>
                                <th>Hoạt động</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Nhóm suất chiếu theo tên phòng và ngày chiếu
                                $groupedShowtimes = $showtimes->groupBy(function ($showtime) {
                                    return $showtime->room->name . '_' . $showtime->date;
                                });
                            @endphp

                            @foreach ($groupedShowtimes as $key => $times)
                                @php
                                    $rowCount = $times->count(); // Số suất chiếu trong nhóm phòng + ngày chiếu
                                @endphp

                                @foreach ($times as $i => $showtime)
                                    <tr>
                                        <td>{{ $showtime->id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i') }}</td>
                                        <td>{{ $showtime->movieVersion->movie->name }}</td>

                                        @if ($i == 0)
                                            <!-- Nếu là hàng đầu tiên của nhóm, hiển thị tên phòng và ngày chiếu -->
                                            <td rowspan="{{ $rowCount }}">
                                                <b>{{ $showtime->room->cinema->name }} - {{ $showtime->room->name }}</b>
                                            </td>
                                            <td rowspan="{{ $rowCount }}">
                                                {{ \Carbon\Carbon::parse($showtime->date)->format('d-m-Y') }}
                                            </td>
                                        @endif

                                        <td>
                                            {!! $showtime->is_active == 1
                                                ? '<span class="badge bg-success-subtle text-success text-uppercase">Yes</span>'
                                                : '<span class="badge bg-danger-subtle text-danger text-uppercase">No</span>' !!}
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('admin.showtimes.show',$showtime) }}">
                                                <button title="xem" class="btn btn-success btn-sm " type="button"><i
                                                        class="fas fa-eye"></i></button></a> --}}

                                            <a href="{{ route('admin.showtimes.edit', $showtime) }}">
                                                <button title="xem" class="btn btn-warning btn-sm" type="button"><i
                                                        class="fas fa-edit"></i></button>
                                            </a>

                                            <form action="{{ route('admin.showtimes.destroy', $showtime) }}" method="post"
                                                class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn chắc chắn muốn xóa không?')">
                                                    <i class="ri-delete-bin-7-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
