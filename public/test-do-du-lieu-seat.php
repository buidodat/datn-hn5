<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sơ đồ ghế</title>
    <style>
        .screen {
            width: 100%;
            background-color: #ddd;
            height: 30px;
            text-align: center;
            margin-bottom: 20px;
            line-height: 30px;
        }
        .seat-row {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }
        .seat {
            width: 40px;
            height: 40px;
            background-color: #ccc;
            margin: 5px;
            border-radius: 10px;
            text-align: center;
            line-height: 40px;
            font-size: 14px;
        }
        .seat.vip {
            background-color: gold;
        }
        .seat.selected {
            background-color: yellow;
        }
        .seat.occupied {
            background-color: red;
        }
        .seat.reserved {
            background-color: orange;
        }
    </style>
</head>
<body>

    <div class="screen">Màn hình chiếu</div>

    <?php
    // Mảng ghế hợp nhất tất cả các ghế từ A, B, C, ...
    $seats = [
        ['A1', 'available'], ['A2', 'available'], ['A3', 'vip'], ['A4', 'occupied'], ['A5', 'reserved'],
        ['B1', 'available'], ['B2', 'available'], ['B3', 'vip'], ['B4', 'occupied'], ['B5', 'reserved'],
        ['C1', 'available'], ['C2', 'available'], ['C3', 'vip'], ['C4', 'occupied'], ['C5', 'reserved'],
        ['D1', 'available'], ['D2', 'available'], ['D3', 'vip'], ['D4', 'occupied'], ['D5', 'reserved'],['D6', 'reserved'],
        ['E1', 'available'], ['E1', 'available'], ['E2', 'available'], ['E3', 'vip'], ['E4', 'occupied'], ['E5', 'reserved'],['E6', 'reserved'],
        // Thêm nhiều ghế hơn nếu cần
    ];

    // Biến lưu hàng hiện tại
    $currentRow = '';

    foreach ($seats as $seat) {
        $seatNumber = $seat[0];
        $seatStatus = $seat[1];

        // Tách hàng từ số ghế (ký tự đầu tiên của số ghế là hàng)
        $row = substr($seatNumber, 0, 1);

        // Nếu là hàng mới, đóng hàng cũ và bắt đầu hàng mới
        if ($row !== $currentRow) {
            // Nếu không phải lần đầu, đóng div của hàng trước
            if ($currentRow !== '') {
                echo '</div>';
            }
            // Bắt đầu hàng mới
            echo '<div class="seat-row">';
            $currentRow = $row;
        }

        // Gán class theo trạng thái ghế
        $class = 'seat';


        // Hiển thị ghế
        echo "<div class='$class'>$seatNumber</div>";
    }

    // Đóng hàng cuối cùng
    echo '</div>';
    ?>

</body>
</html>
