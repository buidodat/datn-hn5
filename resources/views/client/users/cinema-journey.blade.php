@extends('client.layouts.master')

@section('title')
Hành trình điện ảnh
@endsection

@section('content')

<body>
    <div class="my-account-container">
        <div class="my-account-tabs">
            <a href="my-account"><div class="my-account-tab">THÔNG TIN TÀI KHOẢN</div></a>
            {{-- <a href="#my-account"><div class="my-account-tab">THÔNG TIN TÀI KHOẢN</div></a> --}}
            <div class="my-account-tab">THẺ THÀNH VIÊN</div>
            <div class="my-account-tab my-account-active">HÀNH TRÌNH ĐIỆN ẢNH</div>
            <div class="my-account-tab">ĐIỂM BETA</div>
            <div class="my-account-tab">VOUCHER</div>
        </div>

        <div class="cinema-journey-container">
            <table class="cinema-journey-table">
                <thead class="cinema-journey-thead">
                    <tr>
                        <th class="cinema-journey-th">Mã Hóa Đơn</th>
                        <th class="cinema-journey-th">Phim</th>
                        <th class="cinema-journey-th">Rạp Chiếu</th>
                        <th class="cinema-journey-th">Suất Chiếu</th>
                        <th class="cinema-journey-th">Ghế Đã Đặt</th>
                        <th class="cinema-journey-th">Combo/Package</th>
                        <th class="cinema-journey-th">Ngày Đặt</th>
                        <th class="cinema-journey-th">Điểm</th>
                    </tr>
                </thead>
                <tbody class="cinema-journey-tbody">
                    <tr>
                        <td class="cinema-journey-td">4811201174585152</td>
                        <td class="cinema-journey-td">
                            <img src="{{ asset('theme/client/images/image.png') }}" alt="Movie Poster" class="cinema-journey-movie-poster" />
                            <p class="cinema-journey-movie-title">Ma Da</p>
                        </td>
                        <td class="cinema-journey-td">Beta Mỹ Đình P1</td>
                        <td class="cinema-journey-td">27/08/2024 16:00</td>
                        <td class="cinema-journey-td">2D Happy Day V.I.P F5, F6, F8, F7<br />Tổng tiền: 180.000 đ</td>
                        <td class="cinema-journey-td">
                            Sweet Combo 69oz<br />Số lượng: 2<br />Tổng tiền: 176.000 đ
                        </td>
                        <td class="cinema-journey-td">27/08/2024 15:54</td>
                        <td class="cinema-journey-td">
                            +23000 Điểm tích lũy<br />
                            - 0 Điểm tiêu dùng<br />
                            Điểm hết hạn vào 26/10/2024 23:59
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>        
    </div>
</body>

@endsection