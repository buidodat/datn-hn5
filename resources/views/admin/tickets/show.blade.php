@extends('admin.layouts.master')

@section('title')
    Thông tin vé
@endsection
@section('style-libs')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        .ticket-container1 {
            width: 300px;
            background-color: #ffe5e5;
            padding: 15px;
            border-radius: 5px;
        }
        .ticket-container2 {
            width: 300px;
            background-color: #ffe5e5;
            padding: 15px;
            border-radius: 5px;
        }
        .ticket-container3 {
            width: 300px;
            background-color: #ffe5e5;
            padding: 15px;
            border-radius: 5px;
        }

        .ticket-header {
            text-align: center;
            margin-bottom: 10px;
        }

        .ticket-header h2 {
            font-size: 18px;
            font-weight: bold;
            color: #d63384;
        }

        .ticket-info {
            font-size: 14px;
        }

        .ticket-info p {
            margin-bottom: 5px;
        }

        .ticket-info strong {
            font-weight: bold;
        }

        .ticket-info .highlight {
            font-weight: bold;
            color: #d63384;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .ticket-container1, .ticket-container1 * {
                visibility: visible;
            }
            .ticket-container2, .ticket-container2 * {
                visibility: visible;
            }
            .ticket-container3, .ticket-container3 * {
                visibility: visible;
            }

            .ticket-container1 {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%; /* Chiếm toàn bộ chiều rộng trang in */
                margin: 0; /* Loại bỏ lề */
                border: none; /* Loại bỏ viền */
                box-shadow: none; /* Loại bỏ bóng */
            }
            .ticket-container2 {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%; /* Chiếm toàn bộ chiều rộng trang in */
                margin: 0; /* Loại bỏ lề */
                border: none; /* Loại bỏ viền */
                box-shadow: none; /* Loại bỏ bóng */
            }
            .ticket-container3 {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%; /* Chiếm toàn bộ chiều rộng trang in */
                margin: 0; /* Loại bỏ lề */
                border: none; /* Loại bỏ viền */
                box-shadow: none; /* Loại bỏ bóng */
            }

            @page {
                size: auto; /*  Tự động điều chỉnh khổ giấy */
                margin: 10mm; /* Lề 10mm cho tất cả các cạnh */
            }

            .no-print {
                display: none;
            }
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thông tin hóa đơn</h4>

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
                        <h5 class="card-title flex-grow-1 mb-0"></h5>

                        <div class="flex-shrink-0">
                            <!-- Static Backdrop -->
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="ri-download-2-fill align-middle me-1"></i> In vé
                            </button>
                            <!-- staticBackdrop Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                 role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body text-center p-5">
                                            <div class="mt-4">
                                                <h4 class="mb-3">Xác nhận in vé</h4>
                                                <p class="text-muted mb-4"> Vui lòng xác nhận khi truy cập vào trang in vé</p>
                                                <div class="hstack gap-2 justify-content-center">
                                                    <a href="{{ route('admin.tickets.print', $ticket) }}" id="confirmPrintBtn" class="btn btn-success">Xác
                                                        nhận</a>
                                                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium"
                                                       data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Hủy</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--<div class="flex-shrink-0">
                            <!-- Button to open modal -->
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="ri-download-2-fill align-middle me-1"></i> In vé modal
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                 role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body text-center p-5">
                                            <div class="d-flex justify-content-around">
                                                <div class="ticket-container1">
                                                    <div>
                                                        <div class="flex-shrink-0 no-print">
                                                            <button onclick="window.print()" class="btn btn-success btn-sm">
                                                                <i class="ri-download-2-fill align-middle me-1"></i> In hóa đơn
                                                            </button>
                                                        </div>

                                                        --}}{{-- Header Information --}}{{--
                                                        <div class="ticket-header">
                                                            <h2>Hóa đơn chi tiết</h2>
                                                        </div>

                                                        --}}{{-- Company Information --}}{{--
                                                        <div class="ticket-info border-bottom-dashed">
                                                            <p><strong>Chi nhánh công ty Poly Cinemas vietnam tại {{ $ticket->cinema->branch->name }}</strong></p>
                                                            <p>Địa chỉ: 1 Quang Trung - {{ $ticket->cinema->name }} - {{ $ticket->cinema->branch->name }}</p>
                                                            <p>mst: 012147901412</p>
                                                        </div>

                                                        --}}{{-- Cinema Information --}}{{--
                                                        <div class="ticket-info border-bottom-dashed mt-2">
                                                            <p><strong>Poly Cinemas {{ $ticket->cinema->name }} - {{ $ticket->cinema->branch->name }}</strong></p>
                                                            <p>Thời gian: {{ $ticket->ticketSeats->first()->showtime->start_time }}</p>
                                                        </div>

                                                        --}}{{-- Movie Information --}}{{--
                                                        <div class="ticket-info border-bottom-dashed mt-2">
                                                            <p><strong>{{ $ticket->movie->name }} ({{ $ticket->movie->movieVersions->first()->name }})</strong></p>
                                                            <p>
                                                                <strong>
                                                                    {{ $ticket->movie->rating }}
                                                                    @if($ratingDescription)
                                                                        <span>({{ $ratingDescription }})</span>
                                                                    @endif
                                                                </strong>
                                                            </p>
                                                            <p><strong>Phòng:</strong> {{ $ticket->room->name }}</p>
                                                            <p><strong>Ghế:</strong> {{ $ticket->ticketSeats->pluck('seat.name')->implode(', ') }}</p>
                                                        </div>

                                                        --}}{{-- Combo Information --}}{{--
                                                        @if($ticket->ticketCombos->isNotEmpty())
                                                            <div class="ticket-info border-bottom-dashed mt-2">
                                                                @foreach($ticket->ticketCombos as $ticketCombo)
                                                                    <p>
                                                                        <strong>
                                                                            {{ $ticketCombo->combo->name }} x {{ $ticketCombo->quantity }}
                                                                            ({{ number_format($ticketCombo->combo->price * $ticketCombo->quantity) }} vnđ)
                                                                        </strong>
                                                                    </p>
                                                                    <ul>
                                                                        @foreach($ticketCombo->combo->food as $food)
                                                                            <li>{{ $food->name }} x {{ $food->pivot->quantity }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endforeach
                                                            </div>
                                                        @endif

                                                        --}}{{-- Price Summary --}}{{--
                                                        <div class="ticket-info mt-2">
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Giá vé:</strong></span>
                                                                <span><strong>{{ number_format($totalPriceSeat, 0, ',', '.') }} VND</strong></span>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Giá combo:</strong></span>
                                                                <span><strong>{{ number_format($totalComboPrice, 0, ',', '.') }} VND</strong></span>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Giảm giá:</strong></span>
                                                                <span><strong>{{ number_format($ticket->voucher_discount, 0, ',', '.') }} VND</strong></span>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Thành tiền:</strong></span>
                                                                <span><strong>{{ number_format($ticket->total_price, 0, ',', '.') }} VND</strong></span>
                                                            </div>
                                                        </div>

                                                        --}}{{-- Barcode --}}{{--
                                                        <div class="mt-4 border-top-double">
                                                            <div class="d-flex justify-content-center mt-2">{!! $barcode !!}</div>
                                                            <div class="d-flex justify-content-center">
                                                                <p><strong>{{ $ticket->code }}</strong></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="ticket-container2">
                                                    <div>
                                                        <div class="flex-shrink-0 no-print">
                                                            @if($ticket->status == 'Đã suất vé')
                                                                <a href="#" class="btn btn-success btn-sm"
                                                                   onclick="window.print()"><i
                                                                        class="ri-download-2-fill align-middle me-1"></i> In hóa đơn</a>
                                                            @endif
                                                        </div>
                                                        <div class="ticket-header">
                                                            <h2>HÓA ĐƠN ĐỒ ĂN</h2>
                                                        </div>
                                                        <div class="ticket-info border-bottom-dashed">
                                                            <p><strong>Chi nhánh công ty Poly Cinemas vietnam tại {{ $ticket->cinema->branch->name }}</strong></p>
                                                            <p>Địa chỉ: 1 Quang Trung - {{ $ticket->cinema->name }} - {{ $ticket->cinema->branch->name }}</p>
                                                            <p>mst: 012147901412</p>
                                                        </div>
                                                        <div class="ticket-info border-bottom-dashed mt-2">
                                                            <p><strong>Poly Cinemas {{ $ticket->cinema->name }} - {{ $ticket->cinema->branch->name }}  </strong></p>
                                                            <p>Thời gian: {{ $ticket->ticketCombos->first()->created_at }}</p>
                                                        </div>
                                                        <div class="ticket-info border-bottom-dashed mt-2">
                                                            @foreach ($ticket->ticketCombos as $ticketCombo)
                                                                @php
                                                                    $combo = $ticketCombo->combo;
                                                                @endphp

                                                                <p><b>{{ $combo->name }} x {{ $ticketCombo->quantity }}
                                                                        ( {{ number_format($combo->price * $ticketCombo->quantity) }}
                                                                        vnđ )</b></p>

                                                                <ul>
                                                                    @foreach ($combo->food as $food)
                                                                        <li>{{ $food->name }} x {{ $food->pivot->quantity }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @endforeach
                                                        </div>
                                                        <div class="ticket-info mt-2">
                                                            <p><strong>Tổng cộng:</strong> {{ number_format($ticket->ticketCombos->sum(function ($ticketCombo) {
                return $ticketCombo->combo->price * $ticketCombo->quantity;
            }), 0, ',', '.') }} vnđ</p>

                                                        </div>
                                                        <div class="mt-4 border-top-double">
                                                            <div class="d-flex justify-content-center mt-2">{!! $barcode !!}</div>
                                                            <div class="d-flex justify-content-center">
                                                                <p><strong>{{ $ticket->code }}</strong></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="ticket-container3">
                                                    <div>
                                                        <div class="flex-shrink-0 no-print">
                                                            <a href="#" class="btn btn-success btn-sm"
                                                               onclick="window.print()"><i
                                                                    class="ri-download-2-fill align-middle me-1"></i> In hóa đơn</a>
                                                        </div>
                                                        <div class="ticket-header">
                                                            <h2>Hóa đơn vé</h2>
                                                        </div>
                                                        <div class="ticket-info border-bottom-dashed">
                                                            <p><strong>Chi nhánh công ty Poly Cinemas vietnam tại {{ $ticket->cinema->branch->name }}</strong></p>
                                                            <p>Địa chỉ: 1 Quang Trung - {{ $ticket->cinema->name }} - {{ $ticket->cinema->branch->name }}</p>
                                                            <p>mst: 012147901412</p>
                                                        </div>
                                                        <div class="ticket-info border-bottom-dashed mt-2">
                                                            <p><strong>Poly Cinemas {{ $ticket->cinema->name }} - {{ $ticket->cinema->branch->name }}  </strong></p>
                                                            <p>Thời gian: {{ $ticket->ticketSeats->first()->showtime->start_time }}</p>
                                                        </div>
                                                        <div class="ticket-info border-bottom-dashed mt-2">
                                                            <p><strong>{{ $ticket->movie->name }} ({{ $ticket->movie->movieVersions->first()->name }})</strong></p>
                                                            @php
                                                                $rating = $ticket->movie->rating;
                                                                $description = null;

                                                                if ($rating == 'P') {
                                                                    $description = 'Mọi độ tuổi';
                                                                } elseif ($rating == 'T13') {
                                                                    $description = 'Dưới 13 tuổi và có người bảo hộ đi kèm';
                                                                } elseif ($rating == 'T16') {
                                                                    $description = '13+';
                                                                } elseif ($rating == 'T18') {
                                                                    $description = '16+';
                                                                } elseif ($rating == 'K') {
                                                                    $description = '18+';
                                                                }
                                                            @endphp
                                                            <p><strong>{{ $ticket->movie->rating }} @if ($description)
                                                                        <span>({{ $description }})</span>
                                                                    @endif</strong></p>


                                                            <p><strong>Phòng:</strong> {{ $ticket->room->name }}</p>
                                                            <p><strong>Ghế:</strong>
                                                                {{ implode(', ', $ticket->ticketSeats->pluck('seat.name')->toArray()) }}
                                                            </p>
                                                        </div>
                                                        <div class="ticket-info border-bottom-dashed mt-2">
                                                            @foreach ($ticket->ticketCombos as $ticketCombo)
                                                                @php
                                                                    $combo = $ticketCombo->combo;
                                                                @endphp

                                                                <p><b>{{ $combo->name }} x {{ $ticketCombo->quantity }}
                                                                        ( {{ number_format($combo->price * $ticketCombo->quantity) }}
                                                                        vnđ )</b></p>

                                                                <ul>
                                                                    @foreach ($combo->food as $food)
                                                                        <li>{{ $food->name }} x {{ $food->pivot->quantity }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @endforeach
                                                        </div>

                                                        <div class="ticket-info mt-2">
                                                            <div class="d-flex justify-content-between">
                    <span>
                        <strong>Giá vé:</strong>
                    </span>
                                                                <span><strong>{{ number_format($ticket->total_price, 0, ',', '.') }} VND</strong></span>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                    <span>
                        <strong>Giá combo:</strong>
                    </span>
                                                                <span><strong>{{ number_format($ticket->ticketCombos->sum(function ($ticketCombo) {
                return $ticketCombo->combo->price * $ticketCombo->quantity;
            }), 0, ',', '.') }} VND</strong></span>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Giảm giá:</strong> </span>
                                                                <span><strong>{{ number_format($ticket->voucher_discount, 0, ',', '.') }} VND</strong></span>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span><strong>Thành tiền:</strong> </span>
                                                                <span><strong>{{ number_format($ticket->price, 0, ',', '.') }} VND</strong></span>
                                                            </div>
                                                        </div>

                                                        <div class="mt-4 border-top-double">
                                                            <div class="d-flex justify-content-center mt-2">{!! $barcode !!}</div>
                                                            <div class="d-flex justify-content-center">
                                                                <p><strong>{{ $ticket->code }}</strong></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Ticket Details End -->

                                            <div class="hstack gap-2 justify-content-center mt-3">
                                                <button class="btn btn-success" onclick="window.print()">Xác nhận in</button>
                                                <button class="btn btn-link link-success fw-medium" data-bs-dismiss="modal">
                                                    <i class="ri-close-line me-1 align-middle"></i> Hủy
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>--}}

                        <!-- Toggle Between Modals -->
                        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#firstmodal">In vé</button>
                        <!-- First modal dialog -->
                        <div class="modal fade" id="firstmodal" aria-hidden="true" aria-labelledby="..." tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">
                                        <lord-icon
                                            src="https://cdn.lordicon.com/tdrtiskw.json"
                                            trigger="loop"
                                            colors="primary:#f7b84b,secondary:#405189"
                                            style="width:130px;height:130px">
                                        </lord-icon>
                                        <div class="mt-4 pt-4">
                                            <h4>Xác nhận in vé!</h4>
                                            <p class="text-muted"> Xác nhận sẽ thay đổi trạng thái.</p>
                                            <!-- Toogle to second dialog -->
                                            <button class="btn btn-warning" data-bs-target="#secondmodal" data-bs-toggle="modal" data-bs-dismiss="modal">
                                                Xác nhận
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Second modal dialog -->
                        <div class="modal fade" id="secondmodal" aria-hidden="true" aria-labelledby="..." tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">
                                        <div class="d-flex justify-content-around">
                                            <div class="ticket-container1">
                                                <div>
                                                    <div class="flex-shrink-0 no-print">
                                                        <button onclick="window.print()" class="btn btn-success btn-sm">
                                                            <i class="ri-download-2-fill align-middle me-1"></i> In hóa đơn
                                                        </button>
                                                    </div>

 Header Information

                                                    <div class="ticket-header">
                                                        <h2>Hóa đơn chi tiết</h2>
                                                    </div>

 Company Information

                                                    <div class="ticket-info border-bottom-dashed">
                                                        <p><strong>Chi nhánh công ty Poly Cinemas vietnam tại {{ $ticket->cinema->branch->name }}</strong></p>
                                                        <p>Địa chỉ: 1 Quang Trung - {{ $ticket->cinema->name }} - {{ $ticket->cinema->branch->name }}</p>
                                                        <p>mst: 012147901412</p>
                                                    </div>

 Cinema Information

                                                    <div class="ticket-info border-bottom-dashed mt-2">
                                                        <p><strong>Poly Cinemas {{ $ticket->cinema->name }} - {{ $ticket->cinema->branch->name }}</strong></p>
                                                        <p>Thời gian: {{ $ticket->ticketSeats->first()->showtime->start_time }}</p>
                                                    </div>

 Movie Information

                                                    <div class="ticket-info border-bottom-dashed mt-2">
                                                        <p><strong>{{ $ticket->movie->name }} ({{ $ticket->movie->movieVersions->first()->name }})</strong></p>
                                                        <p>
                                                            <strong>
                                                                {{ $ticket->movie->rating }}
                                                                @if($ratingDescription)
                                                                    <span>({{ $ratingDescription }})</span>
                                                                @endif
                                                            </strong>
                                                        </p>
                                                        <p><strong>Phòng:</strong> {{ $ticket->room->name }}</p>
                                                        <p><strong>Ghế:</strong> {{ $ticket->ticketSeats->pluck('seat.name')->implode(', ') }}</p>
                                                    </div>

 Combo Information

                                                    @if($ticket->ticketCombos->isNotEmpty())
                                                        <div class="ticket-info border-bottom-dashed mt-2">
                                                            @foreach($ticket->ticketCombos as $ticketCombo)
                                                                <p>
                                                                    <strong>
                                                                        {{ $ticketCombo->combo->name }} x {{ $ticketCombo->quantity }}
                                                                        ({{ number_format($ticketCombo->combo->price * $ticketCombo->quantity) }} vnđ)
                                                                    </strong>
                                                                </p>
                                                                <ul>
                                                                    @foreach($ticketCombo->combo->food as $food)
                                                                        <li>{{ $food->name }} x {{ $food->pivot->quantity }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @endforeach
                                                        </div>
                                                    @endif

 Price Summary

                                                    <div class="ticket-info mt-2">
                                                        <div class="d-flex justify-content-between">
                                                            <span><strong>Giá vé:</strong></span>
                                                            <span><strong>{{ number_format($totalPriceSeat, 0, ',', '.') }} VND</strong></span>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span><strong>Giá combo:</strong></span>
                                                            <span><strong>{{ number_format($totalComboPrice, 0, ',', '.') }} VND</strong></span>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span><strong>Giảm giá:</strong></span>
                                                            <span><strong>{{ number_format($ticket->voucher_discount, 0, ',', '.') }} VND</strong></span>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span><strong>Thành tiền:</strong></span>
                                                            <span><strong>{{ number_format($ticket->total_price, 0, ',', '.') }} VND</strong></span>
                                                        </div>
                                                    </div>

 Barcode

                                                    <div class="mt-4 border-top-double">
                                                        <div class="d-flex justify-content-center mt-2">{!! $barcode !!}</div>
                                                        <div class="d-flex justify-content-center">
                                                            <p><strong>{{ $ticket->code }}</strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="ticket-container2">
                                                <div>
                                                    <div class="flex-shrink-0 no-print">
                                                        @if($ticket->status == 'Đã suất vé')
                                                            <a href="#" class="btn btn-success btn-sm"
                                                               onclick="window.print()"><i
                                                                    class="ri-download-2-fill align-middle me-1"></i> In hóa đơn</a>
                                                        @endif
                                                    </div>
                                                    <div class="ticket-header">
                                                        <h2>HÓA ĐƠN ĐỒ ĂN</h2>
                                                    </div>
                                                    <div class="ticket-info border-bottom-dashed">
                                                        <p><strong>Chi nhánh công ty Poly Cinemas vietnam tại {{ $ticket->cinema->branch->name }}</strong></p>
                                                        <p>Địa chỉ: 1 Quang Trung - {{ $ticket->cinema->name }} - {{ $ticket->cinema->branch->name }}</p>
                                                        <p>mst: 012147901412</p>
                                                    </div>
                                                    <div class="ticket-info border-bottom-dashed mt-2">
                                                        <p><strong>Poly Cinemas {{ $ticket->cinema->name }} - {{ $ticket->cinema->branch->name }}  </strong></p>
                                                        <p>Thời gian: {{ $ticket->ticketCombos->first()->created_at }}</p>
                                                    </div>
                                                    <div class="ticket-info border-bottom-dashed mt-2">
                                                        @foreach ($ticket->ticketCombos as $ticketCombo)
                                                            @php
                                                                $combo = $ticketCombo->combo;
                                                            @endphp

                                                            <p><b>{{ $combo->name }} x {{ $ticketCombo->quantity }}
                                                                    ( {{ number_format($combo->price * $ticketCombo->quantity) }}
                                                                    vnđ )</b></p>

                                                            <ul>
                                                                @foreach ($combo->food as $food)
                                                                    <li>{{ $food->name }} x {{ $food->pivot->quantity }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endforeach
                                                    </div>
                                                    <div class="ticket-info mt-2">
                                                        <p><strong>Tổng cộng:</strong> {{ number_format($ticket->ticketCombos->sum(function ($ticketCombo) {
                return $ticketCombo->combo->price * $ticketCombo->quantity;
            }), 0, ',', '.') }} vnđ</p>

                                                    </div>
                                                    <div class="mt-4 border-top-double">
                                                        <div class="d-flex justify-content-center mt-2">{!! $barcode !!}</div>
                                                        <div class="d-flex justify-content-center">
                                                            <p><strong>{{ $ticket->code }}</strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="ticket-container3">
                                                <div>
                                                    <div class="flex-shrink-0 no-print">
                                                        <a href="#" class="btn btn-success btn-sm"
                                                           onclick="window.print()"><i
                                                                class="ri-download-2-fill align-middle me-1"></i> In hóa đơn</a>
                                                    </div>
                                                    <div class="ticket-header">
                                                        <h2>Hóa đơn vé</h2>
                                                    </div>
                                                    <div class="ticket-info border-bottom-dashed">
                                                        <p><strong>Chi nhánh công ty Poly Cinemas vietnam tại {{ $ticket->cinema->branch->name }}</strong></p>
                                                        <p>Địa chỉ: 1 Quang Trung - {{ $ticket->cinema->name }} - {{ $ticket->cinema->branch->name }}</p>
                                                        <p>mst: 012147901412</p>
                                                    </div>
                                                    <div class="ticket-info border-bottom-dashed mt-2">
                                                        <p><strong>Poly Cinemas {{ $ticket->cinema->name }} - {{ $ticket->cinema->branch->name }}  </strong></p>
                                                        <p>Thời gian: {{ $ticket->ticketSeats->first()->showtime->start_time }}</p>
                                                    </div>
                                                    <div class="ticket-info border-bottom-dashed mt-2">
                                                        <p><strong>{{ $ticket->movie->name }} ({{ $ticket->movie->movieVersions->first()->name }})</strong></p>
                                                        @php
                                                            $rating = $ticket->movie->rating;
                                                            $description = null;

                                                            if ($rating == 'P') {
                                                                $description = 'Mọi độ tuổi';
                                                            } elseif ($rating == 'T13') {
                                                                $description = 'Dưới 13 tuổi và có người bảo hộ đi kèm';
                                                            } elseif ($rating == 'T16') {
                                                                $description = '13+';
                                                            } elseif ($rating == 'T18') {
                                                                $description = '16+';
                                                            } elseif ($rating == 'K') {
                                                                $description = '18+';
                                                            }
                                                        @endphp
                                                        <p><strong>{{ $ticket->movie->rating }} @if ($description)
                                                                    <span>({{ $description }})</span>
                                                                @endif</strong></p>


                                                        <p><strong>Phòng:</strong> {{ $ticket->room->name }}</p>
                                                        <p><strong>Ghế:</strong>
                                                            {{ implode(', ', $ticket->ticketSeats->pluck('seat.name')->toArray()) }}
                                                        </p>
                                                    </div>
                                                    <div class="ticket-info border-bottom-dashed mt-2">
                                                        @foreach ($ticket->ticketCombos as $ticketCombo)
                                                            @php
                                                                $combo = $ticketCombo->combo;
                                                            @endphp

                                                            <p><b>{{ $combo->name }} x {{ $ticketCombo->quantity }}
                                                                    ( {{ number_format($combo->price * $ticketCombo->quantity) }}
                                                                    vnđ )</b></p>

                                                            <ul>
                                                                @foreach ($combo->food as $food)
                                                                    <li>{{ $food->name }} x {{ $food->pivot->quantity }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endforeach
                                                    </div>

                                                    <div class="ticket-info mt-2">
                                                        <div class="d-flex justify-content-between">
                    <span>
                        <strong>Giá vé:</strong>
                    </span>
                                                            <span><strong>{{ number_format($ticket->total_price, 0, ',', '.') }} VND</strong></span>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                    <span>
                        <strong>Giá combo:</strong>
                    </span>
                                                            <span><strong>{{ number_format($ticket->ticketCombos->sum(function ($ticketCombo) {
                return $ticketCombo->combo->price * $ticketCombo->quantity;
            }), 0, ',', '.') }} VND</strong></span>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span><strong>Giảm giá:</strong> </span>
                                                            <span><strong>{{ number_format($ticket->voucher_discount, 0, ',', '.') }} VND</strong></span>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span><strong>Thành tiền:</strong> </span>
                                                            <span><strong>{{ number_format($ticket->price, 0, ',', '.') }} VND</strong></span>
                                                        </div>
                                                    </div>

                                                    <div class="mt-4 border-top-double">
                                                        <div class="d-flex justify-content-center mt-2">{!! $barcode !!}</div>
                                                        <div class="d-flex justify-content-center">
                                                            <p><strong>{{ $ticket->code }}</strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hstack gap-2 justify-content-center mt-3">
                                            <button class="btn btn-success" onclick="window.print()">Xác nhận in</button>
                                            <button class="btn btn-link link-success fw-medium" data-bs-dismiss="modal">
                                                <i class="ri-close-line me-1 align-middle"></i> Hủy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <th scope="col">Vé</th>
                                <th scope="col" class="text-end">Giá tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="1">
                                    @php
                                        $img = $oneTicket->first();
                                        $url = $img->movie->img_thumbnail;
                                        if (!\Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }
                                    @endphp
                                    <div style="display: flex; justify-content: center">
                                        @if (!empty($img->movie->img_thumbnail))
                                            <img src="{{ $url }}" alt="Movie Thumbnail" width="50px">
                                        @else
                                            No image!
                                        @endif
                                    </div>
                                    <div style="display: flex; justify-content: center">
                                        <p class="mt-2"><b>{{ $oneTicket->movie->name }}</b></p>
                                    </div>
                                </td>
                                <td colspan="1">
                                    <p> {{ $oneTicket->room->name }}</p>
                                    <p> {{ \Carbon\Carbon::parse($oneTicket->ticketSeats->first()->showtime->date)->format('d-m-Y') }}</p>
                                    <p> {{ \Carbon\Carbon::parse($oneTicket->ticketSeats->first()->showtime->start_time)->format('H:i') }}
                                        ~ {{ \Carbon\Carbon::parse($oneTicket->ticketSeats->first()->showtime->end_time)->format('H:i') }}</p>
                                </td>
                                <td colspan="1">
                                    @foreach ($ticket->ticketCombos as $ticketCombo)
                                        @php
                                            $combo = $ticketCombo->combo;
                                            $price = $combo->price_sale > 0 ? $combo->price_sale : $combo->price; // Kiểm tra price_sale
                                            $totalPrice = $price * $ticketCombo->quantity;
                                        @endphp

                                        <span><b>{{ $combo->name }} x {{ $ticketCombo->quantity }}</b></span>
                                        <p>{{ number_format($totalPrice, 0, ',', '.') }} vnđ</p>
                                        {{--<ul>
                                            @foreach ($combo->food as $food)
                                                <li>{{ $food->name }} x {{ $food->pivot->quantity }}</li>
                                            @endforeach
                                        </ul>--}}

                                    @endforeach
                                </td>
                                <td colspan="1" class="fw-medium align-content-start">
                                    @foreach($ticket->ticketSeats as $ticketSeat)
                                        <p class="fs-15">-
                                            <span class="link-primary">{{ $ticketSeat->seat->name }} </span>
                                            (<span>{{ $ticketSeat->seat->typeSeat->name }}</span>)
                                        </p>
                                    @endforeach
                                </td>
                                <td colspan="1" class="fw-medium text-end align-content-start">
                                    @foreach($ticket->ticketSeats as $ticketSeat)
                                        <p class="fs-15">{{ number_format($ticketSeat->price, 0, ',', '.') }}
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
                                            <td>Tiền vé:</td>
                                            <td class="text-end">{{ number_format($totalPriceSeat, 0, ',', '.') }}vnđ
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiền combos:</td>
                                            <td class="text-end">
                                                @php
                                                    $totalComboPrice = 0;
                                                @endphp

                                                @foreach($ticket->ticketCombos as $ticketCombo)
                                                    @php
                                                        $price = $ticketCombo->combo->price_sale > 0 ? $ticketCombo->combo->price_sale : $ticketCombo->combo->price;
                                                        $totalComboPrice += $price * $ticketCombo->quantity;
                                                    @endphp
                                                @endforeach

                                                {{ number_format($totalComboPrice, 0, ',', '.') }} vnđ

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
            {{--<div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Trạng thái vé</h5>
                        --}}{{--<div class="flex-shrink-0 mt-2 mt-sm-0">
                            <a href="javascript:void(0);" class="btn btn-soft-info btn-sm mt-2 mt-sm-0"><i
                                    class="ri-map-pin-line align-middle me-1"></i> Sửa lại thông
                                tin</a>
                            <a href="javascript:void(0);" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i
                                    class="mdi mdi-archive-remove-outline align-middle me-1"></i>
                                Hủy</a>
                        </div>--}}{{--
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

                                        @if($ticket->status != 'Chưa suất vé')
                                            <p class="text-muted"></p>
                                            @if($ticket->status == 'Đã suất vé' && new DateTime() < new DateTime($ticket->expiry))
                                                <h6 class="mb-1">Đã suất vé</h6>
                                                <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($ticket->updated_at)->locale('vi')->translatedFormat('l, j/n/Y - H:i') }}</p>
                                            @else
                                                <h6 class="mb-1">Đã hết hạn</h6>
                                                <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($ticket->expiry)->locale('vi')->translatedFormat('l, j/n/Y - H:i') }}</p>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @if($ticket->status !== 'Chưa suất vé')
                                @if($ticket->status == 'Đã suất vé')
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
                                                                class="fw-normal">{{ \Carbon\Carbon::parse($ticket->updated_at)->locale('vi')->translatedFormat('l, j/n/Y - H:i') }}</span>
                                                        </h6>
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
                                                        <h6 class="fs-15 mb-1 fw-semibold">Hủy - <span
                                                                class="fw-normal">{{ \Carbon\Carbon::parse($ticket->expiry)->locale('vi')->translatedFormat('l, j/n/Y - H:i') }}</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        --}}{{--<div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body ms-2 ps-5 pt-0">
                                                <h6 class="mb-1">Your Item has been picked up by courier partner</h6>
                                                <p class="text-muted mb-0">Fri, 17 Dec 2021 - 9:45AM</p>
                                            </div>
                                        </div>--}}{{--
                                    </div>
                                @endif
                            @endif



                            --}}{{--<div class="accordion-item border-0">
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
                            </div>--}}{{--
                            --}}{{--<div class="accordion-item border-0">
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
                            </div>--}}{{--
                        </div>
                        <!--end accordion-->
                    </div>
                </div>
            </div>--}}
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
                                  class="badge bg-primary-subtle text-primary fs-11">
{{--                                {{ $ticket->status }}--}}

                                @if($ticket->status == 'Chưa suất vé')
                                    Chưa suất vé
                                @elseif($ticket->status == 'Đã suất vé')
                                    Đã suất vé <br>
                                    <span>({{ \Carbon\Carbon::parse($ticket->updated_at)->locale('vi')->translatedFormat('H:i - j/n/Y') }})</span>
                                @elseif($ticket->status == 'Đã hết hạn')
                                    Đã hết hạn <br>
                                    <span>{{ \Carbon\Carbon::parse($ticket->expiry)->locale('vi')->translatedFormat('H:i - j/n/Y') }}</span>
                                @endif

                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="text-center">
                        <div class="d-flex justify-content-center">{!! $barcode !!}</div>
                        <p class="text-muted mb-0 mt-2"><b>{{ $ticket->code }}</b></p>
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
                            <p class="text-muted mb-0">Thanh toán vào lúc:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ \Carbon\Carbon::parse($ticket->created_at)->locale('vi')->translatedFormat('H:i - j/n/Y') }}</h6>
                        </div>

                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Phương thức thanh toán:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ $ticket->payment_name }}</h6>
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
    {{--<script>
        document.getElementById('confirmPrintBtn').addEventListener('click', function() {
            fetch('{{ route("admin.tickets.confirmPrint", $ticket) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ confirm: 'yes' })
            })
                .then(response => response.json())
                .then(data => {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('staticBackdrop'));
                    modal.hide();

                    // Kiểm tra và hiển thị thông báo nếu vé đã suất trước đó
                    if (data.hasPrinted) {
                        alert(data.message);  // Hiển thị thông báo rằng vé đã được suất
                    } else {
                        alert(data.message);  // Hiển thị thông báo suất vé thành công
                    }

                    window.location.href = '{{ route("admin.tickets.print", $ticket) }}';
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    alert('Có lỗi xảy ra khi xử lý yêu cầu');
                });
        });
    </script>--}}
@endsection
