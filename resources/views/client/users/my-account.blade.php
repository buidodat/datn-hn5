@extends('client.layouts.master')

@section('title')
    Tài khoản của tôi
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('content')

    <body>
        <div class="container" style="margin-top: 70px; margin-bottom: 100px;">
            <div class="my-account-tabs">
                <a href="#my-account" role="tab" data-toggle="tab" class="tab-link">
                    <div class="my-account-tab my-account-active" role="presentation">THÔNG TIN TÀI KHOẢN</div>
                </a>
                <a href="#membership" role="tab" data-toggle="tab" class="tab-link">
                    <div class="my-account-tab">THẺ THÀNH VIÊN</div>
                </a>
                <a href="#cinema-journey" role="tab" data-toggle="tab" class="tab-link">
                    <div class="my-account-tab" role="presentation">LỊCH SỬ GIAO DỊCH</div>
                </a>
                <a href="#voucher" role="tab" data-toggle="tab" class="tab-link">
                    <div class="my-account-tab">VOUCHER CỦA TÔI</div>
                </a>
            </div>

            <div class="col-md-12">
                <div class="tab-content">
                    {{-- Thông tin tài khoản --}}
                    <div id="my-account" class="tab-pane fade" role="tabpanel" class="item-content"> {{-- active --}}
                        <form action="{{ route('my-account.update') }}" method="post" enctype="multipart/form-data"
                            id="updateAccountForm">
                            @csrf
                            @method('PUT')

                            <div class="my-account-upload-container">
                                <div class="my-account-image-upload-container" id="img_thumbnail" name="img_thumbnail">
                                    @php
                                        $url = $user->img_thumbnail;

                                        if (!\Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }

                                    @endphp
                                    @if (!empty($user->img_thumbnail))
                                        <img src="{{ $url }}">
                                    @else
                                        <img src="{{ asset('theme/client/images/user-dummy-img.jpg') }}">
                                    @endif

                                </div>
                                <div class="my-account-buttons">
                                    <input type="file" id="file-upload" name="img_thumbnail" accept="image/*"
                                        style="display: none;" />
                                    <label for="img_thumbnail" class="my-account-upload-btn" id="uploadBtn">Tải ảnh
                                        lên</label>
                                </div>

                            </div>

                            <div class="my-account-form-row">
                                <div class="my-account-form-group">
                                    <div class="my-account-mb-3">
                                        <label for="name"><span style="color: red;">*</span>&nbsp;Họ tên</label>
                                        <input type="text" class="my-account-form-control" placeholder="Họ và tên"
                                            name="name" id="name" value="{{ old('name', $user->name) }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="my-account-mb-3">
                                        <label for="phone"><span style="color: red;">*</span>&nbsp;Số điện thoại</label>
                                        <i class="fa fa-phone-square phone-icon"></i>
                                        <input type="text" id="phone" class="my-account-form-control" name="phone"
                                            placeholder="Nhập số điện thoại của bạn"
                                            value="{{ old('phone', $user->phone) }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="my-account-mb-3">
                                        <label for="birthday"><span style="color: red;">*</span>&nbsp;Ngày sinh</label>
                                        <i class="fa fa-calendar birthday-icon"></i>
                                        <input type="date" id="birthday" value="{{ old('birthday', $user->birthday) }}"
                                            class="my-account-form-control" name="birthday" placeholder="Ngày sinh"
                                            data-date-format="yyyy-mm-dd" />
                                        @error('birthday')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="my-account-mb-3">
                                        <a href="#" id="changePasswordBtn" class="my-account-d-block">Đổi mật
                                            khẩu?</a>
                                    </div>
                                </div>

                                <div class="my-account-form-group">
                                    <div class="my-account-mb-3">
                                        <label for="email"><span style="color: red;">*</span>&nbsp;Email</label>
                                        <i class="fa fa-envelope email-icon"></i>
                                        <input type="email" id="email" disabled class="my-account-form-control"
                                            name="email" placeholder="example@gmail.com"
                                            value="{{ old('email', $user->email) }}">
                                    </div>
                                    <div class="my-account-mb-3">
                                        <label for="gender">Giới tính</label>
                                        <i class="fa fa-male sex-icon"></i>
                                        <div class="my-account-input-icon">
                                            <select name="gender" id="" class="my-account-form-control">
                                                @foreach ($genders as $gender)
                                                    <option value="{{ $gender }}" @selected($user->gender == $gender)>
                                                        {{ $gender }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="my-account-mb-3">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" class="my-account-form-control"
                                            placeholder="Số nhà, đường, ngõ xóm" name="address" id="address"
                                            value="{{ old('address', $user->address) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="my-account-text-center my-account-my-3">
                                <button type="submit" class="my-account-btn">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                    <div id="membership" class="tab-pane fade" role="tabpanel" class="item-content">
                        {{-- fade --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class='row-header'>
                                    Tổng quát
                                </div>
                                <div class="row">
                                    <div class="col-md-9">

                                        <div class='text-center'>
                                            <p> <span class="span_card">Cấp độ thẻ: </span><span
                                                    class="bold">{{ $user->membership->rank->name }}</span></p>
                                        </div>
                                        {{-- <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <span>Số tiền đã chi tiêu</span>
                                                <span
                                                    class="amount">{{ number_format($user->membership->total_spent, 0, ',', '.') }}
                                                    <strong>VND</strong></span>
                                            </div>
                                            @php
                                                $maxAmount = 5000000; // Giới hạn tối đa
                                                $progress = ($user->membership->total_spent / $maxAmount) * 100;
                                            @endphp
                                            <div class="progress-bar-container">
                                                <div class="progress-bar-fill {{ $progress >= 100 ? 'full' : '' }}"
                                                    style="width: {{ $progress }}%;"></div>
                                            </div>
                                            <div class="milestone-container">
                                                <div class="milestone" style="left: 0;">
                                                    <span>Normal</span>
                                                    <span>0</span>
                                                </div>
                                                <div class="milestone" style="left: 40%;">
                                                    <span>VIP</span>
                                                    <span>2.000.000</span>
                                                </div>
                                                <div class="milestone" style="right: 0;">
                                                    <span>Platinum</span>
                                                    <span>5.000.000</span>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <span>Số tiền đã chi tiêu</span>
                                                <span class="amount">
                                                    {{ number_format($user->membership->total_spent, 0, ',', '.') }}
                                                    <strong>VND</strong>
                                                </span>
                                            </div>

                                            @php
                                                $maxAmount = $ranks->max('total_spent');
                                                // Tính toán phần trăm tiến độ dựa trên maxAmount
                                                $progress = min(
                                                    ($user->membership->total_spent / $maxAmount) * 100,
                                                    100,
                                                );
                                            @endphp

                                            <div class="progress-bar-container">
                                                <div class="progress-bar-fill {{ $progress >= 100 ? 'full' : '' }}"
                                                    style="width: {{ $progress }}%;"></div>
                                            </div>

                                            <div class="milestone-container">
                                                @foreach ($ranks as $index => $rank)
                                                    <div class="milestone"
                                                        style="{{ $index === count($ranks) - 1 ? 'right: 0;' : 'left: ' . ($rank['total_spent'] / $maxAmount) * 100 . '%;' }}">
                                                        <span>{{ $rank['name'] }}</span>
                                                        <span>{{ number_format($rank['total_spent'], 0, ',', '.') }}
                                                            VND</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>




                                    </div>
                                    <div class="col-md-3 d-flex justify-content-center">
                                        <div style="margin: 0 auto; text-align: center;">
                                            {!! $barcode = DNS1D::getBarcodeHTML($user->membership->code, 'C128', 2.4, 100) !!}
                                            <p style="font-size: 16px; margin: 3px auto">{{ $user->membership->code }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="points-info">
                                            <div><span class="span_label">Điểm đã tích lũy:</span> <span
                                                    class='bold'>{{ number_format($user->membership->pointHistories->where('type', App\Models\PointHistory::POINTS_ACCUMULATED)->sum('points'), 0, ',', '.') }}
                                                    điểm</span>
                                            </div>
                                            <div><span class="span_label">Điểm đã sử dụng:</span> <span
                                                    class='bold'>{{ number_format($user->membership->pointHistories->where('type', App\Models\PointHistory::POINTS_SPENT)->sum('points'), 0, ',', '.') }}
                                                    điểm</span>
                                            </div>
                                            <div><span class="span_label">Điểm đã hết hạn:</span> <span
                                                    class='bold'>{{ number_format($user->membership->pointHistories->where('type', App\Models\PointHistory::POINTS_EXPIRY)->sum('points'), 0, ',', '.') }}
                                                    điểm</span>
                                            </div>
                                            <div><span class="span_label">Điểm hiện có:</span> <span
                                                    class='bold'>{{ number_format($user->membership->points, 0, ',', '.') }}
                                                    điểm</span></div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class='row-header'>
                                        Lịch sử điểm
                                    </div>
                                    <table id="pointHistory"
                                        class='table table-bordered dt-responsive nowrap  align-middle dataTable no-footer dtr-inline'
                                        width="100%">
                                        <thead class='xanh-fpt'>
                                            <tr>
                                                <th>Thời gian</th>
                                                <th>Số điểm</th>
                                                <th>Nội dung sử dụng</th>
                                                <th>Hạn sử dụng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->membership->pointHistories()->latest('id')->get() as $pointHistory)
                                                <tr>
                                                    <td>{{ $pointHistory->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        {{ $pointHistory->type == App\Models\PointHistory::POINTS_ACCUMULATED
                                                            ? '+ ' . number_format($pointHistory->points, 0, ',', '.')
                                                            : '- ' . number_format($pointHistory->points, 0, ',', '.') }}
                                                    </td>
                                                    <td>{{ $pointHistory->type }}</td>
                                                    <td>{{ $pointHistory->expiry_date ? $pointHistory->expiry_date->format('d/m/Y') : '' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Hành trình điện ảnh --}}
                    <div id="cinema-journey" class="tab-pane fade" role="tabpanel" class="item-content">
                        {{-- fade --}}
                        <div class="row">
                            <div class="col-md-12">
                                <table class='table table-bordered dt-responsive nowrap align-middle '
                                    id="transactionHistory" width="100%">
                                    <thead class='xanh-fpt'>
                                        <tr>
                                            <th>Mã đặt vé </th>
                                            <th>Hình ảnh</th>
                                            <th>Thông tin vé</th>
                                            <th>Thao tác</th>

                                    </thead>
                                    <tbody>

                                        @foreach ($tickets as $ticket)
                                            @php
                                                // Nhóm các ticketMovie theo movie_id
                                                $ticketSeatsByMovie = $ticket->ticketSeats->groupBy('movie_id');
                                            @endphp

                                            @foreach ($ticketSeatsByMovie as $ticketSeats)
                                                <tr>
                                                    <td>{{ $ticket->code }}</td>
                                                    <td>

                                                        @php
                                                            // Lấy thông tin movie từ ticketSeat đầu tiên trong nhóm

                                                            $url = $ticket->movie->img_thumbnail;

                                                            if (!\Str::contains($url, 'http')) {
                                                                $url = Storage::url($url);
                                                            }
                                                        @endphp


                                                            <img width="100% " src="{{ $url }}"
                                                            alt="movie_img" />





                                                    </td>
                                                    <td>
                                                        <h3 class="movie-name-history">
                                                            <a
                                                                href="{{ route('movies.movie-detail', $ticket->movie->slug) }}">{{ $ticket->movie->name }}</a>
                                                        </h3>
                                                        <b>Ngày chiếu:</b>
                                                        {{ \Carbon\Carbon::parse($ticket->showtime->date)->format('d/m/Y') }}
                                                        <br>
                                                        <b>Giờ chiếu: </b>
                                                        {{ \Carbon\Carbon::parse($ticket->showtime->start_time)->format('H:i') }} ~   {{ \Carbon\Carbon::parse($ticket->showtime->end_time)->format('H:i') }}
                                                        <br>
                                                        <b>Rạp chiếu:</b> {{ $ticket->cinema->name }} -
                                                        {{ $ticket->room->name }}
                                                        <br>
                                                        <b>Ghế ngồi:</b>
                                                        {{ implode(', ', $ticketSeats->pluck('seat.name')->toArray()) }}
                                                        <br>
                                                        <b>Trạng thái:</b> {{ $ticket->status }}
                                                        <br>
                                                        <b>Tổng tiền thanh toán:</b>
                                                        {{ number_format($ticket->total_price, 0, ',', '.') }}
                                                        VNĐ
                            </div>
                            </td>
                            <td>

                                <div style="display: flex; gap: 5px">
                                    <a href="{{ route('ticketDetail', $ticket->id) }}">
                                        <button class="btn btn-info">Chi tiết</button>
                                    </a>
                                    {{-- @php
                                                                    $deadlineCancel = Carbon\Carbon::parse($ticket->showtime->start_time)->subMinutes(
                                                                        App\Models\Ticket::CANCELLATION_DEADLINE_MINUTES,
                                                                    );
                                                                @endphp

                                                                @if ($ticket->status == App\Models\Ticket::NOT_ISSUED && now() < $deadlineCancel)
                                                                    <form
                                                                        action="{{ route('my-account.transaction.cancel', $ticket) }}"
                                                                        method="post" class='mx-2'>
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <button type='submit' onclick="return confirm('Sau khi hủy vé bạn sẽ được hoàn điểm có giá trị tương ứng với số tiền. Bạn có chắc chắn muốn hủy ?')"
                                                                            class="btn btn-danger">Hủy</button>
                                                                    </form>
                                                                @endif --}}
                                </div>

                            </td>
                            </tr>
                            @endforeach
                            @endforeach

                            </tbody>
                            </table>
                        </div>
                    </div>



                </div>

                {{-- Chi tiết giao dịch --}}

                <div id="detail-ticket" class="tab-pane fade" role="tabpanel" class="item-content">
                    <div class="row mb-3 title-detail">
                        <h3>Chi tiết giao dịch #4811201174585152</h3>
                    </div>
                    <div class="content-detail">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="code-qr">
                                    <p class="text-img bold">Mã quét</p>

                                    <p><b>Ngày mua hàng:</b> 09/09/2024</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img width="150px" src="{{ asset('theme/client/images/img-qr.png') }}" alt="">
                            </div>
                        </div>

                        <div class="box-address">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="address-detail">
                                        <b>Địa chỉ thanh toán</b>
                                        <p>NGuyễn Viết Sơn</p>
                                        <p>Xã Tiên Phương, huyện Chương Mỹ, Hà Nội</p>
                                        <p>sonnvph33874@fpt.edu.vn</p>
                                        <p>0987654321</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="payment-checkout-detail">
                                        <b>Phương thức thanh toán</b>
                                        <p>MOMO - 65k/vé</p>
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
                                    <button>In hóa đơn</button>
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
                                        <tr>
                                            <td>Vây hãm trên không</td>
                                            <td>
                                                <b>Poly Mỹ đình</b> <br>
                                                <p>Poly Room 01</p>
                                                <p>09/09/2024</p>
                                                <p>20:50 - 22:33</p>
                                            </td>
                                            <td>
                                                <b>VIP</b>
                                                <p>E1, E2</p>
                                                <p>130.000đ</p> {{-- 65k x 2 --}}
                                            </td>
                                            <td>
                                                <b>Combo Poly 49k x 3</b>
                                                <p>147.000đ</p> {{-- 49k x 3 --}}
                                            </td>
                                            <td>
                                                <p>277.000đ</p>
                                            </td>
                                        </tr>


                                        <tr>
                                            <th colspan="5" class="total-detail" align="right">Tổng cộng:
                                                277.000đ</th>
                                        </tr>
                                    </tbody>
                                    {{-- <tfoot>

                                    </tfoot> --}}
                                </table>
                                <div class="back-list-history">
                                    <a href="#cinema-journey" aria-controls="trand" role="tab" data-toggle="tab">
                                        << Trở về</a>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </body>

    <div class="my-account-overlay" id="overlay">
        <div class="my-account-modal" id="changePasswordForm">
            <form id="changePasswordForm">
                <div class="my-account-mb-3">
                    <label for="old_password"><span style="color: red;">*</span>&nbsp;Mật khẩu hiện tại</label>
                    <input type="password" class="my-account-form-control" id="old_password" name="old_password"
                        placeholder="Nhập mật khẩu hiện tại">
                    <span id="old_password_error" class="text-danger"></span>
                </div>
                <div class="my-account-mb-3">
                    <label for="password"><span style="color: red;">*</span>&nbsp;Mật khẩu mới</label>
                    <input type="password" class="my-account-form-control" id="password" name="password"
                        placeholder="Nhập mật khẩu mới">
                    <span id="password_error" class="text-danger"></span>
                </div>
                <div class="my-account-mb-3">
                    <label for="password_confirmation"><span style="color: red;">*</span>&nbsp;Nhập lại mật khẩu
                        mới</label>
                    <input type="password" class="my-account-form-control" id="password_confirmation"
                        name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
                    <span id="password_confirmation_error" class="text-danger"></span>
                </div>
                <div class="my-account-text-center">
                    <button type="submit" class="my-account-btn">Xác nhận</button>
                    <button type="button" class="my-account-btn" id="closeChangePassword">Hủy</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('script-libs')
    </script>
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
        new DataTable("#transactionHistory", {
            order: [],
            columnDefs: [{
                targets: 1,
                width: "150px"
            }]
        });
    </script>
    <script>
        new DataTable("#pointHistory", {
            order: [],

        });
    </script>

    <script>
        $(document).ready(function() {
            // Xóa thông báo lỗi khi người dùng nhập vào các input trong form đổi mật khẩu
            $('#old_password, #password, #password_confirmation').on('input', function() {
                $(this).next('.text-danger').text(''); // Xóa nội dung lỗi ngay sau trường input
            });

            // AJAX cho cập nhật tài khoản
            $('#updateAccountForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                // Xóa tất cả thông báo lỗi trước đó
                $('.text-danger').remove();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            location.reload(); // Tải lại trang nếu cập nhật thành công
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            for (let field in errors) {
                                let inputField = $(`[name="${field}"]`);
                                inputField.next('.text-danger').remove(); // Xóa lỗi cũ nếu có
                                inputField.after(
                                    `<span class="text-danger">${errors[field][0]}</span>`);
                            }
                        } else {
                            alert("Lỗi: " + xhr.responseJSON.message);
                        }
                    }
                });
            });

            // AJAX cho đổi mật khẩu
            $('#changePasswordForm').on('submit', function(e) {
                e.preventDefault();

                let formData = {
                    old_password: $('#old_password').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val(),
                    _token: '{{ csrf_token() }}',
                };

                // Xóa tất cả thông báo lỗi trước đó
                $('#old_password_error, #password_error, #password_confirmation_error').text('');

                $.ajax({
                    url: '{{ route('my-account.changePasswordAjax') }}',
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            location.reload(); // Tải lại trang nếu đổi mật khẩu thành công
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            // Hiển thị thông báo lỗi cụ thể cho từng input
                            if (errors.old_password) {
                                $('#old_password').next('.text-danger').remove();
                                $('#old_password').after(
                                    `<span class="text-danger">${errors.old_password[0]}</span>`
                                );
                            }
                            if (errors.password) {
                                $('#password').next('.text-danger').remove();
                                $('#password').after(
                                    `<span class="text-danger">${errors.password[0]}</span>`
                                );
                            }
                            if (errors.password_confirmation) {
                                $('#password_confirmation').next('.text-danger').remove();
                                $('#password_confirmation').after(
                                    `<span class="text-danger">${errors.password_confirmation[0]}</span>`
                                );
                            }
                        } else if (xhr.status === 400) {
                            $('#old_password').next('.text-danger').remove();
                            $('#old_password').after(
                                `<span class="text-danger">${xhr.responseJSON.error}</span>`
                            );
                        }
                    },
                });
            });
        });
    </script>

    <script>
        const divTabLinks = document.querySelectorAll('.tab-link div');
        const itemContents = document.querySelectorAll('.item-content');


        function activateTab(hash) {
            // Tắt tất cả các tab và nội dung
            divTabLinks.forEach(link => link.classList.remove('my-account-active'));
            itemContents.forEach(content => content.classList.remove('in', 'active'));

            // Kích hoạt tab và nội dung tương ứng với hash
            const activeDiv = document.querySelector(`a[href="${hash}"] div`);
            const activeContent = document.querySelector(hash);

            if (activeDiv && activeContent) {
                activeDiv.classList.add('my-account-active'); // Thêm lớp 'active' và 'my-account' vào tab
                activeContent.classList.add('in', 'active');

            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const hash = window.location.hash || '#my-account'; // Mặc định tab "THÔNG TIN TÀI KHOẢN"
            activateTab(hash);


        });
        document.querySelectorAll('.tab-link').forEach(tab => {
            tab.addEventListener('click', function(event) {
                const hash = this.getAttribute('href');
                // Thay đổi hash trên URL mà không reload trang
                window.history.pushState(null, null, hash);
            });
        });
    </script>
@endsection
