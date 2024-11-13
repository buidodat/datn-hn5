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
                        <h5 class="card-title mb-0">Danh sách Suất chiếu
                            @if (Auth::user()->cinema_id != '')
                                - {{ Auth::user()->cinema->name }}
                            @endif
                        </h5>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.showtimes.index') }}" method="GET">
                                <div class="row">
                                    @if (Auth::user()->hasRole('System Admin'))
                                        <div class="col-md-3">
                                            <select name="branch_id" id="branch" class="form-select">
                                                <option value="">Chi nhánh</option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}"
                                                        {{ $branch->id == $branchId ? 'selected' : '' }}>
                                                        {{ $branch->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <select name="cinema_id" id="cinema" class="form-select"
                                                onchange="this.form.submit()">
                                                <option value="">Chọn Rạp</option>
                                                @foreach ($cinemas as $cinema)
                                                    <option value="{{ $cinema->id }}"
                                                        {{ $cinema->id == $cinemaId ? 'selected' : '' }}>
                                                        {{ $cinema->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="col-md-3">
                                        <input type="date" name="date" class="form-control"
                                            value="{{ $date }}" onchange="this.form.submit()">
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

                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap align-middle"
                        style="width:100%;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>PHIM</th>
                                <th>THỜI LƯỢNG</th>
                                <th>THỂ LOẠI</th>
                                <th>ĐỊNH DẠNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($showtimes->groupBy('movie_id', 'format') as $movieId => $showtimesByMovie)
                                @php
                                    $movie = $showtimesByMovie->first()->movie;

                                @endphp
                                <tr class="movie-row">
                                    <td class="plusShowtime">
                                        <button class="toggle-button btn btn-link"><b>+</b></button>
                                    </td>
                                    <td>
                                        <b>
                                            {{ $movie->name }}
                                        </b>
                                        @if ($movie->is_special == 1)
                                            <span class="badge bg-danger-subtle text-danger text-uppercase">Đặc biệt
                                            </span>
                                        @else
                                        @endif

                                        {{-- @if ($isSpecialMovie)
                                            <span class="badge bg-danger-subtle text-danger text-uppercase">Đặc biệt</span>
                                        @endif --}}
                                    </td>
                                    <td>{{ $movie->duration }} phút</td>
                                    <td>{{ $movie->category }}</td>
                                    <td>{{ $showtimesByMovie->first()->format }}</td>
                                </tr>

                                <tr class="showtime-row" style="display: none;">
                                    <td colspan="6" class="table-showtime-row">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th><input type="checkbox" id="select-all-{{ $movieId }}"
                                                            class="select-all-movie"></th>
                                                    <th>THỜI GIAN</th>
                                                    <th>PHÒNG</th>
                                                    <th>CHỖ NGỒI</th>
                                                    <th class="status-showtime">TRẠNG THÁI</th>
                                                    <th>CHỨC NĂNG</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($showtimesByMovie as $showtime)
                                                    <tr>
                                                        <td class="inputCheckBoxShowtimes">
                                                            <input type="checkbox"
                                                                class="select-showtime movie-{{ $movieId }}"
                                                                data-showtime-id="{{ $showtime->id }}">
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i') }}
                                                        </td>
                                                        <td>{{ $showtime->room->name }}</td>
                                                        <td>
                                                            {{ $showtime->room->seats->whereNull('deleted_at')->where('is_active', true)->count() }}
                                                            /
                                                            {{ $showtime->room->seats->whereNull('deleted_at')->count() }}
                                                        </td>
                                                        <td>
                                                            <div
                                                                class="form-check form-switch form-switch-success d-inline-block">
                                                                <input
                                                                    class="form-check-input switch-is-active changeActive"
                                                                    name="is_active" type="checkbox" role="switch"
                                                                    data-showtime-id="{{ $showtime->id }}"
                                                                    @checked($showtime->is_active)
                                                                    onclick="return confirm('Bạn có chắc muốn thay đổi ?')">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.showtimes.show', $showtime) }}">
                                                                <button title="xem" class="btn btn-success btn-sm "
                                                                    type="button"><i class="fas fa-eye"></i></button></a>

                                                            @if ($showtime->is_active == 0)
                                                                <a href="{{ route('admin.showtimes.edit', $showtime) }}">
                                                                    <button title="sửa" class="btn btn-warning btn-sm"
                                                                        type="button"><i class="fas fa-edit"></i></button>
                                                                </a>

                                                                <form
                                                                    action="{{ route('admin.showtimes.destroy', $showtime) }}"
                                                                    method="post" class="d-inline-block">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                                        onclick="return confirm('Bạn chắc chắn muốn xóa không?')">
                                                                        <i class="ri-delete-bin-7-fill"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="d-flex justify-content-between">
                                                            <form action="" method="post" class="d-inline-block">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" id="delete-all"
                                                                    class="btn btn-danger btn-sm">
                                                                    Xóa tất cả
                                                                </button>
                                                            </form>
                                                            <a href="" class="px-5">
                                                                <button id="change-status-all" title="thay đổi"
                                                                    class="btn btn-primary btn-sm">Thay đổi trạng thái tất
                                                                    cả</button>

                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    </div>
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Lấy giá trị branchId và cinemaId từ Laravel
            var selectedBranchId = "{{ old('branch_id', '') }}";
            var selectedCinemaId = "{{ old('cinema_id', '') }}";

            // Xử lý sự kiện thay đổi chi nhánh
            $('#branch').on('change', function() {
                var branchId = $(this).val();
                var cinemaSelect = $('#cinema');
                cinemaSelect.empty();
                cinemaSelect.append('<option value="">Chọn Rạp</option>');

                if (branchId) {
                    $.ajax({
                        url: "{{ env('APP_URL') }}/api/cinemas/" + branchId,
                        method: 'GET',
                        success: function(data) {
                            $.each(data, function(index, cinema) {
                                cinemaSelect.append('<option value="' + cinema.id +
                                    '" >' + cinema.name + '</option>');
                            });

                            // Chọn lại cinema nếu có selectedCinemaId
                            if (selectedCinemaId) {
                                cinemaSelect.val(selectedCinemaId);
                                selectedCinemaId = false;
                            }
                        }
                    });
                }
            });

            // Nếu có selectedBranchId thì tự động kích hoạt thay đổi chi nhánh để load danh sách cinema
            if (selectedBranchId) {
                $('#branch').val(selectedBranchId).trigger('change');

            }
        });

        $(document).ready(function() {
            $('.changeActive').on('change', function() {
                let showtimeId = $(this).data('showtime-id');
                let is_active = $(this).is(':checked') ? 1 : 0;
                // Gửi yêu cầu AJAX
                $.ajax({
                    url: '{{ route('showtimes.change-active') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: showtimeId,
                        is_active: is_active
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

        $(document).ready(function() {
            $('.toggle-button').click(function() {
                // Tìm hàng suất chiếu liền kề và chuyển đổi hiển thị
                $(this).closest('tr').next('.showtime-row').toggle();


                if ($(this).text() === '+') {
                    $(this).text('-');
                } else {
                    $(this).text('+');
                }
            });
        });



        $(document).ready(function() {
            // Chức năng chọn tất cả
            $(document).ready(function() {
                // Chức năng chọn tất cả cho từng phim
                $('.select-all-movie').on('click', function() {
                    var movieId = $(this).attr('id').split('-')[
                        2]; // Lấy movieId từ ID của checkbox
                    var isChecked = $(this).prop('checked');
                    $('.movie-' + movieId).prop('checked', isChecked);
                });

                // Kiểm tra nếu tất cả checkbox trong từng phim được chọn hoặc bỏ chọn
                $('.select-showtime').on('change', function() {
                    var movieId = $(this).attr('class').match(/movie-(\d+)/)[
                        1]; // Lấy movieId từ class
                    var allChecked = $('.movie-' + movieId).length === $('.movie-' + movieId +
                        ':checked').length;
                    $('#select-all-' + movieId).prop('checked', allChecked);
                });
            });


            $('#delete-all').on('click', function(e) {
                e.preventDefault();
                var selectedIds = [];
                $('.select-showtime:checked').each(function() {
                    selectedIds.push($(this).data('showtime-id'));
                });

                if (selectedIds.length === 0) {
                    alert('Vui lòng chọn ít nhất một suất chiếu!');
                    return;
                }

                if (confirm('Bạn chắc chắn muốn xóa tất cả các suất chiếu đã chọn?')) {
                    $.ajax({
                        url: '{{ route('showtimes.deleteSelected') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            showtime_ids: selectedIds
                        },
                        success: function(response) {
                            // Xử lý sau khi xóa thành công
                            location.reload();
                            // alert(response.message);
                        }
                    });
                }
            });
        });
    </script>
@endsection
