<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In vé</title>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .ticket-container {
            width: 300px;
            background-color: #ffe5e5;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            page-break-inside: avoid; /* Tránh việc chia vé ra thành 2 trang */
        }

        .ticket-header {
            text-align: center;
            margin-bottom: 10px;
        }

        .ticket-header h2 {
            font-size: 18px;
            font-weight: bold;
            color: #d63384;
        }

        .ticket-info {
            font-size: 14px;
        }

        .ticket-info p {
            margin-bottom: 5px;
        }

        .ticket-info strong {
            font-weight: bold;
        }

        .ticket-info .highlight {
            font-weight: bold;
            color: #d63384;
        }

        .tickets-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .tickets-group .ticket-container {
            width: 45%; /* Hai vé trong một hàng */
            margin-bottom: 10px;
        }

        /* Styles cho phần in */
        @media print {
            body * {
                visibility: hidden;
            }

            .ticket-page,
            .ticket-page * {
                visibility: visible;
            }

            .ticket-page {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                margin: 0;
                border: none;
                box-shadow: none;
            }

            @page {
                size: auto;
                margin: 10mm;
            }

            .no-print {
                display: none;
            }

            .tickets-group {
                page-break-before: always; /* Tạo tờ mới trước mỗi nhóm vé */
            }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="printTickets()" class="btn btn-success btn-sm">
            In tất cả vé
        </button>
    </div>

    <!-- Tạo 2 nhóm vé -->
    <div id="tickets">
        <!-- Tờ 1 (4 vé đầu tiên) -->
        <div class="ticket-page">
            <div class="tickets-group">
                <!-- Vé 1 -->
                <div class="ticket-container">
                    <div class="ticket-header">
                        <h2>Hóa đơn</h2>
                    </div>
                    <div class="ticket-info">
                        <p><strong>Chi nhánh: Hà Đông</strong></p>
                        <p>Địa chỉ: 1 Quang Trung</p>
                        <p>Phim: Avatar 2 (3D)</p>
                        <p>Phòng: 1 - Ghế: A1, A2</p>
                        <p><strong>Giá vé: 150.000 VND</strong></p>
                    </div>
                </div>

                <!-- Vé 2 -->
                <div class="ticket-container">
                    <div class="ticket-header">
                        <h2>Hóa đơn</h2>
                    </div>
                    <div class="ticket-info">
                        <p><strong>Chi nhánh: Hà Đông</strong></p>
                        <p>Địa chỉ: 1 Quang Trung</p>
                        <p>Phim: Avatar 2 (3D)</p>
                        <p>Phòng: 1 - Ghế: A3, A4</p>
                        <p><strong>Giá vé: 150.000 VND</strong></p>
                    </div>
                </div>

                <!-- Vé 3 -->
                <div class="ticket-container">
                    <div class="ticket-header">
                        <h2>Hóa đơn</h2>
                    </div>
                    <div class="ticket-info">
                        <p><strong>Chi nhánh: Hà Đông</strong></p>
                        <p>Địa chỉ: 1 Quang Trung</p>
                        <p>Phim: Avatar 2 (3D)</p>
                        <p>Phòng: 1 - Ghế: A5, A6</p>
                        <p><strong>Giá vé: 150.000 VND</strong></p>
                    </div>
                </div>

                <!-- Vé 4 -->
                <div class="ticket-container">
                    <div class="ticket-header">
                        <h2>Hóa đơn</h2>
                    </div>
                    <div class="ticket-info">
                        <p><strong>Chi nhánh: Hà Đông</strong></p>
                        <p>Địa chỉ: 1 Quang Trung</p>
                        <p>Phim: Avatar 2 (3D)</p>
                        <p>Phòng: 1 - Ghế: A7, A8</p>
                        <p><strong>Giá vé: 150.000 VND</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tờ 2 (4 vé còn lại) -->
        <div class="ticket-page">
            <div class="tickets-group">
                <!-- Vé 5 -->
                <div class="ticket-container">
                    <div class="ticket-header">
                        <h2>Hóa đơn</h2>
                    </div>
                    <div class="ticket-info">
                        <p><strong>Chi nhánh: Hà Đông</strong></p>
                        <p>Địa chỉ: 1 Quang Trung</p>
                        <p>Phim: Avatar 2 (3D)</p>
                        <p>Phòng: 2 - Ghế: B1, B2</p>
                        <p><strong>Giá vé: 150.000 VND</strong></p>
                    </div>
                </div>

                <!-- Vé 6 -->
                <div class="ticket-container">
                    <div class="ticket-header">
                        <h2>Hóa đơn</h2>
                    </div>
                    <div class="ticket-info">
                        <p><strong>Chi nhánh: Hà Đông</strong></p>
                        <p>Địa chỉ: 1 Quang Trung</p>
                        <p>Phim: Avatar 2 (3D)</p>
                        <p>Phòng: 2 - Ghế: B3, B4</p>
                        <p><strong>Giá vé: 150.000 VND</strong></p>
                    </div>
                </div>

                <!-- Vé 7 -->
                <div class="ticket-container">
                    <div class="ticket-header">
                        <h2>Hóa đơn</h2>
                    </div>
                    <div class="ticket-info">
                        <p><strong>Chi nhánh: Hà Đông</strong></p>
                        <p>Địa chỉ: 1 Quang Trung</p>
                        <p>Phim: Avatar 2 (3D)</p>
                        <p>Phòng: 2 - Ghế: B5, B6</p>
                        <p><strong>Giá vé: 150.000 VND</strong></p>
                    </div>
                </div>

                <!-- Vé 8 -->
                <div class="ticket-container">
                    <div class="ticket-header">
                        <h2>Hóa đơn</h2>
                    </div>
                    <div class="ticket-info">
                        <p><strong>Chi nhánh: Hà Đông</strong></p>
                        <p>Địa chỉ: 1 Quang Trung</p>
                        <p>Phim: Avatar 2 (3D)</p>
                        <p>Phòng: 2 - Ghế: B7, B8</p>
                        <p><strong>Giá vé: 150.000 VND</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // In tất cả vé sử dụng printJS
        function printTickets() {
            printJS({
                printable: 'tickets',
                type: 'html',
                targetStyles: ['*'],
                style: '@page { size: A4; margin: 10mm; }',
            });
        }
    </script>
</body>
</html>
