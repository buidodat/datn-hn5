@extends('admin.layouts.master')

@section('title')
    Chi tiết suất chiếu
@endsection

@section('styles')
    <style>
        .available {
            background-color: green;
        }

        .reserved {
            background-color: yellow;
        }

        .sold {
            background-color: red;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/mainstyle.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/responsive.css') }}"/>
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thông tin suất chiếu</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.movies.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active">Chi tiết</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- thông tin -->

    <div class="row">
        {{--Ghế--}}
        <div class="col-xl-9">
            <div class="card" style="padding: 17px 70px 62px 70px;">
                <div class="st_dtts_left_main_wrapper float_left">
                    <div class="row">
                        <div class="col-md-12 box-list-status-seat">
                            <div class="border my-3">
                                {{-- <span class="mdi--love-seat"></span> --}}
                                <div class="list-seats"><span class="mdi--love-seat text-muted"></span>
                                    <span class="status-seat">Ghế trống</span>
                                </div>
                                {{--<div class="list-seats"><span class="mdi--love-seat text-primary"></span>
                                    <span class="status-seat">Ghế đang chọn</span>
                                </div>
                                <div class="list-seats"><span class="mdi--love-seat text-blue"></span>
                                    <span class="status-seat">Ghế đang được giữ</span>
                                </div>--}}
                                <div class="list-seats"><span class="mdi--love-seat text-danger"></span>
                                    <span class="status-seat">Ghế đã bán</span>
                                </div>
                                {{-- <div class="list-seats"> <span class="mdi--love-seat text-warning"></span>
                                    <span class="status-seat">Ghế đặt trước</span>
                                </div> --}}
                            </div>
                            <div class="">
                                <div>
                                    <div class="container-screen">

                                        <div class="container-detail-seat">
                                            <div class="screen">Màn Hình Chiếu</div>
                                            <div class="seat-selection">
                                                <table class="table-seat">
                                                    <tbody>
                                                    @for ($row = 0; $row < $matrix['max_row']; $row++)
                                                        <tr>
                                                            <td class="box-item">
                                                                {{ chr(65 + $row) }}
                                                            </td>
                                                            @for ($col = 0; $col < $matrix['max_col']; $col++)
                                                                @php
                                                                    $skipNextCol = false;
                                                                    // Kiểm tra xem ô hiện tại có phải là ô bị skip không
                                                                    $isSkipped = false;
                                                                    if ($col > 0) {
                                                                        foreach ($seats as $checkSeat) {
                                                                            if ($checkSeat->coordinates_x === $col &&
                                                                                $checkSeat->coordinates_y === chr(65 + $row) &&
                                                                                $checkSeat->type_seat_id == 3) {
                                                                                $isSkipped = true;
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp

                                                                @if (!$isSkipped)
                                                                    <td class="box-item"
                                                                        @foreach ($seats as $seat)
                                                                            @if ($seat->coordinates_x === $col + 1 && $seat->coordinates_y === chr(65 + $row))
                                                                                @if ($seat->type_seat_id == 3)
                                                                                    colspan="2"
                                                                        @php $skipNextCol = true; @endphp
                                                                        @endif
                                                                        @endif
                                                                        @endforeach >

                                                                        @foreach ($seats as $seat)
                                                                            @if ($seat->coordinates_x === $col + 1 && $seat->coordinates_y === chr(65 + $row))
                                                                                @if ($seat->type_seat_id == 1)
                                                                                    @if (in_array($seat->id, $soldSeats))
                                                                                        <div class="seat-item">
                                                                                            <span class="seat-regular-svg text-danger"></span>
                                                                                            <span class="seat-label text-white">{{ $seat->name }}</span>
                                                                                        </div>
                                                                                    @else
                                                                                    <div class="seat-item">
                                                                                        <img
                                                                                            src="{{ $seat->is_active == 1 ? asset('svg/seat-regular.svg') : asset('svg/seat-regular-broken.svg') }}"
                                                                                            width="100%">
                                                                                        <span class="seat-label">{{ $seat->name }}</span>
                                                                                    </div>
                                                                                    @endif
                                                                                @elseif($seat->type_seat_id == 2)
                                                                                    @if (in_array($seat->id, $soldSeats))
                                                                                        <div class="seat-item">
                                                                                            <span class="seat-regular-svg text-danger"></span>
                                                                                            <span class="seat-label text-white">{{ $seat->name }}</span>
                                                                                        </div>
                                                                                    @else
                                                                                    <div class="seat-item">
                                                                                        <img
                                                                                            src="{{ $seat->is_active == 1  ? asset('svg/seat-vip.svg') : asset('svg/seat-vip-broken.svg') }}"
                                                                                            width="100%">
                                                                                        <span class="seat-label">{{ $seat->name }}</span>
                                                                                    </div>
                                                                                    @endif
                                                                                @elseif($seat->type_seat_id == 3)
                                                                                    @if (in_array($seat->id, $soldSeats))
                                                                                        <div class="seat-item">
                                                                                            <span class="seat-regular-svg text-danger"></span>
                                                                                            <span class="seat-label text-white">{{ $seat->name }}</span>
                                                                                        </div>
                                                                                    @else
                                                                                    <div class="seat-item">
                                                                                        <img
                                                                                            src="{{ $seat->is_active == 1 ? asset('svg/seat-double.svg') : asset('svg/seat-double-broken.svg') }}"
                                                                                            width="100%">
                                                                                        <span class="seat-label-double text-center">{{ chr(65 + $row) . ($col + 1) }}
                                                                                            {{ chr(65 + $row) . ($col + 2) }}</span>
                                                                                    </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                @endif
                                                            @endfor
                                                        </tr>
                                                    @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div style="display: flex;justify-content: center;">
                                            <div class="legend" style="display: flex;justify-content: space-between;">
                                                <div><span class="solar--sofa-3-bold text-muted"></span> Ghế Thường</div>
                                                <div><span class="mdi--love-seat text-muted"></span> Ghế Vip</div>
                                                <div><span class="game-icons--sofa text-muted"></span> Ghế Đôi</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>

        <!--Chi tiết phim-->
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0"><i
                                class=" ri-film-line align-middle me-1 text-muted"></i>{{ $showtime->movie->name}}</h5>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);"
                               class="badge bg-primary-subtle text-primary fs-11">{{ $showtime->movieVersion->name}}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $url = $showtime->movie->img_thumbnail;

                        if (!\Str::contains($url, 'http')) {
                            $url = Storage::url($url);
                        }
                    @endphp
                    @if($showtime->movie->img_thumbnail)
                        <div class="text-center mt-2">
                            <img src="{{ $url }}" alt="" width="30%">
                        </div>
                    @else
                        No image !
                    @endif

                </div>
            </div>
            <!--end card-->

            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Thông tin phim</h5>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li><b>Thể loại</b>: {{ $showtime->movie->category}}</li>
                        <li><b>Thời lượng</b>: {{$showtime->movie->duration}} phút</li>
                        <li><b>Định dạng</b>: {{ $showtime->format}}</li>
                        <li><b>Độ tuổi:</b> {{ $showtime->movie->rating }} - {{ $showtime->movie->getRatingByName($showtime->movie->rating)['description'] }}</li>
                        <li><b>Khởi chiếu</b>: {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }} ~  {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i') }} ( {{ \Carbon\Carbon::parse($showtime->start_time)->format('d/m/Y') }} )</li>
                        <li><b>Trạng thái</b>: {{ $showtime->movie->is_active == 1 ? 'Đang bán' : 'Đã dừng'}}</li>
                    </ul>
                </div>
            </div>
            <!--end card-->

            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Thông tin phòng</h5>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li><b>Phòng</b>: {{ $showtime->room->name}}</li>
                        <li><b>Rạp</b>: {{$showtime->room->cinema->name}} </li>
                        <li><b>Trạng thái</b>: {{ $showtime->is_active == 1 ? 'Hoạt động' : 'Tạm dừng'}}</li>
                        {{--<li style="color: red;"><b>Ghế đã bán</b>: 10/150 (not work)</li>
                        <li style="color: red;"><b>Ghế hỏng</b>: 0/150 (not work)</li>--}}
                    </ul>
                </div>
            </div>
            <!--end card-->

        </div>
        <!--end col-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <a href="{{ route('admin.showtimes.index') }}" class="btn btn-info">Danh sách</a>
                    <a href="{{ route('admin.showtimes.edit', $showtime) }}">
                        <button type="submit" class="btn btn-warning mx-1">Chỉnh sửa</button>
                    </a>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>

@endsection

@section('style-libs')
    <!-- App favicon -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css"/>
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/select2.init.js') }}"></script>
    <script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("content", {
            width: "100%",
            height: "750px"
        });
    </script>

@endsection
