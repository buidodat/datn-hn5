@extends('admin.layouts.master')

@section('title')
    Danh sách phim
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
                <h4 class="mb-sm-0">Danh sách phim</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Phim</li>
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
                    <h5 class="card-title mb-0">Danh sách phim</h5>
                    <a href="{{ route('admin.movies.create') }}" class="btn btn-primary mb-3 ">Thêm mới</a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success m-3">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-warning m-3">
                        {{ session()->get('error') }}
                    </div>
                @endif

                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Hình ảnh</th>
                                <th>Thông tin phim</th>
                                <th>Hoạt động</th>
                                <th>Tag hot</th>
                                <th>Chức năng</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movies as $movie)
                                <tr>
                                    <td>{{ $movie->id }}</td>
                                    <td class="text-center">
                                        {{-- @if ($movie->img_thumbnail && \Storage::exists($movie->img_thumbnail))
                                            <img src="{{ Storage::url($movie->img_thumbnail) }}" alt=""
                                                width="160px" >
                                        @else
                                            No image !
                                        @endif --}}

                                        @php
                                            $url = $movie->img_thumbnail;

                                            if (!\Str::contains($url, 'http')) {
                                                $url = Storage::url($url);
                                            }

                                        @endphp
                                        @if (!empty($movie->img_thumbnail))
                                            <img src="{{ $url }}" alt="" width="130px">
                                        @else
                                            No image !
                                        @endif

                                    </td>
                                    <td>
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item mb-1"><span class="fw-semibold">Tên phim:</span>
                                                {{ $movie->name }}</li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Đạo diễn:</span>
                                                {{ $movie->director }}</li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Diễn viên:</span>
                                                {{ $movie->cast }}</li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Thể loại:</span>
                                                {{ $movie->category }}</li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Ngày khởi chiếu:</span>
                                                {{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }}</li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Ngày kết thúc:</span>
                                                {{ \Carbon\Carbon::parse($movie->end_date)->format('d/m/Y') }}</li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Phân loại:</span>
                                                {{ $movie->rating }}</li>
                                            <li class="nav-item mb-1">
                                                <span class="fw-semibold">Phiên bản:</span>
                                                @foreach ($movie->movieVersions as $version)
                                                    <span class="badge bg-info">{{ $version->name }}</span>
                                                @endforeach
                                            </li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Code Youtube:</span> <input
                                                    type="text" disabled value="{{ $movie->trailer_url }}2121"></li>
                                        </ul>


                                    </td>
                                    <td>

                                        <div class="form-check form-switch form-switch-success">
                                            <input class="form-check-input switch-is-active change-is-active" name="is_active"
                                                type="checkbox" role="switch" data-id="{{ $movie->id }}"
                                                @checked($movie->is_active)
                                                onclick="return confirm('Bạn có chắc muốn thay đổi ?')" >
                                        </div>



                                    </td>
                                    <td>

                                        <div class="form-check form-switch form-switch-danger">
                                            <input class="form-check-input switch-is-active change-is-hot" name="is_hot"
                                                type="checkbox" role="switch" data-id="{{ $movie->id }}"
                                                @checked($movie->is_hot)
                                                onclick="return confirm('Bạn có chắc muốn thay đổi ?')" >
                                        </div>


                                    <td>
                                        <a href="{{ route('admin.movies.show', $movie) }}">
                                            <button title="xem" class="btn btn-success btn-sm " type="button"><i
                                                    class="fas fa-eye"></i></button></a>
                                        <a href="{{ route('admin.movies.edit', $movie) }}">
                                            <button title="xem" class="btn btn-warning btn-sm " type="button"><i
                                                    class="fas fa-edit"></i></button>
                                        </a>
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

    <script>
        $(document).ready(function() {
            $('.change-is-active').on('change', function() {
                let movieId = $(this).data('id');
                let isActive = $(this).is(':checked') ? 1 : 0;
                // Gửi yêu cầu AJAX
                $.ajax({
                    url: '{{ route('movies.update-active') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: movieId,
                        is_active: isActive
                    },
                    success: function(response) {
                        if (!response.success) {
                            alert('Có lỗi xảy ra, vui lòng thử lại.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Lỗi kết nối hoặc server không phản hồi.');
                        console.error(error);
                    }
                });
            });
        });
    </script>
     <script>
        $(document).ready(function() {
            $('.change-is-hot').on('change', function() {
                let Movie = $(this).data('id');
                let isHot = $(this).is(':checked') ? 1 : 0;
                // Gửi yêu cầu AJAX
                $.ajax({
                    url: '{{ route('movies.update-hot') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: Movie,
                        is_hot: isHot
                    },
                    success: function(response) {
                        if (!response.success) {
                            alert('Có lỗi xảy ra, vui lòng thử lại.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Lỗi kết nối hoặc server không phản hồi.');
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
