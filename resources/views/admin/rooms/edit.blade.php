@extends('admin.layouts.master')

@section('title')
    Cập nhật phòng chiếu
@endsection

@section('content')
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý phòng chiếu</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.rooms.index') }}">Phòng chiếu</a></li>
                        <li class="breadcrumb-item active">Cập nhật</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-9">
            <div class="card card-left">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Sơ đồ ghế</h4>
                </div><!-- end card header -->
                <div class="card-body mb-3">
                    <table class="table-chart-chair table-none align-middle mx-auto text-center mb-5">
                        <thead>
                            <tr>

                            </tr>
                        </thead>
                        <tbody>
                            @for ($row = 0; $row < $matrixSeat['max_row']; $row++)
                                <tr>
                                    {{-- cột hàng ghế A,B,C --}}
                                    <td class="box-item">
                                        {{ chr(65 + $row) }}
                                    </td>
                                    @for ($col = 0; $col < $matrixSeat['max_col']; $col++)
                                        @foreach ($seats as $seat)
                                            @if ($seat->coordinates_x === $col + 1 && $seat->coordinates_y === chr(65 + $row))
                                                <td
                                                    class="box-item border-1 {{ $seat->type_seat_id == 1 ? 'light-orange' : 'light-blue' }}">
                                                    <div class="box-item-seat" data-seat-id="{{ $seat->id }}">
                                                        @if ($seat->trashed())
                                                            <img src="{{ asset('svg/seat-add.svg') }}" class='seat'
                                                                width="60%">
                                                        @else
                                                            @if ($seat->type_seat_id == 1)
                                                                <img src="{{ asset('svg/seat-regular.svg') }}" class='seat' width="100%">
                                                            @else
                                                            <img src="{{ asset('svg/seat-vip.svg') }}" class='seat' width="100%">
                                                            @endif
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                        @endforeach
                                    @endfor
                                </tr>
                            @endfor
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="row">
                <div class="col-md-12">

                    <div class="card card-seat ">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Xuất bản</h4>
                        </div><!-- end card header -->
                        <div class="card-body ">
                            <table class="table table-borderless   align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <td>Ghế thường</td>
                                        <td class="text-center"> <img src="{{ asset('svg/seat-regular.svg') }}"
                                                height="30px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ghế vip</td>
                                        <td class="text-center"> <img src="{{ asset('svg/seat-vip.svg') }}" height="30px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ghế đôi</td>
                                        <td class="text-center"> <img src="{{ asset('svg/seat-double.svg') }}"
                                                height="30px"></td>
                                    <tr class="table-active">
                                        <th colspan='2' class="text-center">Tổng {{ $seats->count() }} chỗ ngồi</th>

                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-seat ">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Chú thích</h4>
                    </div><!-- end card header -->
                    <div class="card-body ">
                        <table class="table table-borderless   align-middle mb-0">
                            <tbody>
                                <tr>
                                    <td>Hàng ghế thường</td>
                                    <td class="text-center">
                                        <div class='box-item border light-orange'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hàng ghế vip</td>
                                    <td class="text-center">
                                        <div class='box-item border light-blue'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hàng ghế đôi</td>
                                    <td class="text-center">
                                        <div class='box-item border light-pink'></div>
                                    </td>
                                <tr class="table-active">
                                    <th colspan='2' class="text-center">Tổng {{ $seats->count() }} chỗ ngồi</th>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/mainstyle.css') }}">
@endsection


@section('script-libs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.box-item-seat').forEach(function(seatElement) {
                seatElement.addEventListener('click', function() {
                    const seatId = seatElement.getAttribute('data-seat-id');
                    const imgElement = seatElement.querySelector('img.seat');

                    // Kiểm tra xem ghế đang ở trạng thái xóa mềm hay không
                    if (imgElement.src.includes('seat-add.svg')) {
                        // Gửi yêu cầu khôi phục ghế
                        fetch('{{ route('seats.restore') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    seat_id: seatId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Khôi phục ghế (cập nhật lại hình ảnh)
                                    imgElement.src = "{{ asset('svg/seat-regular.svg') }}";
                                    imgElement.style.width = "100%";
                                } else {
                                    alert('Thao tác quá nhanh.');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    } else {
                        // Gửi yêu cầu xóa mềm ghế
                        fetch('{{ route('seats.soft-delete') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    seat_id: seatId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Xóa mềm ghế (hiển thị hình ảnh xóa mềm)
                                    imgElement.src = "{{ asset('svg/seat-add.svg') }}";
                                    imgElement.style.width = "60%";
                                } else {
                                    alert('Thao tác quá nhanh.');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>
@endsection
