<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn Poly Cinemas</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #444;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            font-size: 16px;
        }

        .barcode {
            text-align: center;
            margin: 20px 0;
        }

        .barcode p {
            text-align: center;
            margin: 5px 0;
        }

        h4 {
            /* font-size: 26px; */
            text-align: center;
            color: #333;
            /* margin-bottom: 15px;
            letter-spacing: 1px; */
        }

        h2 {
            font-size: 20px;
            color: #e50914;
            margin: 25px 0 10px;
            border-bottom: 1px solid #e9e9e9;
            padding-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .info-section {
            margin-bottom: 25px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table th,
        .info-table td {
            padding: 7px 10px;
        }

        .info-table th {
            text-align: left;
            font-weight: bold;
            color: #666;
        }

        .info-table td {
            text-align: right;
        }

        .info-table td:first-child {
            text-align: left;
            color: #444;
        }

        .total-row {
            font-size: 20px;
            font-weight: bold;
            color: #e50914;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 40px;
            border-top: 2px solid #e50914;
            padding-top: 20px;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: #e50914;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .highlight {
            color: #e50914;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        @php
            // Khởi tạo tên file duy nhất
            $fileName = $ticket->code . '.png';

            // Đường dẫn đầy đủ đến file trong public/storage/barcodes
            $filePath = public_path($fileName);

            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            if (!file_exists(public_path('storage/barcodes'))) {
                mkdir(public_path('storage/barcodes'), 0777, true);
            }

            // Tạo mã vạch và lưu vào file
            \DNS1D::getBarcodePNGPath($ticket->code, 'C128', 1.5, 50, [0, 0, 0], true, $filePath);
        @endphp


        <div class="barcode">
            <img src="{{ asset('barcodes/' . $fileName) }}" alt="Barcode">
            <p>{{ $ticket->code }}</p>
        </div>

        <h4>Thông Tin Vé</h4>

        <div class="info-section">
            <table class="info-table">
                <tr>
                    <th>Mã vé</th>
                    <td>918079712</td>
                </tr>
                <tr>
                    <th>Tên phim</th>
                    <td>VÂY HÃM TRÊN KHÔNG</td>
                </tr>
                <tr>
                    <th>Rạp</th>
                    <td>CGV Indochina Plaza Ha Noi</td>
                </tr>
                <tr>
                    <th>Phòng chiếu</th>
                    <td>Cinema 7</td>
                </tr>
                <tr>
                    <th>Suất chiếu</th>
                    <td>06/08/2024 20:50</td>
                </tr>
                <tr>
                    <th>Ghế</th>
                    <td>E6, E5, E4, E3, E2, E1</td>
                </tr>
                <tr>
                    <th>Giá</th>
                    <td>6 x 104.909đ</td>
                </tr>
            </table>
        </div>

        <h2>Chi Tiết Concession</h2>

        <div class="info-section">
            <table class="info-table">
                <tr>
                    <th>CGV Combo MR 2022 (ONLINE)</th>
                    <td>3 x 119.000đ</td>
                </tr>
                <tr class="total-row">
                    <th>Tổng Cộng</th>
                    <td>986.454đ</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p><span class="highlight">Poly Cinemas Việt Nam</span></p>
       
            <p>Hotline: 1900 6017</p>
        </div>
    </div>
</body>

</html>