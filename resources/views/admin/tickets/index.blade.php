@extends('admin.layouts.master')

@section('title')
    Danh sách vé
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection



@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách vé</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Vé</a></li>
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
                {{--fillter--}}
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-6">
                                <div class="search-box">
                                    <input type="text" class="form-control search" placeholder="Search for order ID, customer, order status or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-6">
                                <div>
                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" id="demo-datepicker" placeholder="Select date">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control" data-choices="" data-choices-search-false="" name="choices-single-default" id="idStatus">
                                        <option value="">Status</option>
                                        <option value="all" selected="">All</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Inprogress">Inprogress</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Pickups">Pickups</option>
                                        <option value="Returns">Returns</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control" data-choices="" data-choices-search-false="" name="choices-single-default" id="idPayment">
                                        <option value="">Select Payment</option>
                                        <option value="all" selected="">All</option>
                                        <option value="Mastercard">Mastercard</option>
                                        <option value="Paypal">Paypal</option>
                                        <option value="Visa">Visa</option>
                                        <option value="COD">COD</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                        Filters
                                    </button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>

                {{--Thành phố--}}
                <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link All py-3 active" data-bs-toggle="tab" id="branchAll" href="#" role="tab" aria-selected="true">
                            <i class="ri-store-2-fill me-1 align-bottom"></i> Tất cả
                            <span class="badge bg-dark align-middle ms-1">{{ $branches->count() }}</span>
                        </a>
                    </li>
                    @foreach ($branches as $branch)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link py-3 branch" data-bs-toggle="tab" data-branch-id="{{ $branch->id }}" href="#" role="tab" aria-selected="false" tabindex="-1">
                             {{ $branch->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>

                {{--Khu vực--}}
                <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist" id="cinema-list">
                    <li class="nav-item">
                        <a class="nav-link All py-3" data-bs-toggle="tab" id="cenimaAll" href="#" role="tab" aria-selected="true">
                            Tất cả
                            <span class="badge bg-dark align-middle ms-1">{{ $cinemas->count() }}</span>
                        </a>
                    </li>
                    @foreach ($cinemas as $cinema)
                        <li class="nav-item  cinema-item" data-branch-id="{{ $cinema->branch_id }}">
                            <a class="nav-link py-3 isDraft" data-bs-toggle="tab" href="#" role="tab" aria-selected="false">
                                {{ $cinema->name }}
                                 <span class="badge bg-warning align-middle ms-1">{{ $cinema->count() }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>


                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-success">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap align-middle"
                           style="width:100%;">
                        <thead class='table-light'>
                        <tr>
                            <th>ID</th>
                            <th>Tên người dùng</th>
                            <th>Code phim</th>
                            <th>Ảnh phim</th>
                            <th>Thông tin vé</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                        </thead>
                        <tbody id="ticket-table-body">
                        @foreach ($tickets as $code => $groupTickets)
                            @php
                                $ticket = $groupTickets->first();
                            @endphp
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{{ $ticket->user->name }}</td>
                                <td>{{ $code }}</td>
                                <td class="text-center">
                                    @php
                                        $ticketSeat = $ticket->ticketSeat->first();
                                        $url = $ticketSeat->movie->img_thumbnail;
                                        if (!\Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }
                                    @endphp

                                    @if (!empty($ticketSeat->movie->img_thumbnail))
                                        <img src="{{ $url }}" alt="Movie Thumbnail" width="110px">
                                    @else
                                        No image!
                                    @endif
                                </td>
                                <td>
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item mb-1"><span class="fw-semibold">Phim:</span>
                                            {{ $ticketSeat->movie->name }}
                                        </li>
                                        {{--<li class="nav-item mb-1"><span class="fw-semibold">Chi nhánh:</span>
                                            {{ $ticketSeat->room->branch->name }}
                                        </li>
                                        <li class="nav-item mb-1"><span class="fw-semibold">Rạp:</span>
                                            {{ $ticketSeat->room->cinema->name }}
                                        </li>--}}
                                        <li class="nav-item mb-1"><span class="fw-semibold">Phòng:</span>
                                            {{ $ticketSeat->room->name }}
                                        </li>
                                        <li class="nav-item mb-1">
                                            <span class="fw-semibold">Bởi:</span>
                                            <span class="badge {{ $ticket->staff === 'admin' ? 'bg-primary-subtle text-primary' : ' bg-secondary-subtle text-secondary' }}">
                                                {{ $ticket->staff }}
                                            </span>
                                        </li>
                                        <li class="nav-item mb-1"><span class="fw-semibold">Số lượng vé:</span>
                                            {{ $ticket->ticket_seat_count }} vé
                                        </li>
                                        <li class="nav-item mb-1"><span class="fw-semibold">Tổng tiền:</span>
                                            {{ number_format($ticket->total_price) }} VNĐ
                                        </li>
                                        <li class="nav-item mb-1"><span class="fw-semibold">Trạng thái:</span>
                                            @switch($ticket->status)
                                                @case('Chờ xác nhận')
                                                    <span class="badge bg-warning">Chờ xác nhận</span>
                                                    @break

                                                @case('Đã hết hạn')
                                                    <span class="badge bg-danger">Đã hết hạn</span>
                                                    @break

                                                @case('Hoàn thành')
                                                    <span class="badge bg-success">Hoàn thành</span>
                                                    @break
                                            @endswitch
                                        </li>
                                        <li class="nav-item mb-1"><span class="fw-semibold">Suất chiếu lúc:</span>
                                            {{ \Carbon\Carbon::parse($ticketSeat->showtime->start_time)->format('H:i, d/m/Y') }}
                                        </li>
                                        <li class="nav-item mb-1"><span class="fw-semibold">Kết thúc vào:</span>
                                            {{ \Carbon\Carbon::parse($ticketSeat->showtime->end_time)->format('H:i, d/m/Y') }}
                                        </li>
                                        <li class="nav-item mb-1"><span class="fw-semibold">Thời hạn sử dụng:</span>
                                            {{ $ticket->expiry->format('H:i, d/m/Y') }}
                                        </li>

                                    </ul>
                                </td>
                                <td>
                                    <select class="form-select" data-ticket-id="{{ $ticket->id }}" onchange="changeStatus(this)"
                                        {{ $ticket->status == 'Đã hết hạn' && now()->gt($ticket->expiry->format('H:i, d/m/Y'))  || $ticket->status == 'Hoàn thành' ? 'disabled' : '' }}>
                                        <option value="Chờ xác nhận" {{ $ticket->status == 'Chờ xác nhận' ? 'selected' : '' }}>Chờ xác nhận</option>
                                        <option value="Hoàn thành" {{ $ticket->status == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                                        @if ($ticket->status == 'Đã hết hạn')
                                            <option value="Đã hết hạn" selected>Đã hết hạn</option>
                                        @endif



                                    </select>
                                </td>
                                <td>
                                    <a href="{{ route('admin.showtimes.show', $ticket) }}">
                                        <button title="Xem" class="btn btn-success btn-sm" type="button"><i class="fas fa-eye"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>


            </div>
        </div><!--end col-->
    </div><!--end row-->
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
        function changeStatus(e) {
            var ticketId = e.getAttribute('data-ticket-id');
            var newStatus = e.value;

            fetch(`/admin/tickets/${ticketId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Trạng thái đã được cập nhật thành công!');
                    } else {
                        alert('Lỗi khi cập nhật trạng thái.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        /*Hiển thị theo khu vực*/
        document.addEventListener('DOMContentLoaded', function () {
            const branchLinks = document.querySelectorAll('.nav-link.branch');
            const cinemaItems = document.querySelectorAll('.cinema-item');

            document.getElementById('branchAll').addEventListener('click', function () {
                cinemaItems.forEach(item => item.style.display = 'block');
            });

            branchLinks.forEach(link => {
                link.addEventListener('click', function () {
                    const branchId = this.getAttribute('data-branch-id');

                    cinemaItems.forEach(item => {
                        if (item.getAttribute('data-branch-id') === branchId) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        });

    </script>





@endsection

