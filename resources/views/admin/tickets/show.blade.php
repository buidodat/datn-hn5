@extends('admin.layouts.master')

@section('title')
    Thông tin vé
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thông tin vé</h4>

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
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order: #{{ $ticket->id }}</h5>
                        <div class="flex-shrink-0">
                            <a href="apps-invoices-details.html" class="btn btn-success btn-sm"
                               onclick="window.print()"><i
                                    class="ri-download-2-fill align-middle me-1"></i> In hóa đơn</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                            <tr>
                                <th scope="col">Phim</th>
                                <th scope="col">Suất chiếu</th>
                                <th scope="col">Combo</th>
                                <th scope="col ">Vé</th>
                                <th scope="col" class="text-end">Giá ghế</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    @php
                                        $img = $oneTicket->ticketSeats->first();
                                        $url = $img->movie->img_thumbnail;
                                        if (!\Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }
                                    @endphp

                                    @if (!empty($img->movie->img_thumbnail))
                                        <img src="{{ $url }}" alt="Movie Thumbnail" width="50px">
                                    @else
                                        No image!
                                    @endif
                                    <b>{{ $oneTicket->ticketSeats->first()->movie->name }}</b></td>
                                <td>
                                    <p><b> {{ $oneTicket->ticketSeats->first()->showtime->cinema->name }} </b></p>
                                    <p> {{ $oneTicket->ticketSeats->first()->room->name }}</p>
                                    <p> {{ \Carbon\Carbon::parse($oneTicket->ticketSeats->first()->showtime->date)->format('d-m-Y') }}</p>
                                    <p> {{ \Carbon\Carbon::parse($oneTicket->ticketSeats->first()->showtime->start_time)->format('H:i') }}
                                        ~ {{ \Carbon\Carbon::parse($oneTicket->ticketSeats->first()->showtime->end_time)->format('H:i') }}</p>
                                </td>
                                <td>
                                    <p><b>Poly Combo 49k x 3</b></p>
                                    <p>147.000đ</p>
                                </td>
                                <td class="fw-medium align-content-start">
                                    @foreach($ticket->ticketSeats as $ticketSeat)
                                        <p class="fs-15">Ghế:
                                            <span class="link-primary">{{ $ticketSeat->seat->name }}</span>
                                        </p>
                                    @endforeach
                                    <p class="text-muted mb-0">Phân loại:
                                        <span class="fw-medium">{{ $ticketSeat->seat->typeSeat->name }}</span>
                                    </p>
                                </td>

                                <td class="fw-medium text-end align-content-start">
                                    @foreach($ticket->ticketSeats as $ticketSeat)
                                        <p class="fs-15">{{ number_format($ticketSeat->seat->typeSeat->price, 0, ',', '.') }}
                                            vnđ</p>
                                    @endforeach
                                </td>
                            </tr>
                            <tr class="border-top border-top-dashed">
                                <td colspan="4"></td>

                                <td colspan="1" class="fw-medium p-0">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                        <tr>
                                            <td>Tổng tiền :</td>
                                            <td class="text-end">{{ number_format($totalPriceSeat, 0, ',', '.') }}vnđ
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Giảm giá <span
                                                    class="text-muted">{{ $ticket->voucher_code ? '('.$ticket->voucher_code.')' : '' }}</span>:
                                            </td>
                                            <td class="text-end">{{ $ticket->voucher_discount > 0 ? '-' . number_format($ticket->voucher_discount, 0, ',', '.') . ' vnđ' : '0' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Điểm :</td>
                                            <td class="text-end">0</td>
                                        </tr>

                                        <tr class="border-top border-top-dashed">
                                            <th scope="row">Thành tiền :</th>
                                            <th class="text-end">{{ number_format($ticket->total_price, 0, ',', '.') }}
                                                vnđ
                                            </th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Trạng thái vé</h5>
                        <div class="flex-shrink-0 mt-2 mt-sm-0">
                            <a href="javascript:void(0);" class="btn btn-soft-info btn-sm mt-2 mt-sm-0"><i
                                    class="ri-map-pin-line align-middle me-1"></i> Sửa lại thông
                                tin</a>
                            <a href="javascript:void(0);" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i
                                    class="mdi mdi-archive-remove-outline align-middle me-1"></i>
                                Hủy</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingOne">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                       href="#collapseOne" aria-expanded="true"
                                       aria-controls="collapseOne">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-0 fw-semibold">Đã thanh toán - <span
                                                        class="fw-normal">{{ \Carbon\Carbon::parse($ticket->created_at)->locale('vi')->translatedFormat('l, j/n/Y - H:i') }}</span>
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">Chờ lấy vé</h6>

                                        @if($ticket->status != 'Chờ xác nhận')
                                            <p class="text-muted"></p>
                                            @if($ticket->status == 'Hoàn thành' && new DateTime() < new DateTime($ticket->expiry))
                                                <h6 class="mb-1">Đã lấy vé</h6>
                                                <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($ticket->updated_at)->locale('vi')->translatedFormat('l, j/n/Y - H:i') }}</p>
                                            @else
                                                <h6 class="mb-1">Quá hạn</h6>
                                                <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($ticket->expiry)->locale('vi')->translatedFormat('l, j/n/Y - H:i') }}</p>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @if($ticket->status !== 'Chờ xác nhận')
                                @if($ticket->status == 'Hoàn thành')
                                    <div class="accordion-item border-0">
                                        <div class="accordion-header" id="headingTwo">
                                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                               href="#collapseTwo" aria-expanded="false"
                                               aria-controls="collapseTwo">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs">
                                                        <div class="avatar-title bg-success rounded-circle">
                                                            <i class=" ri-checkbox-circle-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fs-15 mb-1 fw-semibold">Hoàn thành - <span
                                                                class="fw-normal">{{ \Carbon\Carbon::parse($ticket->updated_at)->locale('vi')->translatedFormat('l, j/n/Y - H:i') }}</span></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="accordion-item border-0">
                                        <div class="accordion-header" id="headingTwo">
                                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                               href="#collapseTwo" aria-expanded="false"
                                               aria-controls="collapseTwo">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs">
                                                        <div class="avatar-title bg-danger rounded-circle">
                                                            <i class="ri-close-circle-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fs-15 mb-1 fw-semibold">Hủy - <span class="fw-normal">{{ \Carbon\Carbon::parse($ticket->expiry)->locale('vi')->translatedFormat('l, j/n/Y - H:i') }}</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        {{--<div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body ms-2 ps-5 pt-0">
                                                <h6 class="mb-1">Your Item has been picked up by courier partner</h6>
                                                <p class="text-muted mb-0">Fri, 17 Dec 2021 - 9:45AM</p>
                                            </div>
                                        </div>--}}
                                    </div>
                                @endif
                            @endif



                            {{--<div class="accordion-item border-0">
                                <div class="accordion-header" id="headingThree">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="ri-truck-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Shipping - <span class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="fs-14">RQK Logistics - MFDS1400457854</h6>
                                        <h6 class="mb-1">Your item has been shipped.</h6>
                                        <p class="text-muted mb-0">Sat, 18 Dec 2021 - 4.54PM</p>
                                    </div>
                                </div>
                            </div>--}}
                            {{--<div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFour">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-success rounded-circle">
                                                    <i class="ri-takeaway-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-0 fw-semibold">Hủy</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFive">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFile" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-success rounded-circle">
                                                    <i class="mdi mdi-package-variant"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-0 fw-semibold">Quá hạn</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>--}}
                        </div>
                        <!--end accordion-->
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Trạng thái vé</h5>
                        <div class="flex-shrink-0">
                            <span href="javascript:void(0);"
                                  class="badge bg-primary-subtle text-primary fs-11">{{ $ticket->status }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img width="150px" src="{{ asset('theme/client/images/img-qr.png') }}"
                             alt="">
                        <p class="text-muted mb-0">Code: <b>{{ $ticket->code }}</b></p>

                    </div>
                </div>
            </div>
            <!--end card-->

            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Thông tin người đặt</h5>
                        <div class="flex-shrink-0">
                            <a href="{{ route('admin.users.show', $ticket->user->id) }}" class="link-secondary">Xem chi
                                tiết</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    @php
                                        $user = $ticket->user;
                                        $url = $user->img_thumbnail;
                                        if (!\Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }
                                    @endphp

                                    @if (!empty($user->img_thumbnail))
                                        <img src="{{ $url }}" alt="Movie Thumbnail" width="50px"
                                             class="avatar-sm rounded">
                                    @else
                                        No image!
                                    @endif
                                    {{--<img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-sm rounded">--}}
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{ $ticket->user->name }}</h6>
                                    <p class="text-muted mb-0">{{ $ticket->user->type }}</p>
                                </div>
                            </div>
                        </li>
                        <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $ticket->user->email }}
                        </li>
                        <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $ticket->user->phone }}
                        </li>
                    </ul>
                </div>
            </div>
            {{--<!--end card-->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Billing Address</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li class="fw-medium fs-14">Joseph Parker</li>
                        <li>+(256) 245451 451</li>
                        <li>2186 Joyce Street Rocky Mount</li>
                        <li>New York - 25645</li>
                        <li>United States</li>
                    </ul>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Shipping Address</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li class="fw-medium fs-14">Joseph Parker</li>
                        <li>+(256) 245451 451</li>
                        <li>2186 Joyce Street Rocky Mount</li>
                        <li>California - 24567</li>
                        <li>United States</li>
                    </ul>
                </div>
            </div>
            <!--end card-->--}}

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-secure-payment-line align-bottom me-1 text-muted"></i>Thông
                        tin thanh toán</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Transactions:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">#VLZ124561278124</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Phương thức thanh toán:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ $ticket->payment_method }}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Tên khách hàng:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ $ticket->user->name }}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Tổng tiền:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ number_format($ticket->total_price, 0, ',', '.') }} VNĐ</h6>
                        </div>
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div><!--end card-->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-info">Danh sách</a>
                    {{--<a href="{{ route('admin.tickets.edit',$ticket) }}">
                        <button type="submit" class="btn btn-warning mx-1">Chỉnh sửa</button>
                    </a>--}}

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
