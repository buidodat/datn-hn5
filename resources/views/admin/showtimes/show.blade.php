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
                                <div class="list-seats"><span class="mdi--love-seat text-primary"></span>
                                    <span class="status-seat">Ghế đang chọn</span>
                                </div>
                                <div class="list-seats"><span class="mdi--love-seat text-blue"></span>
                                    <span class="status-seat">Ghế đang được giữ</span>
                                </div>
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
                                                    @for ($row = 0; $row < $matrixSeat['max_row']; $row++)
                                                        <tr>
                                                            {{-- <td class="box-item">
                                                                {{ chr(65 + $row) }}
                                                            </td> --}}
                                                            @for ($col = 0; $col < $matrixSeat['max_col']; $col++)
                                                                <td class="row-seat">
                                                                    @foreach ($seats as $seat)
                                                                        @if ($seat->coordinates_x === $col + 1 && $seat->coordinates_y === chr(65 + $row))
                                                                            @php
                                                                                $seatStatus = $seat->showtimes->where('id', $showtime->id)->first()->pivot->status;
                                                                            @endphp

                                                                            @if ($seat->type_seat_id == 1)
                                                                                <span
                                                                                    class="solar--sofa-3-bold seat span-seat {{ $seatStatus }}">
                                                                                            <span class="seat-label">{{ $seat->name }}</span>
                                                                                        </span>
                                                                            @endif
                                                                            @if ($seat->type_seat_id == 2)
                                                                                <span
                                                                                    class="mdi--love-seat text-muted seat span-seat {{ $seatStatus }}">
                                                                                            <span class="seat-label">{{ $seat->name }}</span>
                                                                                        </span>
                                                                            @endif
                                                                            @if ($seat->type_seat_id == 3)
                                                                                <span
                                                                                    class="game-icons--sofa seat span-seat {{ $seatStatus }}">
                                                                                            <span class="seat-label">{{ $seat->name }}</span>
                                                                                        </span>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                            @endfor

                                                        </tr>
                                                    @endfor
                                                    </tbody>
                                                </table>

                                                {{-- <div class="ghe-thuong">
                                                    <div class="row-seat">
                                                        @for ($i = 1; $i < 13; $i++)
                                                            <span class="solar--sofa-3-bold seat"
                                                                id="A{{ $i }}">
                                                                <span class="seat-label">A{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="ghe-thuong">
                                                    <div class="row-seat">
                                                        @for ($i = 1; $i < 14; $i++)
                                                            <span class="solar--sofa-3-bold seat"
                                                                id="A{{ $i }}">
                                                                <span class="seat-label">A{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>

                                                <div class="ghe-vip">
                                                    <div class="row-seat">
                                                        @for ($i = 1; $i < 15; $i++)
                                                            <span class="mdi--love-seat text-muted seat"
                                                                id="B{{ $i }}">
                                                                <span class="seat-label">B{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="ghe-vip">
                                                    <div class="row-seat">
                                                        @for ($i = 1; $i < 15; $i++)
                                                            <span class="mdi--love-seat text-muted seat"
                                                                id="B{{ $i }}">
                                                                <span class="seat-label">B{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="ghe-vip">
                                                    <div class="row-seat">
                                                        @for ($i = 1; $i < 15; $i++)
                                                            <span class="mdi--love-seat text-muted seat"
                                                                id="B{{ $i }}">
                                                                <span class="seat-label">B{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>

                                                <div class="ghe-doi">
                                                    <div class="row-seat">
                                                        @for ($i = 1; $i < 12; $i++)
                                                            <span class="game-icons--sofa seat"
                                                                id="C{{ $i }}">
                                                                <span class="seat-label">C{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="ghe-doi">
                                                    <div class="row-seat">
                                                        @for ($i = 1; $i < 13; $i++)
                                                            <span class="game-icons--sofa seat"
                                                                id="C{{ $i }}">
                                                                <span class="seat-label">C{{ $i }}</span>
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div style="display: flex;justify-content: center;">
                                            <div class="legend" style="display: flex;justify-content: space-between; width: 40%;">
                                                {{-- <div><span class="seat available"></span> Ghế trống</div> --}}
                                                <div><span class="solar--sofa-3-bold text-muted"></span> Ghế Thường</div>
                                                <div><span class="mdi--love-seat text-muted"></span> Ghế Vip</div>
                                                <div><span class="game-icons--sofa text-muted"></span> Ghế Đôi</div>
                                                {{--<div>
                                                    <p>Tổng tiền:</p>
                                                    <p class="bold">190.000đ</p>
                                                </div>
                                                <div>
                                                    <p>Thời gian còn lại:</p>
                                                    <p class="bold">9:55</p>
                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-md-12">
                            <div class="st_cherity_btn float_left">
                                <h3>SELECT TICKET TYPE</h3>
                                <ul>
                                    <li><a href="#"><i class="flaticon-tickets"></i> &nbsp;M-Ticket</a>
                                    </li>
                                    <li><a href="#"><i class="flaticon-tickets"></i> &nbsp;Box office Pickup
                                        </a>
                                    </li>
                                    <li><a href="#"><i class="flaticon-tickets"></i> &nbsp;Box office Pickup
                                    </a>
                                </li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!--end card-->

            {{--<div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                        <div class="flex-shrink-0 mt-2 mt-sm-0">
                            <a href="javascript:void(0);" class="btn btn-soft-info btn-sm mt-2 mt-sm-0"><i
                                    class="ri-map-pin-line align-middle me-1"></i> Change Address</a>
                            <a href="javascript:void(0);" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i
                                    class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel
                                Order</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingOne">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                       href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-0 fw-semibold">Order Placed - <span
                                                        class="fw-normal">Wed, 15 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">An order has been placed.</h6>
                                        <p class="text-muted">Wed, 15 Dec 2021 - 05:34PM</p>

                                        <h6 class="mb-1">Seller has processed your order.</h6>
                                        <p class="text-muted mb-0">Thu, 16 Dec 2021 - 5:48AM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingTwo">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                       href="#collapseTwo" aria-expanded="false"
                                       aria-controls="collapseTwo">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="mdi mdi-gift-outline"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Packed - <span
                                                        class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                     aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">Your Item has been picked up by courier
                                            partner</h6>
                                        <p class="text-muted mb-0">Fri, 17 Dec 2021 - 9:45AM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingThree">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                       href="#collapseThree" aria-expanded="false"
                                       aria-controls="collapseThree">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="ri-truck-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Shipping - <span
                                                        class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseThree" class="accordion-collapse collapse show"
                                     aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="fs-14">RQK Logistics - MFDS1400457854</h6>
                                        <h6 class="mb-1">Your item has been shipped.</h6>
                                        <p class="text-muted mb-0">Sat, 18 Dec 2021 - 4.54PM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFour">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                       href="#collapseFour" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div
                                                    class="avatar-title bg-light text-success rounded-circle">
                                                    <i class="ri-takeaway-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-0 fw-semibold">Out For Delivery</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFive">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                       href="#collapseFile" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div
                                                    class="avatar-title bg-light text-success rounded-circle">
                                                    <i class="mdi mdi-package-variant"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-0 fw-semibold">Delivered</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--end accordion-->
                    </div>
                </div>
            </div>--}}
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
                            <img src="{{ $url }}" alt="" width="50%">
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
                        <li><b>Độ tuổi</b>: {{ $showtime->movie->rating}}</li>
                        <li><b>Thời gian khởi chiếu</b>: {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i, d/m/Y') }}</li>
                        <li><b>Thời gian kết thúc</b>: {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i, d/m/Y') }}</li>
                        <li><b>Trạng thái</b>: {{ $showtime->movie->is_active==1 ? 'Đang bán' : 'Đã dừng'}}</li>
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
                        <li><b>Publish</b>: {{ $showtime->room->is_publish==1 ? 'Đã publish' : 'Đang chờ'}}</li>
                        <li><b>Trạng thái</b>: {{ $showtime->room->is_active==1 ? 'Hoạt động' : 'Tạm dừng'}}</li>
                        <li style="color: red;"><b>Ghế đã bán</b>: 10/150 (not work)</li>
                        <li style="color: red;"><b>Ghế hỏng</b>: 0/150 (not work)</li>
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
