<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn đặt vé</title>
</head>
<body>
    <h1>Xin chào {{ $user->name }}</h1>
    <p>Cảm ơn bạn đã đặt vé xem phim tại hệ thống của chúng tôi. Dưới đây là thông tin vé của bạn:</p>

    <h2>Thông tin vé</h2>
    <ul>
        <li>Mã vé: {{ $ticket->code }}</li>
        <li>Phim: {{ $ticket->movie->name }}</li>
        <li>Rạp: {{ $ticket->cinema->name }}</li>
        <li>Phòng chiếu: {{ $ticket->room->name }}</li>
        <li>Suất chiếu: {{ $showtime->start_time }}</li>
        <li>Tổng giá: {{ number_format($ticket->total_price) }} VND</li>
    </ul>

    <h2>Ghế đã chọn</h2>
    <ul>
        @foreach ($seats as $seat)
            <li>Ghế: {{ $seat->seat->name }} - Giá: {{ number_format($seat->price) }} VND</li>
        @endforeach
    </ul>

    <h2>Combo đồ ăn</h2>
    <ul>
        @foreach ($combos as $combo)
            <li>{{ $combo->combo->name }} - Số lượng: {{ $combo->quantity }} - Giá: {{ number_format($combo->price) }} VND</li>
        @endforeach
    </ul>

    <p>Chúc bạn xem phim vui vẻ!</p>
</body>
</html>
