{{-- @extends('client.layouts.master')

@section('title')
    Giới thiệu
@endsection

@section('content')
<body>
    <div class="introduce-wrapper">
        <div class="introduce-container">
            <!-- Nội dung chính -->
            <div class="introduce-main-content">
                <img src="{{ asset('theme/client/images/index_III/logo_fpoly_cinemas.jpg') }}"
                    alt="F5 Poly Media" class="introduce-logo">
                <p>F5 Poly Media được thành lập bởi doanh nhân F5 Poly Cinemas (Shark Minh Beta) vào cuối năm 2014 với sứ mệnh "Mang trải nghiệm điện ảnh với mức giá hợp lý cho mọi người dân Việt Nam".</p>
                <p>Với thiết kế độc đáo, trẻ trung, F5 Poly Cinemas mang đến trải nghiệm điện ảnh chất lượng với chi phí đầu tư và vận hành tối ưu - nhờ việc chọn địa điểm phù hợp, tận dụng tối đa diện tích, bố trí khoa học, nhằm duy trì giá vé xem phim trung bình chỉ từ 40,000/1 vé - phù hợp với đại đa số người dân Việt Nam.</p>
                <p>Năm 2023 đánh dấu cột mốc vàng son cho Beta Cinemas khi ghi nhận mức tăng trưởng doanh thu ấn tượng 150% so với năm 2019 - là năm đỉnh cao của ngành rạp chiếu phim trước khi đại dịch Covid-19 diễn ra. Thành tích này cho thấy sức sống mãnh liệt và khả năng phục hồi ấn tượng của chuỗi rạp.</p>
                <p>Tính đến thời điểm hiện tại, Beta Cinemas đang có 20 cụm rạp trải dài khắp cả nước, phục vụ tới 6 triệu khách hàng mỗi năm, là doanh nghiệp dẫn đầu phân khúc đại chúng của thị trường điện ảnh Việt. Beta Media cũng hoạt động tích cực trong lĩnh vực sản xuất và phát hành phim.</p>
                <p>Ngoài đa số các cụm rạp do Beta Media tự đầu tư, ¼ số cụm rạp của Beta Media còn được phát triển bằng hình thức nhượng quyền linh hoạt. Chi phí đầu tư rạp chiếu phim Beta Cinemas được tối ưu giúp nhà đầu tư dễ dàng tiếp cận và nhanh chóng hoàn vốn, mang lại hiệu quả kinh doanh cao và đảm bảo.</p>
            </div>
        </div>
    </div>
</body>
<style>
    .introduce-wrapper {
    margin-top: 120px;
    margin-bottom: 20px; 
}
    .introduce-container {
    display: flex;
    width: 80%;
    margin: 0 auto;
    background-color: #fff;
    border: 1px solid #ddd;
}
.introduce-sidebar {
    width: 20%;
    background-color: #004080;
    padding: 20px;
    border-right: 1px solid #ddd;
}
.introduce-sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.introduce-sidebar ul li {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    cursor: pointer;
    color: #ffffff;
}
.introduce-sidebar ul li.introduce-active {
    background-color: #fff;
    color: #004080;
    font-weight: bold;
}
.introduce-main-content {
    width: 80%;
    padding: 20px;
}
.introduce-main-content img.introduce-logo {
    width: 100%;
    height: 300px;
    display: block;
    margin-bottom: 20px;
}
.introduce-main-content p {
    margin-bottom: 15px;
    line-height: 1.6;
}
</style>
@endsection --}}


@extends('client.layouts.master')

@section('title')
    Giới thiệu
@endsection

@section('content')
@php
    // Truy vấn dữ liệu từ bảng site_settings
    use App\Models\SiteSetting;
    $settings = SiteSetting::first();
@endphp

<div class="introduce-wrapper">
    <div class="introduce-container">
        <div class="introduce-main-content">
            <!-- Ảnh đại diện và thông tin website -->
            @if($settings->introduction_image)
            {{-- Kiểm tra xem có phải là ảnh mặc định hay không --}}
            @if(Str::startsWith($settings->introduction_image, 'theme/client/images/'))
                <img src="{{ asset($settings->introduction_image) }}" alt="introduction_image" class="introduce-logo">
            @else
                <img src="{{ Storage::url($settings->introduction_image) }}" alt="introduction_image" class="introduce-logo">
            @endif
            @else
                {{-- Hiển thị ảnh mặc định nếu không có ảnh nào --}}
                <img src="{{ asset('theme/client/images/header/P.svg') }}" alt="introduction_image" class="introduce-logo">
            @endif
            <p>{!! $settings->introduction !!}</p>

            <!-- Thông tin liên hệ -->
            <h4>Thông tin liên hệ</h4>
            <p><strong>Email:</strong> {{ $settings->email}}</p>
            <p><strong>Số điện thoại:</strong> {{ $settings->phone}}</p>
            <p><strong>Giờ làm việc:</strong> {{ $settings->working_hours}}</p>
        </div>
    </div>
</div>

<style>
    .introduce-wrapper { margin-top: 120px; margin-bottom: 20px; }
    .introduce-container { width: 80%; margin: 0 auto; background-color: #fff; border: 1px solid #ddd; padding: 20px; }
    .introduce-main-content img.introduce-logo { width: 100%; height: 400px; display: block; margin-bottom: 20px; }
    .introduce-main-content p { margin-bottom: 15px; line-height: 1.6; }
</style>
@endsection


