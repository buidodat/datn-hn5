@extends('client.layouts.master')

@section('title')
    Chi tiết giao dịch
@endsection

@section('content')

    <body>
        <div class="container" style="margin-top: 70px; margin-bottom: 100px;">
            <div class="my-account-tabs">
                <a href="#my-account" aria-controls="best" role="tab" data-toggle="tab">
                    <div class="my-account-tab" role="presentation">THÔNG TIN TÀI KHOẢN</div>
                </a>
                <a href="#">
                    <div class="my-account-tab">THẺ THÀNH VIÊN</div>
                </a>
                <a href="#cinema-journey" aria-controls="trand" role="tab" data-toggle="tab">
                    <div class="my-account-tab" role="presentation">LỊCH SỬ GIAO DỊCH</div>
                </a>
                <a href="#">
                    <div class="my-account-tab">ĐIỂM POLY</div>
                </a>
                <a href="#">
                    <div class="my-account-tab">VOUCHER</div>
                </a>
            </div>

            <div class="col-md-12">
                <div class="tab-content">
                    {{-- Chi tiết giao dịch --}}
                    @foreach ($ticketSeat as $ticket)
                        <div id="detail-ticket" class="tab-pane active">
                            <div class="row mb-3 title-detail">

                                <h3>Chi tiết giao dịch # {{ $ticket->code }} </h3>


                            </div>
                            <div class="content-detail">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="code-qr">
                                            <p class="text-img bold">Mã quét</p>

                                            <p><b>Ngày mua hàng:</b> {{ $ticket->created_at }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img width="150px" src="{{ asset('theme/client/images/img-qr.png') }}"
                                            alt="">
                                    </div>
                                </div>

                                <div class="box-address">
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="address-detail">
                                                <b>Địa chỉ thanh toán</b>
                                                <p>{{ $ticket->user->name }}</p>
                                                <p>{{ $ticket->user->address }}</p>
                                                <p>{{ $ticket->user->email }}</p>
                                                <p>{{ $ticket->user->phone }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="payment-checkout-detail">
                                                <b>Phương thức thanh toán</b>
                                                <p>{{ $ticket->payment_method }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row info-detail">
                                    <div class="col-md-12">
                                        <div>
                                            <b> Thông tin giao dịch</b>
                                        </div>
                                        <div>
                                            {{-- In hóa đơn lỗi --}}
                                            <button onclick="window.print()">In hóa đơn</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row box-detail-history">
                                    <div class="row">
                                        <div class="col-md-12" align='center'>
                                            CHI TIẾT GIAO DỊCH
                                        </div>
                                    </div>

                                </div>

                                <div class="table-history">
                                    <div class="row">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Phim</th>
                                                    <th>Suất chiếu</th>
                                                    <th>Vé</th>
                                                    <th>Combo</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    // Nhóm các ticketMovie theo movie_id
                                                    $ticketSeatsByMovie = $ticket->ticketSeats->groupBy('movie_id');
                                                @endphp

                                                @foreach ($ticketSeatsByMovie as $ticketSeats)
                                                    <tr>

                                                        <td>{{ $ticketSeats->first()->movie->name }}</td>
                                                        <td>
                                                            <b> {{ $ticketSeats->first()->showtime->cinema->name }}
                                                            </b> <br>
                                                            <p> {{ $ticketSeats->first()->room->name }}</p>
                                                            <p> {{ \Carbon\Carbon::parse($ticketSeats->first()->showtime->date)->format('d-m-Y') }}
                                                            </p>
                                                            <p> {{ \Carbon\Carbon::parse($ticketSeats->first()->showtime->start_time)->format('H:i') }}
                                                                -
                                                                {{ \Carbon\Carbon::parse($ticketSeats->first()->showtime->end_time)->format('H:i') }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <b>{{ $ticketSeats->first()->seat->typeSeat->name }}</b>
                                                            <p>
                                                                @foreach ($ticketSeats as $item)
                                                                    {{ $item->seat->name }}
                                                                @endforeach
                                                            </p>
                                                            <p>
                                                                @php
                                                                    $quantitySeats = $ticketSeats->count();
                                                                    $priceSeat =
                                                                        $ticketSeats->first()->seat->typeSeat->price *
                                                                        $quantitySeats;
                                                                    echo number_format($priceSeat, 0, ',', '.');
                                                                @endphp
                                                                đ
                                                            </p>
                                                            {{-- 65k x 2 --}}
                                                        </td>
                                                        <td>
                                                            {{-- Combo đang lỗi , chỉ hiển thị ra đc 1 sp --}}
                                                            @php
                                                                $ticketCombo = App\Models\TicketCombo::find(
                                                                    $ticket->id,
                                                                );
                                                            @endphp

                                                            <b>
                                                                {{-- {{ $ticketCombo->combo->name }} x
                                                                    {{ $ticketCombo->quantity }} --}}
                                                                Poly Combo 49k x 3
                                                            </b>

                                                            <p>
                                                                {{-- {{ number_format($ticketCombo->price, 0, ',', '.') }}đ --}}
                                                                147.000đ
                                                            </p>
                                                            {{-- 49k x 3 --}}
                                                        </td>
                                                        <td>
                                                            {{-- Thành tiền --}}
                                                            <p> {{ number_format($ticket->total_price, 0, ',', '.') }}đ</p>
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <th colspan="5" class="total-detail xanh-fpt" align="right">Tổng cộng:
                                                            {{ number_format($ticket->total_price, 0, ',', '.') }}đ</th>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            {{-- <tfoot>

                                        </tfoot> --}}
                                        </table>
                                        <div class="back-list-history">
                                            <a href="" aria-controls="trand" role="tab" data-toggle="tab">
                                                << Trở về</a>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
    <!-- Modal Đổi mật khẩu -->


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    </body>
@endsection
