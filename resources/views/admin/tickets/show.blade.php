@extends('admin.layouts.master')

@section('title')
    Thông tin vé
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
    {{-- đây là giao diện vé khi in --}}
    <div id="invoice">
        <div class="invoice-container">
            <div class="invoice-content">
                <h2 class="invoice-title">Hóa đơn chi tiết</h2>

                <div class="invoice-details">
                    <strong>Chi nhánh công ty Poly Cinemas vietnam tại {{ $oneTicket->cinema->branch->name }}</strong><br>
                    Địa chỉ: 69 {{ $oneTicket->cinema->name }} - {{ $oneTicket->cinema->branch->name }}<br>
                    MST: 012147901412
                    <hr>
                    <strong>Poly Cinemas {{ $oneTicket->cinema->name }} - {{ $oneTicket->cinema->branch->name }}</strong><br>
                    Thời gian đặt vé: {{ $oneTicket->created_at }}
                    <hr>
                    @php
                        $ticketSeat = $oneTicket->ticketSeats()->first();
                        $rating = App\Models\Movie::getRatingByName($oneTicket->movie->rating);
                    @endphp
                    <strong>{{ $oneTicket->movie->name }} ({{ $oneTicket->showtime->format }}) </strong><br>
                    ({{ $rating['name'] }}) {{ $rating['description'] }}<br>
                    <strong>Phòng:</strong> {{ $ticket->room->name }} <br>
                    <strong>Ghế:</strong> {{ $ticket->ticketSeats->pluck('seat.name')->implode(', ') }}
                    <hr>
                    <div class="ticket-info border-bottom-dashed border-top-dashed mt-2">
                        @foreach ($oneTicket->ticketCombos as $ticketCombo)
                            @php
                                $combo = $ticketCombo->combo;
                                $price = $combo->price_sale > 0 ? $combo->price_sale : $combo->price;
                                $totalPrice = $price * $ticketCombo->quantity;
                            @endphp

                            <p><b>{{ $combo->name }} x {{ $ticketCombo->quantity }} ({{ number_format($totalPrice) }} vnđ)</b></p>

                            <ul>
                                @foreach ($combo->food as $food)
                                    <li>{{ $food->name }} x {{ $food->pivot->quantity }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                    <hr>
                </div>

                <div class="invoice-summary">
                    <div><span>Giá vé:</span><span>{{ number_format($totalPriceSeat, 0, ',', '.') }} VND</span></div>
                    <div><span>Giá combo:</span><span>{{ number_format($totalComboPrice, 0, ',', '.') }} VND</span></div>
                    <div><span>Giảm giá:</span><span>{{ number_format($ticket->voucher_discount, 0, ',', '.') }} VND</span></div>
                    <div><strong>Thành tiền:</strong><strong>{{ number_format($ticket->total_price, 0, ',', '.') }} VND</strong></div>
                </div>

                <div class="barcode">
                    {!! $barcode !!}
                </div>
                <div class="invoice-code">{{ $oneTicket->code }}</div>
            </div>
        </div>

        {{--hoa don combo--}}
        <div class="invoice-container">
            <div class="invoice-content">
                <h2 class="invoice-title">Hóa đơn combo</h2>

                <div class="invoice-details">
                    <strong>Chi nhánh công ty Poly Cinemas vietnam tại {{ $oneTicket->cinema->branch->name }}</strong><br>
                    Địa chỉ: 69 {{ $oneTicket->cinema->name }} - {{ $oneTicket->cinema->branch->name }}<br>
                    mst: 012147901412
                    <hr>
                    <strong>Poly Cinemas {{ $oneTicket->cinema->name }} - {{ $oneTicket->cinema->branch->name }}</strong><br>
                    Thời gian: {{ $oneTicket->created_at }}
                    <hr>
                    <div class="ticket-info border-bottom-dashed mt-2">
                        @foreach ($oneTicket->ticketCombos as $ticketCombo)
                            @php
                                $combo = $ticketCombo->combo;
                                $price = $combo->price_sale > 0 ? $combo->price_sale : $combo->price;
                                $totalPrice = $price * $ticketCombo->quantity;
                            @endphp

                            <p><b>{{ $combo->name }} x {{ $ticketCombo->quantity }} ({{ number_format($totalPrice) }} vnđ)</b></p>

                            <ul>
                                @foreach ($combo->food as $food)
                                    <li>{{ $food->name }} x {{ $food->pivot->quantity }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                    <hr>
                </div>

                <div class="invoice-summary">
                    <div><strong>Thành tiền:</strong><strong>{{ number_format($totalComboPrice, 0, ',', '.') }} VND</strong></div>
                </div>

                <div class="barcode">
                    {!! $barcode !!}
                </div>
                <div class="invoice-code">{{ $oneTicket->code }}</div>
            </div>
        </div>

        {{--hoa don ve--}}
        @foreach($oneTicket->ticketSeats as $seat)
            <div class="invoice-container">
                <div class="invoice-content">
                    <h2 class="invoice-title">Vé xem phim</h2>


                    <div class="invoice-details">
                        <strong>Chi nhánh công ty Poly Cinemas vietnam tại {{ $oneTicket->cinema->branch->name }}</strong><br>
                        Địa chỉ: 69 {{ $oneTicket->cinema->name }} - {{ $oneTicket->cinema->branch->name }}<br>
                        mst: 012147901412
                        <hr>
                        <strong>Poly Cinemas {{ $oneTicket->cinema->name }} - {{ $oneTicket->cinema->branch->name }}</strong><br>
                        Thời gian: {{ $oneTicket->created_at }}
                        <hr>
                        @php
                            $ticketSeat = $oneTicket->ticketSeats()->first();
                            $rating = App\Models\Movie::getRatingByName($oneTicket->movie->rating);
                        @endphp
                        <strong>{{ $oneTicket->movie->name }} ({{ $oneTicket->showtime->format }})</strong><br>
                        ({{ $rating['name'] }}) {{ $rating['description'] }}<br>
                        <strong>Phòng:</strong> {{ $ticket->room->name }}<br>
                        <strong>Ghế:</strong> {{ $seat->seat->name }}
                        <hr>
                    </div>

                    <div class="invoice-summary">
                        <div><span>Giá vé:</span><span>{{ number_format($totalPriceSeat, 0, ',', '.') }} VND</span></div>
                        <div><span>Giảm giá:</span><span>{{ number_format($ticket->voucher_discount, 0, ',', '.') }} VND</span></div>
                        <div><strong>Thành tiền:</strong><strong>{{ number_format($totalPriceSeat - $ticket->voucher_discount, 0, ',', '.') }} VND</strong></div>
                    </div>

                    <div class="barcode">
                        {!! $barcode !!}
                    </div>
                    <div class="invoice-code">{{ $oneTicket->code }}</div>

                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0"></h5>

                        <div class="flex-shrink-0">
                            <!-- Static Backdrop -->
                            @if (now()->lt($ticket->expiry))
                            <button type="button" class="btn btn-success btn-sm"
                                    {{ $ticket->status == App\Models\Ticket::ISSUED ? 'onclick=printInvoice()' : ' ' }}
                                    data-bs-toggle="modal" data-bs-target="#confirmTicket">
                                <i class="ri-download-2-fill align-middle me-1"></i> In vé
                            </button>
                            @endif
                            <!-- confirmTicket Modal -->
                            @if ($ticket->status == App\Models\Ticket::NOT_ISSUED)
                                <div class="modal fade" id="confirmTicket" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" role="dialog"
                                     aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center p-5">
                                                <div class="mt-4">
                                                    <h4 class="mb-3">Xác nhận xuất vé</h4>
                                                    <p class="text-muted mb-4"> Vui lòng xác nhận và thay đổi trạng thái
                                                        thành đã xuất vé.
                                                    </p>
                                                    <div class="hstack gap-2 justify-content-center">
                                                        <a id="confirmPrintBtn" class="btn btn-success"
                                                           data-bs-dismiss="modal">Xác
                                                            nhận</a>
                                                        <a class="btn btn-link link-success fw-medium"
                                                           data-bs-dismiss="modal"><i
                                                                class="ri-close-line me-1 align-middle"></i> Hủy</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

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
                                    <p> {{ \Carbon\Carbon::parse($oneTicket->showtime->date)->format('d-m-Y') }}
                                    </p>
                                    <p> {{ \Carbon\Carbon::parse($oneTicket->showtime->start_time)->format('H:i') }}
                                        ~
                                        {{ \Carbon\Carbon::parse($oneTicket->showtime->end_time)->format('H:i') }}
                                    </p>
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
                                        {{-- <ul>
                                        @foreach ($combo->food as $food)
                                            <li>{{ $food->name }} x {{ $food->pivot->quantity }}</li>
                                        @endforeach
                                    </ul> --}}
                                    @endforeach
                                </td>
                                <td colspan="1" class="fw-medium align-content-start">
                                    @foreach ($ticket->ticketSeats as $ticketSeat)
                                        <p class="fs-15">-
                                            <span class="link-primary">{{ $ticketSeat->seat->name }} </span>
                                            (<span>{{ $ticketSeat->seat->typeSeat->name }}</span>)
                                        </p>
                                    @endforeach
                                </td>
                                <td colspan="1" class="fw-medium text-end align-content-start">
                                    @foreach ($ticket->ticketSeats as $ticketSeat)
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
                                            <td class="text-end">
                                                {{ number_format($totalPriceSeat, 0, ',', '.') }}vnđ
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiền combos:</td>
                                            <td class="text-end">
                                                @php
                                                    $totalComboPrice = 0;
                                                @endphp

                                                @foreach ($ticket->ticketCombos as $ticketCombo)
                                                    @php
                                                        $price =
                                                            $ticketCombo->combo->price_sale > 0
                                                                ? $ticketCombo->combo->price_sale
                                                                : $ticketCombo->combo->price;
                                                        $totalComboPrice += $price * $ticketCombo->quantity;
                                                    @endphp
                                                @endforeach

                                                {{ number_format($totalComboPrice, 0, ',', '.') }} vnđ

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Giảm giá <span
                                                    class="text-muted">{{ $ticket->voucher_code ? '(' . $ticket->voucher_code . ')' : '' }}</span>:
                                            </td>
                                            <td class="text-end">
                                                {{ $ticket->voucher_discount > 0 ? '-' . number_format($ticket->voucher_discount, 0, ',', '.') . ' vnđ' : '0' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Điểm :</td>
                                            <td class="text-end">0</td>
                                        </tr>

                                        <tr class="border-top border-top-dashed">
                                            <th scope="row">Thành tiền :</th>
                                            <th class="text-end">
                                                {{ number_format($ticket->total_price, 0, ',', '.') }}
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

        </div>
        <!--end col-->
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Trạng thái vé</h5>
                        <div class="flex-shrink-0">
                            <span href="javascript:void(0);" class="badge fs-11
        {{ now()->greaterThan($ticket->expiry) ? 'bg-warning-subtle text-danger' : 'bg-primary-subtle text-primary' }}">
                                @if (now()->greaterThan($ticket->expiry))
                                    Đã hết hạn <br>
                                    <span>{{ \Carbon\Carbon::parse($ticket->expiry)->locale('vi')->translatedFormat('H:i - j/n/Y') }}</span>
                                @elseif ($ticket->status == 'Chưa xuất vé')
                                    Chưa xuất vé
                                @elseif($ticket->status == 'Đã xuất vé')
                                    Đã xuất vé <br>
                                    <span>({{ \Carbon\Carbon::parse($ticket->updated_at)->locale('vi')->translatedFormat('H:i - j/n/Y') }})</span>
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
                                    {{-- <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-sm rounded"> --}}
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
            {{-- <!--end card-->
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
            <!--end card--> --}}

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
                            <h6 class="mb-0">
                                {{ \Carbon\Carbon::parse($ticket->created_at)->locale('vi')->translatedFormat('H:i - j/n/Y') }}
                            </h6>
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
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection

@section('style-libs')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/order.css') }}">
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function printInvoice() {
            printJS({
                printable: 'invoice', // ID hoặc phần tử bạn muốn in
                type: 'html',
                css: '{{ asset('theme/admin/assets/css/order.css') }}'
            });
        }
    </script>
    <script>
        document.getElementById('confirmPrintBtn').addEventListener('click', function () {
            fetch('{{ route('admin.tickets.confirm', $ticket) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        window.location.reload();
                    }

                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    alert('Có lỗi xảy ra khi xử lý yêu cầu');
                });
        });
    </script>
    <script>
        @if (session('confirm'))
        printInvoice();
        @endif
    </script>
@endsection
