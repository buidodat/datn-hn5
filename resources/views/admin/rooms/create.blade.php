@extends('admin.layouts.master')

@section('title')
    Thêm mới phòng chiếu
@endsection

@section('content')
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <form action="{{ route('admin.rooms.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thêm mới phòng chiếu</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.rooms.index') }}">Danh sách</a></li>
                            <li class="breadcrumb-item active">Thêm mới</li>
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
            </div>
            <div class="col-lg-9">
                <div class="card card-left">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin phòng chiếu</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div class="row ">
                                        <div class="col-md-12 mb-3">
                                            <span class='text-danger'>*</span>
                                            <label for="name" class="form-label ">Tên phòng chiếu:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}" placeholder="Poly Cinema 01">
                                            @error('name')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <span class='text-danger'>*</span>
                                            <label for="branch" class="form-label">Chi nhánh:</label>
                                            <select name="branch_id" id="branch" class="form-select">
                                                <option value="">Chọn chi nhánh</option>
                                                @foreach ($branches as $id => $name)
                                                    <option value="{{ $id }}" @selected($id == old('branch_id'))>
                                                        {{ $name }}</option>
                                                @endforeach
                                            </select>
                                            @error('branch_id')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <span class='text-danger'>*</span>
                                            <label for="cinema" class="form-label">Rạp chiếu:</label>
                                            <select name="cinema_id" id="cinema" class="form-select">
                                                <option value="">Chọn rạp chiếu</option>

                                            </select>
                                            @error('cinema_id')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <span class='text-danger'>*</span>
                                            <label for="surcharge" class="form-label ">Loại phòng chiếu:</label>
                                            <select name="type_room_id" id="" class="form-select">
                                                <option value="">Chọn loại phòng chiếu</option>
                                                @foreach ($typeRooms as $id => $name)
                                                    <option value="{{ $id }}" @selected(old('type_room_id') == $id)>
                                                        {{ $name }}</option>
                                                @endforeach
                                            </select>
                                            @error('type_room_id')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <span class='text-danger'>*</span>
                                            <label for="surcharge" class="form-label ">Sức chứa:</label>
                                            <select name="capacity" id="" class="form-select">
                                                <option value="">Chọn sức chứa</option>
                                                @foreach ($capacities as $capacity)
                                                    <option value="{{ $capacity }}" @selected(old('capacity') == $capacity)>
                                                        {{ $capacity }} chỗ ngồi</option>
                                                @endforeach
                                            </select>
                                            @error('capacity')
                                                <div class='mt-1'>
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!--end row-->
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
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card card-left">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Sơ đồ ghế</h4>
                    </div><!-- end card header -->
                    <div class="card-body ">

                            <table class="table-none align-middle mx-auto table-bordered text-center">
                                <tbody>
                                    <!-- Row A -->
                                    <tr>
                                        @for ($i =0 ; $i < 10 ; $i++)
                                            <td>
                                                <img src="{{ asset('svg/seat-regular.svg') }}" height="35px">
                                            </td>
                                        @endfor
                                        <td>
                                            <span class="btn btn-link edit-btn">
                                                <i class="fas fa-edit edit-icon"></i>
                                            </span>
                                        </td>
                                    </tr>
                                    <!-- Row B -->
                                    <tr>
                                        @for ($i =0 ; $i < 10 ; $i++)
                                            <td>
                                                <img src="{{ asset('svg/seat-vip.svg') }}" height="35px">
                                            </td>
                                        @endfor
                                        <td>
                                            <span class="btn btn-link edit-btn">
                                                <i class="fas fa-edit edit-icon"></i>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        @for ($i =0 ; $i < 5 ; $i++)
                                            <td colspan="2">
                                                <img src="{{ asset('svg/seat-double.svg') }}" height="35px" >
                                            </td>
                                        @endfor
                                        <td>
                                            <span class="btn btn-link edit-btn">
                                                <i class="fas fa-edit edit-icon"></i>
                                            </span>
                                        </td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>



                        <div class="col-md-12 w-75 mx-auto content-room-seat">

                            <div class="list-seats">
                                <div class="row justify-content-center">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="40px">
                                            <span class=" fs-5 mx-2">Ghế thường</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                            <span class=" fs-5 mx-2">Ghế Vip</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center">
                                            {{-- <div class="d-flex"> --}}
                                                <img src="{{ asset('svg/seat-double.svg') }}" class='seat' width="40px">
                                                {{-- <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                                <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px"> --}}
                                            {{-- </div> --}}
                                            <span class=" fs-5 mx-2 ">Ghế Đôi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="srceen">
                                Màn Hình Chiếu
                            </div>

                            <div class="layout-seat">
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 14; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="40px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 16; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="40px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 17; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="40px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 18; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 18; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 18; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="40px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                {{-- <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 18; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-double.svg') }}" class='seat' width="45px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div>
                                <div class='seat seat-row text-center '>
                                    @for($i = 0; $i < 18; $i++)
                                        <div class="seat-item">
                                            <img src="{{ asset('svg/seat-double.svg') }}" class='seat' width="45px">
                                            <span class="seat-label">A{{ $i+1 }}</span>
                                        </div>
                                    @endfor
                                </div> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>



        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-info">Danh sách</a>
                        <button type="submit" class="btn btn-primary mx-1">Thêm mới</button>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/mainstyle.css') }}">
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
                cinemaSelect.append('<option value="">Chọn rạp chiếu</option>');

                if (branchId) {
                    $.ajax({
                        url: "{{ env('APP_URL') }}/api/cinemas/" + branchId,
                        method: 'GET',
                        success: function(data) {
                            $.each(data, function(index, cinema) {
                                cinemaSelect.append('<option value="' + cinema.id +
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
    </script>
@endsection
