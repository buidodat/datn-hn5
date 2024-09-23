<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Chiếu</title>
    <style>

        h3 {
            font-size: 1.1em; /* Kích thước nhỏ cho tiêu đề */
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .list-showtimes {
            display: flex;

            gap: 10px;
        }

        .showtime-item {
            width: 120px; /* Độ dài cố định */
            text-align: center; /* Căn giữa nội dung */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1.2em;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .showtime-item:hover {
            background-color: #f0f0f0;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .showtime-item {
                font-size: 1em; /* Kích thước nhỏ hơn cho màn hình nhỏ */
                width: 100px; /* Chiều dài nhỏ hơn cho màn hình nhỏ */
            }
        }
    </style>
</head>
<body>

<div class="showtime-room-version">
    <h3>Lịch Chiếu Hôm Nay</h3>
    <div class="list-showtimes">
        <div class="showtime-item">11:30 AM</div>
        <div class="showtime-item">02:45 PM</div>
        <div class="showtime-item">06:30 PM</div>
    </div>
</div>

</body>
</html>
<style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
        }

        .modal-header {
            border-bottom: none;
            padding: 15px;
            background-color: #f2f2f2;
        }

        .modal-title {
            font-size: 23px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .modal-body {
            padding: 0 20px;
        }

        .modal-footer {
            border-top: none;
            padding: 15px;
            text-align: right;
        }

        .cinema-title {
            font-size: 23px;
            font-weight: bold;
            margin: 25px 0;
            text-align: center;
        }

        /* Date Picker Styles */
        .list-date {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 0 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;

        }

        .list-date div {
            cursor: pointer;
            font-size: 18px;
            font-weight: normal;
            color: #666;
            padding: 10px 8px;
            margin: 5px 0;


        }

        .list-date div.active {
            color: #000;
            font-weight: bold;
            border-bottom: 3px solid #007bff;
        }

        .list-date div:hover {
            color: #007bff;
        }

        /* Showtime Section */
        .showtime-section {
            display: flex;

            flex-wrap: wrap;
            padding: 0 15px;
        }

        .showtime {
            text-align: center;
            background-color: #f8f9fa;
            padding: 10px;
            margin: 10px 0;
            width: 30%;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .showtime p {
            margin: 0;
        }

        .showtime p:first-child {
            font-size: 16px;
            font-weight: bold;
        }

        .showtime p:last-child {
            font-size: 12px;
            color: #777;
        }

        .hidden {
            display: none;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 100px;
            margin-bottom: 100px;
        }

        .modal-content {
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 70%;
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            margin-top: -7px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Button */
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Responsive Styles for Tablets and Small Screens */
        @media (max-width: 1200px) {
            .modal-content {
                width: 60%;
            }

            .showtime {
                width: 18%;
            }
        }

        /* Responsive Styles for Tablets */
        @media (max-width: 992px) {
            .modal-content {
                width: 70%;
            }

            .showtime {
                width: 22%;
            }
        }

        /* Responsive Styles for Mobile */
        @media (max-width: 768px) {
            .modal-content {
                width: 85%;
            }

            .showtime {
                width: 30%;
            }

            .list-date div {
                width: 18%;
                font-size: 13px;
                padding: 5px 5px;
            }

            .list-date {
                display: flex;
                justify-content: flex-start;
            }
        }

        @media (max-width: 576px) {
            .modal-content {
                width: 90%;
            }

            .text-center {
                font-size: 13px;

                margin: 13px 0;

            }

            .modal-header {
                padding: 8px;
            }

            .modal-title {
                font-size: 13px;
            }

            .list-date {
                flex-wrap: wrap;
            }

            .list-date div {
                width: 15%;
                font-size: 9px;
            }

            .btn {
                padding: 5px 8px;
                font-size: 15px;
            }

            .list-date {
                display: flex;
                justify-content: flex-start;
            }

        }

        .list-showtimes {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .showtime-item-start-time {
            width: 80px;
            text-align: center;
            padding: 8px 19px;
            border: 1px solid #ccc;
            font-size: 1.1em;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .showtime-item-start-time:hover {
            background-color: #f0f0f0;
        }

        .showtime-room-version {
            margin-top: 35px;
        }

        .empty-seat-showtime {
            font-size: 14px;
            text-align: center;
            margin: 5px;

        }

    </style>
