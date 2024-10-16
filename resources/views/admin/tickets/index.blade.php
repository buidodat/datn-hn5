@extends('admin.layouts.master')

@section('title')
    Danh sách hóa đơn
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
                <h4 class="mb-sm-0">Danh sách hóa đơn</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hóa đơn</a></li>
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
                    <div class="row g-3">
                        <div class="col-xxl-5 col-sm-6">
                            <div class="search-box">
                                <input type="text" class="form-control search" placeholder="Tìm kiếm theo ID, khách hàng, trạng thái...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-2 col-sm-6">
                            <div>
                                <input type="date" name="date" id="" class="form-control"
                                       value="{{ request('date', now()->format('Y-m-d')) }}">
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-xxl-2 col-sm-4">
                            <div>
                                <select name="branch_id" id="branch" class="form-select">
                                    <option value="">Chi nhánh</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">
                                            {{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xxl-2 col-sm-4">
                            <div>
                                <select name="cinema_id" id="cinema" class="form-select">
                                    <option value="">Chọn Rạp</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-1 col-sm-4">
                            <div>
                                <button class="btn btn-primary w-100" name="btnSearch" type="submit">
                                    <i class="ri-equalizer-fill me-1 align-bottom"></i> Lọc
                                </button>
                            </div>
                        </div>
                        <!--end col-->

                    </div>
                </div>

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
                    <table id="example" class="table table-bordered dt-responsive nowrap align-middle" style="width:100%;">
                        <thead class='table-light'>
                        <tr>
                            <th>Code phim</th>
                            <th>Thông tin người dùng</th>
                            <th class="text-center">Hình ảnh</th>
                            <th>Thông tin vé</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                        </thead>
                        <tbody id="ticket-table-body">
                        @foreach ($tickets as $code => $groupTickets)

                            <tr>
                                <td>{{ $code }}</td>
                                <td>
                                    <div>
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item mb-1"><span class="fw-semibold">Người dùng:</span>
                                                {{ $groupTickets->first()->user->name }}
                                            </li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Chức vụ:</span>
                                                <span
                                                    class="badge {{ $groupTickets->first()->staff === 'admin' ? 'bg-primary-subtle text-primary' : ' bg-secondary-subtle text-secondary' }}">
                                                {{ $groupTickets->first()->staff }}
                                            </span>
                                            </li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Email:</span>
                                                {{ $groupTickets->first()->user->email }}
                                            </li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Số điện thoại:</span>
                                                {{ $groupTickets->first()->user->phone }}
                                            </li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Phương thức thanh toán:</span>
                                                {{ $groupTickets->first()->payment_method }}
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                                <td class="text-center">
                                    @php
                                        $firstTicketSeat = $groupTickets->first()->ticketSeats->first();
                                        $url = $firstTicketSeat->movie->img_thumbnail;
                                        if (!\Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }
                                    @endphp

                                    @if (!empty($firstTicketSeat->movie->img_thumbnail))
                                        <img src="{{ $url }}" alt="Movie Thumbnail" width="100px">
                                    @else
                                        No image!
                                    @endif
                                </td>
                                <td>
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item mb-1"><span class="fw-semibold">Phim:</span>
                                            {{ $firstTicketSeat->movie->name }}
                                        </li>
                                        <li class="nav-item mb-1"><span class="fw-semibold">Nơi chiếu:</span>
                                            {{ $firstTicketSeat->room->branch->name }} - {{ $firstTicketSeat->room->cinema->name }} - {{ $firstTicketSeat->room->name }}
                                        </li>
                                        <li class="nav-item mb-1"><span class="fw-semibold">Ghế:</span>
                                            @foreach ($groupTickets->first()->ticketSeats as $ticketSeat)
                                                {{ $ticketSeat->seat->name }}
                                            @endforeach
                                        </li>
                                        <li class="nav-item mb-1"><span class="fw-semibold">Tổng tiền:</span>
                                            {{ number_format($groupTickets->first()->total_price) }} VNĐ
                                        </li>
                                        <li class="nav-item mb-1"><span class="fw-semibold">Trạng thái:</span>
                                            @switch($groupTickets->first()->status)
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
                                        <li class="nav-item mb-1"><span class="fw-semibold">Lịch chiếu:</span>
                                            {{ \Carbon\Carbon::parse($firstTicketSeat->showtime->start_time)->format('H:i') }}
                                            ~ {{ \Carbon\Carbon::parse($firstTicketSeat->showtime->end_time)->format('H:i') }}
                                        </li>

                                        <li class="nav-item mb-1"><span class="fw-semibold">Thời hạn sử dụng:</span>
                                            {{ $groupTickets->first()->expiry->format('H:i, d/m/Y') }}
                                        </li>
                                    </ul>

                                </td>
                                <td>
                                    <select class="form-select" data-ticket-id="{{ $groupTickets->first()->id }}"
                                            data-current-status="{{ $groupTickets->first()->status }}" onchange="changeStatus(this)"
                                        {{ $groupTickets->first()->status == 'Đã hết hạn' && now()>($groupTickets->first()->expiry->format('H:i, d/m/Y'))  || $groupTickets->first()->status == 'Hoàn thành' ? 'disabled' : '' }}>
                                        <option value="Chờ xác nhận" {{ $groupTickets->first()->status == 'Chờ xác nhận' ? 'selected' : '' }}>Chờ xác nhận</option>
                                        <option value="Hoàn thành" {{ $groupTickets->first()->status == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                                        @if ($groupTickets->first()->status == 'Đã hết hạn')
                                            <option value="Đã hết hạn" selected>Đã hết hạn</option>
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tickets.show', $groupTickets->first()) }}">
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
    </div>

@endsection


@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{--<!--datatable js-->--}}
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
        /*cập nhật trạng thái*/
        function changeStatus(e) {
            var ticketId = e.getAttribute('data-ticket-id');
            var newStatus = e.value;
            var currentStatus = e.getAttribute('data-current-status');

            // Hiển thị hộp thoại xác nhận
            if (confirm('Bạn có chắc chắn muốn thay đổi trạng thái không?')) {
                fetch(`/admin/tickets/${ticketId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({status: newStatus})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Trạng thái đã được cập nhật thành công!');
                            // Cập nhật trạng thái hiện tại sau khi thay đổi trạng thái thành công
                            e.setAttribute('data-current-status', newStatus);
                            window.location.reload();
                        } else {
                            alert('Lỗi khi cập nhật trạng thái.');
                            // Đặt lại giá trị của select về trạng thái ban đầu nếu có lỗi
                            e.value = currentStatus;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Đặt lại giá trị của select về trạng thái ban đầu nếu có lỗi
                        e.value = currentStatus;
                    });
            } else {
                // Đặt lại giá trị của select về trạng thái ban đầu nếu người dùng hủy thao tác
                e.value = currentStatus;
            }
        }

        /*Hiển thị rạp*/
        /* $(document).ready(function () {
             // Xử lý sự kiện thay đổi chi nhánh
             $('#branch').on('change', function () {
                 var branchId = $(this).val();
                 var cinemaSelect = $('#cinema');
                 cinemaSelect.empty();
                 cinemaSelect.append('<option value="">Chọn Rạp</option>');

                 if (branchId) {
                     $.ajax({
                         url: "{{ env('APP_URL') }}/api/cinemas/" + branchId,
                        method: 'GET',
                        success: function (data) {
                            $.each(data, function (index, cinema) {
                                cinemaSelect.append('<option value="' + cinema.id +'" >' + cinema.name + '</option>');
                            });

                            // Chọn lại cinema nếu có selectedCinemaId
                            if (selectedCinemaId) {
                                cinemaSelect.val(selectedCinemaId);
                                // selectedCinemaId = false;
                            }
                        }
                    });
                }
            });

            // Nếu có selectedBranchId thì tự động kích hoạt thay đổi chi nhánh để load danh sách cinema
            // if (selectedBranchId) {
            //     $('#branch').val(selectedBranchId).trigger('change');

            // }
        });*/

    </script>

@endsection

