@extends('admin.layouts.master')

@section('title')
    Danh sách hóa đơn
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection



@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách hóa đơn @if (Auth::user()->cinema_id != '')
                        - {{ Auth::user()->cinema->name }}
                    @endif
                </h4>

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
                {{-- fillter --}}
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form method="GET" action="{{ route('admin.tickets.index') }}">
                        {{-- @csrf --}}
                        <div class="row g-3">
                            {{-- <div class="col-xxl-5 col-sm-6">
                                 <div class="search-box">
                                    <input type="text" class="form-control search"
                                        placeholder="Tìm kiếm theo ID, khách hàng, trạng thái...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div> --}}
                            <!--end col-->

                            <!--end col-->
                            @if (Auth::user()->hasRole('System Admin'))
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
                                <!--end col-->
                                <div class="col-xxl-2 col-sm-4">
                                    <div>
                                        <select name="cinema_id" id="cinema" class="form-select">
                                            <option value="">Chọn Rạp</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="col-xxl-2 col-sm-6">
                                <div>
                                    <input type="date" name="date" id="" class="form-control"
                                        value="{{ request('date', now()->format('Y-m-d')) }}">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                        Lọc
                                    </button>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
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
                    <table id="example" class="table table-bordered dt-responsive nowrap align-middle"
                        style="width:100%;">
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
                                @php
                                    $ticket = $groupTickets->first();
                                    $url = $ticket->movie->img_thumbnail;
                                    if (!\Str::contains($url, 'http')) {
                                        $url = Storage::url($url);
                                    }
                                    $showtime = $ticket->ticketSeats->first()?->showtime;
                                    $showtimeStart = $showtime
                                        ? \Carbon\Carbon::parse($showtime->start_time)->format('H:i')
                                        : 'Không có';
                                    $showtimeEnd = $showtime
                                        ? \Carbon\Carbon::parse($showtime->end_time)->format('H:i')
                                        : 'Không có';
                                @endphp
                                <tr>
                                    <td>{{ $code }}</td>
                                    <td>
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item mb-1"><span class="fw-semibold">Người dùng:</span>
                                                {{ $ticket->user->name }}</li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Chức vụ:</span>
                                                <span
                                                    class="badge {{ $ticket->user->type === 'admin' ? 'bg-primary-subtle text-primary' : ' bg-secondary-subtle text-secondary' }}">{{ $ticket->user->type }}</span>
                                            </li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Email:</span>
                                                {{ $ticket->user->email }}</li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Số điện thoại:</span>
                                                {{ $ticket->user->phone }}</li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Phương thức thanh
                                                    toán:</span> {{ $ticket->payment_name }}</li>
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        @if (!empty($ticket->movie->img_thumbnail))
                                            <img src="{{ $url }}" alt="Movie Thumbnail" width="100px">
                                        @else
                                            No image !
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item mb-1"><span class="fw-semibold">Phim:</span>
                                                {{ $ticket->movie->name }}</li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Nơi chiếu:</span>
                                                {{ $ticket->cinema->branch->name }} - {{ $ticket->cinema->name }} -
                                                {{ $ticket->room->name }}
                                            </li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Ghế:</span>
                                                @foreach ($ticket->ticketSeats as $ticketSeat)
                                                    {{ $ticketSeat->seat->name }}
                                                @endforeach
                                            </li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Tổng tiền:</span>
                                                {{ number_format($ticket->total_price) }} VNĐ</li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Trạng thái:</span>
                                                @switch($ticket->status)
                                                    @case('Chưa suất vé')
                                                        <span class="badge bg-warning">Chưa suất vé</span>
                                                    @break

                                                    @case('Đã hết hạn')
                                                        <span class="badge bg-danger">Đã hết hạn</span>
                                                    @break

                                                    @case('Đã suất vé')
                                                        <span class="badge bg-success">Đã suất vé</span>
                                                    @break
                                                @endswitch
                                            </li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Lịch chiếu:</span>
                                                {{ $showtimeStart }} ~ {{ $showtimeEnd }}</li>
                                            <li class="nav-item mb-1"><span class="fw-semibold">Thời hạn sử dụng:</span>
                                                {{ $ticket->expiry->format('H:i, d/m/Y') }}</li>
                                        </ul>
                                    </td>
                                    <td>
                                        @if (Auth::user()->can('Sửa hóa đơn'))
                                            <select class="form-select" data-original-status="{{ $ticket->status }}"
                                                data-ticket-id="{{ $ticket->id }}" onchange="changeStatus(this)"
                                                {{ $ticket->expiry->isPast() || $ticket->status == 'Đã suất vé' ? 'disabled' : '' }}>
                                                <option value="Chưa suất vé"
                                                    {{ $ticket->status == 'Chưa suất vé' ? 'selected' : '' }}>Chờ xác nhận
                                                </option>
                                                <option value="Đã suất vé"
                                                    {{ $ticket->status == 'Đã suất vé' ? 'selected' : '' }}>Hoàn tất
                                                </option>
                                                @if ($ticket->expiry->isPast() && $ticket->status != 'Đã suất vé')
                                                    <option value="Đã hết hạn" selected disabled>Đã hết hạn</option>
                                                @endif
                                            </select>
                                        @else
                                        
                                            @if ($ticket->status == 'Chưa suất vé')
                                                Chờ xác nhận
                                            @elseif($ticket->status == 'Đã suất vé')
                                                Hoàn tất
                                            @elseif($ticket->expiry->isPast() && $ticket->status != 'Đã suất vé')
                                                Đã hết hạn
                                            @endif
                                        @endif
                                        {{-- @can('Sửa hóa đơn')
                                        @endcan --}}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tickets.show', $ticket) }}">
                                            <button title="Chi tiết" class="btn btn-success btn-sm" type="button"><i
                                                    class="fas fa-eye"></i></button>
                                        </a>
                                        <a href="{{ route('admin.tickets.print', $ticket) }}">
                                            <button title="print" class="btn btn-success btn-sm" type="button"><i
                                                    class="ri-download-2-fill align-middle me-1"></i> In hóa đơn</button>
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
        //cập nhật trạng thái
        function changeStatus(e) {
            if (confirm("Bạn có chắc chắn muốn thay đổi trạng thái vé không?")) {
                var ticketId = e.getAttribute('data-ticket-id');
                var newStatus = e.value;

                fetch(`/admin/tickets/${ticketId}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Trạng thái đã được cập nhật thành công!');
                            window.location.reload();
                        } else {
                            // Hiển thị thông báo lỗi từ server và load laji trang
                            alert(data.message || 'Lỗi khi cập nhật trạng thái.');
                            window.location.reload();

                            // Khôi phục trạng thái cũ nếu có lỗi
                            e.value = e.getAttribute("data-original-status");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Đã xảy ra lỗi trong quá trình xử lý.');
                        e.value = e.getAttribute("data-original-status");
                    });
            } else {
                // Khôi phục trạng thái cũ nếu người dùng chọn "Cancel" trong confirm
                e.value = e.getAttribute("data-original-status");
            }
        }

        /*Hiển thị rạp*/
        $(document).ready(function() {
            // Lấy giá trị branchId và cinemaId từ Laravel
            // var selectedBranchId = "{{ old('branch_id', '') }}";
            // var selectedCinemaId = "{{ old('cinema_id', '') }}";

            // Xử lý sự kiện thay đổi chi nhánh
            $('#branch').on('change', function() {
                var branchId = $(this).val();
                var cinemaSelect = $('#cinema');
                cinemaSelect.empty();
                cinemaSelect.append('<option value="">Chọn Rạp</option>');

                if (branchId) {
                    $.ajax({
                        url: "{{ url('api/cinemas') }}/" + branchId,
                        method: 'GET',
                        success: function(data) {
                            $.each(data, function(index, cinema) {
                                cinemaSelect.append('<option value="' + cinema.id +
                                    '" >' + cinema.name + '</option>');
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
        });
    </script>
@endsection
