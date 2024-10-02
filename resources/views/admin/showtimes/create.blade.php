@extends('admin.layouts.master')

@section('title')
    Thêm mới Suất chiếu
@endsection

@section('content')
    <form action="{{ route('admin.showtimes.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thêm mới Suất chiếu</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.showtimes.index') }}">Danh sách</a></li>
                            <li class="breadcrumb-item active ">Thêm mới</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <!-- thông tin -->
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('error'))
                    <div class="alert alert-danger m-3">
                        {{ session()->get('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm thông tin Suất chiếu</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <span class='text-danger'>*</span>
                                        <label for="title" class="form-label ">Tên phim:</label>
                                        <select name="movie_id" id="movie" class="form-select">
                                            <option value="">Chọn</option>
                                            @foreach ($movies as $item)
                                                <option value="{{ $item->id }}" @selected($item->id == old('movie_id'))>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('movie_id')
                                            <div class='mt-1'>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <span class='text-danger'>*</span>
                                        <label for="title" class="form-label ">Phiên bản phim:</label>
                                        <select name="movie_version_id" id="movie_version" class="form-select">
                                            <option value="">Chọn</option>


                                        </select>
                                        @error('movie_version_id')
                                            <div class='mt-1'>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <span class='text-danger'>*</span>
                                        <label for="title" class="form-label ">Tên Chi nhánh:</label>
                                        <select name="branch_id" id="branch" class="form-select">
                                            <option value="">Chọn</option>
                                            @foreach ($branches as $item)
                                                <option value="{{ $item->id }}" @selected($item->id == old('branch_id'))>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('cinema_id')
                                            <div class='mt-1'>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <span class='text-danger'>*</span>
                                        <label for="title" class="form-label ">Tên Rạp:</label>
                                        <select name="cinema_id" id="cinema" class="form-select">
                                            <option value="">Chọn</option>


                                        </select>
                                        @error('cinema_id')
                                            <div class='mt-1'>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <span class='text-danger'>*</span>
                                        <label for="title" class="form-label ">Tên phòng:</label>
                                        <select name="room_id" id="room" class="form-select">
                                            <option value="">Chọn</option>


                                        </select>
                                        @error('room_id')
                                            <div class='mt-1'>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <span class='text-danger'>*</span>
                                    <label for="date" class="form-label ">Ngày chiếu:</label>
                                    <input type="date" class="form-control" name="date" id="date"
                                        value="{{ old('date') }}">
                                    @error('date')
                                        <div class='mt-1'>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label"></label>
                                    <button type="button" class="btn btn-primary btn-start-time"
                                        onclick="addShowtime()">Thêm giờ
                                        chiếu</button>
                                </div>
                            </div>
                            <div class="row">
                                <div id="showtime-container">
                                    <div class="row showtime-row">

                                        <div class="col-md-4 mb-3">
                                            <span class='text-danger'>*</span>
                                            <label for="start_time" class="form-label ">Giờ chiếu:</label>
                                            <input type="time" class="form-control" name="start_time[]"
                                                id="start_time" value="{{ old('start_time') }}">
                                            @error('start_time')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- <input type="checkbox" > --}}

                                        <div class="col-md-4">
                                            <label for="end_time" class="form-label ">Giờ kết thúc:</label>
                                            <input type="time" class="form-control" name="end_time[]" id="end_time"
                                                value="{{ old('end_time') }}" readonly>
                                            @error('end_time')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">


                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-check-label" for="is_active">Is Active</label>
                                            <div class="form-check form-switch form-switch-default">
                                                <input class="form-check-input" type="checkbox" role=""
                                                    name="is_active" checked>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <label for="">Giờ chiếu đang có:</label>
                                    <table class=" table table-bordered dt-responsive nowrap align-middle">
                                        <thead>
                                            <tr>
                                                <th>Thời gian</th>
                                                <th>Phòng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < 3; $i++)
                                                <tr>
                                                    <td>12:00 - 14:00</td>
                                                    <td>Poly 01</td>
                                                </tr>
                                            @endfor

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!--end col-->
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <a href="{{ route('admin.showtimes.index') }}" class="btn btn-info">Danh sách</a>
                        <button type="submit" class="btn btn-primary mx-1">Thêm mới</button>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection


@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //Ajax select tên Rạp theo chi nhánh
        $(document).ready(function() {
            var selectedBranchId = "{{ old('branch_id', '') }}";
            var selectedCinemaId = "{{ old('cinema_id', '') }}";
            // Xử lý sự kiện thay đổi chi nhánh
            $('#branch').on('change', function() {
                var branchId = $(this).val();
                var cinemaSelect = $('#cinema');
                cinemaSelect.empty();
                cinemaSelect.append('<option value="">Chọn rạp chiếu</option>');

                if (branchId) {
                    $.ajax({
                        url: "{{ env('APP_URL') }}/api/cinemas/" + branchId,
                        method: 'GET',
                        success: function(data) {
                            $.each(data, function(index, cinema) {
                                cinemaSelect.append('<option  value="' + cinema.id +
                                    '">' + cinema.name + '</option>');
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

        // Ajax select Phòng theo tên Rạp
        $(document).ready(function() {
            var selectedCinemaId = "{{ old('cinema_id', '') }}";
            var selectedRoomId = "{{ old('room_id', '') }}";
            // Xử lý sự kiện thay đổi chi nhánh
            $('#cinema').on('change', function() {
                var cinemaId = $(this).val();
                var roomSelect = $('#room');
                roomSelect.empty();
                roomSelect.append('<option value="">Chọn phòng</option>');


                if (cinemaId) {
                    $.ajax({
                        url: "{{ env('APP_URL') }}/api/rooms/" + cinemaId,
                        method: 'GET',
                        success: function(data) {
                            // console.log(data);
                            $.each(data, function(index, room) {

                                console.log(room);
                                const roomCapacity = room.total_seats;

                                roomSelect.append('<option value="' + room.id +
                                    '" >' + room.name + ' - ' + room
                                    .type_room_name + ' - ' + roomCapacity +
                                    ' ghế </option>');


                            });
                            //
                            if (selectedRoomId) {
                                roomSelect.val(selectedRoomId);
                                selectedRoomId = false;
                            }
                        }
                    });
                }

            });



            if (selectedCinemaId) {
                $('#cinema').val(selectedCinemaId).trigger('change');
            }
        });

        // Ajax select Phiên bản phim (Vietsub, thueyets minh, lồng tiếng) theo phim
        $(document).ready(function() {
            var selectedMovieId = "{{ old('movie_id', '') }}";
            var selectedMovieVersionId = "{{ old('movie_version_id', '') }}";
            // Sự kiện thay đổi movie_id thì tên name (Bảng movie_version )thay đổi theo
            $('#movie').on('change', function() {
                var movieId = $(this).val(); //lấy giá trị của chính nó
                var movieVersionSelect = $('#movie_version');
                movieVersionSelect.empty();
                movieVersionSelect.append('<option value="">Chọn phiên bản</option>');

                if (movieId) {
                    $.ajax({
                        url: "{{ env('APP_URL') }}/api/movieVersions/" + movieId,
                        method: 'GET',
                        success: function(data) {
                            $.each(data, function(index, movieVersion) {
                                movieVersionSelect.append('<option  value="' +
                                    movieVersion
                                    .id +
                                    '">' + movieVersion.name + '</option>');
                            });
                            if (selectedMovieVersionId) {
                                movieVersionSelect.val(selectedMovieVersionId);
                                selectedMovieVersionId = false;
                            }

                        }
                    });
                }

            });
            if (selectedMovieId) {
                $('#movie').val(selectedMovieId).trigger('change');

            }
        });


        const cleaningTime = {{ $cleaningTime }}; // Thời gian dọn phòng = 15 phút
        // Ajax lấy thời lượng phim theo phim để tự động tính thời gian kết thúc chiếu
        $(document).ready(function() {
            let movieDuration = 0;

            $('#movie').on('change', function() {
                var movieId = $(this).val();
                if (movieId) {
                    $.ajax({
                        url: "{{ env('APP_URL') }}/api/getMovieDuration/" + movieId,
                        method: 'GET',
                        success: function(data) {
                            if (data.duration) {
                                movieDuration = parseInt(data.duration); // Lưu lại thời lượng
                                updateAllEndTimes(
                                    movieDuration
                                ); // Cập nhật tất cả giờ kết thúc
                            }
                        }
                    });
                }
            });

            // Cập nhật lại thời gian kết thúc khi start_time thay đổi cho hàng cụ thể
            $(document).on('change', 'input[name="start_time[]"]', function() {
                const row = $(this).closest('.showtime-row'); // Lấy hàng hiện tại
                const startTime = $(this).val();
                updateEndTimeForRow(row, movieDuration,
                    startTime); // Cập nhật lại end-time cho hàng hiện tại
            });

            // Hàm cập nhật end-time dựa trên thời lượng phim và thời gian bắt đầu cho hàng đấy
            function updateEndTimeForRow(row, duration, startTime) {
                if (startTime && duration) {
                    let [hours, minutes] = startTime.split(':'); //cắt dạng giờ : phút
                    let startTimeDate = new Date();
                    startTimeDate.setHours(parseInt(hours), parseInt(minutes)); //parseInt: địh dạng số nguyên

                    let totalMinutes = duration + cleaningTime;
                    startTimeDate.setMinutes(startTimeDate.getMinutes() + totalMinutes);

                    // Lấy thời gian kết thúc được định dạng
                    let endHours = String(startTimeDate.getHours()).padStart(2,
                        '0'); //padStart: nếu chuỗi ngắn hơn 2 ký tự, vd: 9:2 => 09:02
                    let endMinutes = String(startTimeDate.getMinutes()).padStart(2, '0');
                    const endTime = `${endHours}:${endMinutes}`;

                    // Gán giá trị end_time vào ô input
                    row.find('input[name="end_time[]"]').val(endTime); //tìm đến hàng hiện tại để cập nhật end-time
                }
            }

            // Hàm cập nhật thời gian kết thúc cho tất cả các hàng khi thay đổi thời lượng phim
            function updateAllEndTimes(duration) {
                $('input[name="start_time[]"]').each(function() {
                    const row = $(this).closest('.showtime-row');
                    const startTime = $(this).val();
                    updateEndTimeForRow(row, duration, startTime); // Cập nhật end_time cho từng hàng
                });
            }
        });

        // Thêm giao diện hàng mới cho suất chiếu
        function addShowtime() {
            var newRow = `
                <div class="row showtime-row">
                    <div class="col-md-4 mb-3">
                        <span class='text-danger'>*</span>
                        <label for="start_time" class="form-label">Giờ chiếu:</label>
                        <input type="time" class="form-control" name="start_time[]">
                    </div>
                    <div class="col-md-4">
                        <label for="end_time" class="form-label">Giờ kết thúc:</label>
                        <input type="time" class="form-control" name="end_time[]" readonly>
                    </div>
                    <div class="col-md-4 mt-4" align='left'>
                        <button type="button" class="btn btn-danger remove-btn delete-showtime">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>`;

            $('#showtime-container').append(newRow); // Thêm suất chiếu vào giao diện
        }


        $(document).on('click', '.delete-showtime', function() {
            $(this).closest('.showtime-row').remove();
        });
    </script>
@endsection
