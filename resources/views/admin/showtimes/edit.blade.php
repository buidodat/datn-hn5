@extends('admin.layouts.master')

@section('title')
    Cập nhật Suất chiếu
@endsection

@section('content')
    <form action="{{ route('admin.showtimes.update', $showtime) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Cập nhật Suất chiếu</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.showtimes.index') }}">Danh sách</a></li>
                            <li class="breadcrumb-item active ">Cập nhật</li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Cập nhật thông tin Suất chiếu</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="title" class="form-label ">Tên phim:</label>
                                        <select name="movie_id" id="movie" class="form-select">
                                            <option value="">Chọn</option>
                                            @foreach ($movies as $item)
                                                <option value="{{ $item->id }}"
                                                    @if ($item->id == $showtime->movie_version->movie->id) selected @endif>{{ $item->name }}
                                                </option>
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
                                        <label for="title" class="form-label ">Phiên bản phim:</label>
                                        <select name="movie_version_id" id="movie_version" class="form-select">
                                            <option value="">Chọn</option>

                                        
                                            <option value="{{ $showtime->movie_version->id }}" selected>
                                                {{ $showtime->movie_version->name }}</option>
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
                                        <label for="title" class="form-label ">Tên Chi Nhánh:</label>
                                        <select name="branch_id" id="branch" class="form-select">
                                            <option value="">Chọn</option>
                                            @foreach ($branches as $item)
                                                <option value="{{ $item->id }}"
                                                    @if ($item->id == $showtime->room->cinema->branch->id) selected @endif>
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
                                        <label for="title" class="form-label ">Tên Rạp:</label>
                                        <select name="cinema_id" id="cinema" class="form-select">
                                            <option value="">Chọn</option>
                                            <option value="{{ $showtime->room->cinema->id }}" selected>
                                                {{ $showtime->room->cinema->name }}</option>
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
                                        <label for="title" class="form-label ">Tên phòng:</label>
                                        <select name="room_id" id="room" class="form-select">
                                            <option value="">Chọn</option>
                                            {{-- @foreach ($rooms as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach --}}
                                            <option value="{{ $showtime->room->id }}" selected>
                                                {{ $showtime->room->name }}</option>
                                            
                                        </select>
                                        @error('room_id')
                                            <div class='mt-1'>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                {{-- <div class="col-md-6">
                                  
                                </div> --}}

                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="date" class="form-label ">Ngày chiếu:</label>
                                    <input type="date" class="form-control" name="date" id="date"
                                        value="{{ $showtime->date }}">
                                    @error('date')
                                        <div class='mt-1'>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="start_time" class="form-label ">Giờ chiếu:</label>
                                    <input type="time" class="form-control" name="start_time" id="start_time"
                                        value="{{ $showtime->start_time }}">
                                    @error('start_time')
                                        <div class='mt-1'>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror

                                </div>
                                <div class="col-md-4">
                                    <label for="end_time" class="form-label ">Giờ kết thúc:</label>
                                    <input type="time" class="form-control" name="end_time" id="end_time"
                                        value="{{ $showtime->end_time }}">
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
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-md-12">

                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-check-label" for="is_active">Is Active</label>
                                            <div class="form-check form-switch form-switch-default">
                                                <input class="form-check-input" type="checkbox" role=""
                                                    name="is_active" @checked($showtime->is_active == 1)>
                                            </div>
                                        </div>
                                    </div>

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
                        <button type="submit" class="btn btn-primary mx-1">Cập nhật</button>
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
                        }
                    });
                }

            });
        });

        // Ajax select Phòng theo tên Rạp
        $(document).ready(function() {
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
                            $.each(data, function(index, room) {
                                roomSelect.append('<option  value="' + room.id +
                                    '">' + room.name + '</option>');
                            });
                        }
                    });
                }

            });
        });



        // Ajax select Phiên bản phim (Vietsub, thueyets minh, lồng tiếng) theo phim
        $(document).ready(function() {
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
                        }
                    });
                }

            });
        });


        const cleaningTime = {{ $cleaningTime }}
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
                                movieDuration = parseInt(data.duration); // Lưu lại thời lg
                                updateEndTime(
                                    movieDuration
                                ); //Gán vào hàm update end time
                            }
                        }
                    });
                }
            });

            //Cập nhật lại thời gian kết thúc khi start_time thay đổi
            $('#start_time').on('change', function() {
                updateEndTime(movieDuration); //Truyền thời lg phim 
            });


            // Chức năng cập nhật thời gian kết thúc dựa trên thời lượng phim và thời gian bắt đầu
            function updateEndTime(duration) {
                const startTime = document.getElementById('start_time').value;
                if (startTime && duration) {
                    let [hours, minutes] = startTime.split(':');
                    let startTimeDate = new Date();
                    startTimeDate.setHours(parseInt(hours), parseInt(minutes));

                    // Thêm thời lg phim và thời gian dọn dẹp (15 phút)
                    let totalMinutes = duration + cleaningTime;
                    startTimeDate.setMinutes(startTimeDate.getMinutes() + totalMinutes);

                    // Lấy thời gian kết thúc được định dạng
                    let endHours = String(startTimeDate.getHours()).padStart(2, '0');
                    let endMinutes = String(startTimeDate.getMinutes()).padStart(2, '0');
                    const endTime = `${endHours}:${endMinutes}`;

                    // Gán vào ô thời gian kết thúc
                    document.getElementById('end_time').value = endTime;
                }
            }
        });
    </script>
@endsection
