<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sơ đồ ghế rạp chiếu phim</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
        }

        .screen {
            background-color: #ddd;
            height: 30px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 18px;
            line-height: 30px;
            text-align: center;
            width: 100%;
        }

        .seat {
            width: 40px;
            height: 40px;
            background-color: #ddd;
            border-radius: 5px;
            margin: 5px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .seat.occupied {
            background-color: #ff4d4d;
            cursor: not-allowed;
        }

        .seat.reserved {
            background-color: #ffcc00;
        }

        .seat.selected {
            background-color: #0044cc;
            color: white;
        }

        .seat-row {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .seat-container .legend {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .legend div {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .legend .seat {
            margin: 0 5px;
            cursor: default;
        }

        @media (max-width: 768px) {
            .seat {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }
        }

        @media (max-width: 576px) {
            .seat {
                width: 25px;
                height: 25px;
                font-size: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- Màn hình -->
    <div class="screen">Màn hình Chiếu</div>

    <!-- Danh sách ghế -->
    <div class="container">
        <div class="seat-row">
            <div class="seat">A1</div>
            <div class="seat">A2</div>
            <div class="seat">A3</div>
            <div class="seat">A4</div>
            <div class="seat">A5</div>
            <div class="seat">A6</div>
            <div class="seat">A7</div>
            <div class="seat">A8</div>
            <div class="seat">A9</div>
            <div class="seat">A10</div>
            <div class="seat">A11</div>
            <div class="seat">A12</div>
            <div class="seat">A13</div>
        </div>

        <div class="seat-row">
            <div class="seat">B1</div>
            <div class="seat">B2</div>
            <div class="seat">B3</div>
            <div class="seat">B4</div>
            <div class="seat">B5</div>
            <div class="seat">B6</div>
            <div class="seat">B7</div>
            <div class="seat">B8</div>
            <div class="seat">B9</div>
            <div class="seat">B10</div>
            <div class="seat">B11</div>
            <div class="seat">B12</div>
            <div class="seat">B13</div>
            <div class="seat">B14</div>
        </div>

        <div class="seat-row">
            <div class="seat">C1</div>
            <div class="seat">C2</div>
            <div class="seat">C3</div>
            <div class="seat">C4</div>
            <div class="seat">C5</div>
            <div class="seat">C6</div>
            <div class="seat">C7</div>
            <div class="seat">C8</div>
            <div class="seat">C9</div>
            <div class="seat">C10</div>
            <div class="seat">C11</div>
            <div class="seat">C12</div>
        </div>
    </div>

    <!-- Chú thích -->
    <div class="legend mt-3">
        <div><div class="seat"></div> Ghế trống</div>
        <div><div class="seat selected"></div> Ghế đang chọn</div>
        <div><div class="seat reserved"></div> Ghế đặt trước</div>
        <div><div class="seat occupied"></div> Ghế đã bán</div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // JavaScript để chọn ghế
        const seats = document.querySelectorAll('.seat:not(.occupied)');
        seats.forEach(seat => {
            seat.addEventListener('click', () => {
                if (!seat.classList.contains('selected')) {
                    seat.classList.add('selected');
                } else {
                    seat.classList.remove('selected');
                }
            });
        });
    </script>

</body>
</html>
