<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Chiếu - Modal</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
        }

        .modalMovieScrening-header {
            border-bottom: none;
            padding: 15px;
            background-color: #f2f2f2;
        }

        .modalMovieScrening-title {
            font-size: 23px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .modalMovieScrening-content {
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 70%;
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
            animation: fadeIn 0.3s;
            max-height: 80vh;
            /* Giới hạn chiều cao tối đa */
        }

        .modalMovieScrening-body {
            padding: 0 20px;
            overflow-y: auto;
            /* Thêm cuộn dọc */
            max-height: 70vh;
            /* Chiều cao tối đa cho nội dung modal */
            margin-bottom: 30px;
            min-height: 50vh;
        }


        .cinema-title {
            font-size: 23px;
            font-weight: bold;
            margin: 25px 0;
            text-align: center;
        }

        /* Date Picker Styles */
        .listMovieScrening-date {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 0 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;

        }

        .listMovieScrening-date div {
            cursor: pointer;
            font-size: 18px;
            font-weight: normal;
            color: #666;
            padding: 10px 8px;
            margin: 5px 0;


        }

        .listMovieScrening-date div.active {
            color: #000;
            font-weight: bold;
            border-bottom: 3px solid #007bff;
        }

        .listMovieScrening-date div:hover {
            color: #007bff;
        }

        .hidden {
            display: none;
        }

        /* Modal Styles */
        .modalMovieScrening {
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

        .modalMovieScrening-content {
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
        .closeModalMovieScrening {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            margin-top: -7px;
        }

        .closeModalMovieScrening:hover,
        .closeModalMovieScrening:focus {
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



        .btn:hover {
            background-color: #0056b3;
        }

        /* Responsive Styles for Tablets and Small Screens */
        @media (max-width: 1200px) {
            .modalMovieScrening-content {
                width: 60%;
            }


        }

        /* Responsive Styles for Tablets */
        @media (max-width: 992px) {
            .modalMovieScrening-content {
                width: 70%;
            }
        }

        /* Responsive Styles for Mobile */
        @media (max-width: 768px) {
            .modalMovieScrening-content {
                width: 85%;
            }

            .showtime {
                width: 30%;
            }

            .listMovieScrening-date div {
                width: 15%;
                font-size: 16px;
                padding: 5px 5px;
            }

            .listMovieScrening-date {
                display: flex;
                justify-content: flex-start;
            }

            .listMovieScrening-date {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 576px) {
            .modalMovieScrening-content {
                width: 90%;
            }

            .text-center {
                font-size: 13px;

                margin: 13px 0;

            }

            .modalMovieScrening-header {
                padding: 8px;
            }

            .modalMovieScrening-title {
                font-size: 13px;
            }

            .listMovieScrening-date {
                flex-wrap: wrap;
            }


            .listMovieScrening-date {
                display: flex;
                font-size: 16px;
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
            padding: 8px 18px;
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
            font-size: 13.5px;
            text-align: center;
            margin: 5px;

        }

        .movieScrening-list-showtime-day {
            display: none;
            /* Ẩn các lịch chiếu theo ngày */
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

    <!-- Button to Open the Modal -->
    <button class="btn" id="openModalMovieScrening">Mở Lịch Chiếu</button>

    <!-- The Modal -->
    <div id="modalMovieScrening" class="modalMovieScrening">
        <div class="modalMovieScrening-content">

            <!-- Modal Header -->
            <div class="modalMovieScrening-header">
                <span class="modalMovieScrening-title">LỊCH CHIẾU - Cám</span>
                <span class="closeModalMovieScrening">&times;</span>
            </div>

            <!-- Modal Body -->
            <div class="modalMovieScrening-body">
                <h2 class="cinema-title">Rạp Poly Mỹ Đình</h2>

                <!-- Date Picker -->
                <div class="listMovieScrening-date">
                    <div data-day="day250" class="movieScrening-date-item active">23/09 - T2</div>
                    <div data-day="day251" class="movieScrening-date-item">24/09 - T3</div>
                    <div data-day="day252" class="movieScrening-date-item">25/09 - T4</div>
                    <div data-day="day253" class="movieScrening-date-item">26/09 - T5</div>
                    <div data-day="day254" class="movieScrening-date-item">27/09 - T6</div>
                    <div data-day="day255" class="movieScrening-date-item">28/09 - T7</div>
                    <div data-day="day256" class="movieScrening-date-item">29/09 - CN</div>
                </div>


                <div class="movieScrening-list-showtime-day" id="day250">
                    <div class="movieScrening-showtime-version">
                        <h3 class="version-movie">2D phụ đề </h3>
                        <div class="list-showtimes">
                            <div class="showtime-item">
                                <div class="showtime-item-start-time">02:45</div>
                                <div class="empty-seat-showtime">135 ghế trống</div>
                            </div>
                            <div class="showtime-item">
                                <div class="showtime-item-start-time">02:45</div>
                                <div class="empty-seat-showtime">135 ghế trống</div>
                            </div>
                            <div class="showtime-item">
                                <div class="showtime-item-start-time">02:45</div>
                                <div class="empty-seat-showtime">135 ghế trống</div>
                            </div>
                            <div class="showtime-item">
                                <div class="showtime-item-start-time">02:45</div>
                                <div class="empty-seat-showtime">135 ghế trống</div>
                            </div>
                            <div class="showtime-item">
                                <div class="showtime-item-start-time">02:45</div>
                                <div class="empty-seat-showtime">135 ghế trống</div>
                            </div>
                            <div class="showtime-item">
                                <div class="showtime-item-start-time">02:45</div>
                                <div class="empty-seat-showtime">135 ghế trống</div>
                            </div>
                            <div class="showtime-item">
                                <div class="showtime-item-start-time">02:45</div>
                                <div class="empty-seat-showtime">135 ghế trống</div>
                            </div>
                            <div class="showtime-item">
                                <div class="showtime-item-start-time">02:45</div>
                                <div class="empty-seat-showtime">135 ghế trống</div>
                            </div>
                            <div class="showtime-item">
                                <div class="showtime-item-start-time">02:45</div>
                                <div class="empty-seat-showtime">135 ghế trống</div>
                            </div>

                        </div>
                    </div>
                    <div class="showtime-room-version">
                        <h3 class="version-movie">2D vietsub </h3>
                        <div class="list-showtimes">
                            <div class="showtime-item">
                                <div class="showtime-item-start-time">02:45</div>
                                <div class="empty-seat-showtime">135 ghế trống</div>
                            </div>
                            <div class="showtime-item">
                                <div class="showtime-item-start-time">02:45</div>
                                <div class="empty-seat-showtime">135 ghế trống</div>
                            </div>
                            <div class="showtime-item">
                                <div class="showtime-item-start-time">02:45</div>
                                <div class="empty-seat-showtime">135 ghế trống</div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>

        </div>
    </div>

    <script>
        // Modal functionality
        const modalMovieScrening = document.getElementById("modalMovieScrening");
        const openModalMovieScrening = document.getElementById("openModalMovieScrening");

        const spanClose = document.getElementsByClassName("closeModalMovieScrening")[0];

        openModalMovieScrening.onclick = function() {
            modalMovieScrening.style.display = "block";

            // Hiển thị dữ liệu cho ngày đầu tiên
            const firstDateItem = document.querySelector('.movieScrening-date-item');
            if (firstDateItem) {
                firstDateItem.click(); // Mô phỏng click vào ngày đầu tiên
            }
        }



        spanClose.onclick = function() {
            modalMovieScrening.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modalMovieScrening) {
                modalMovieScrening.style.display = "none";
            }
        }

        // Date selection functionality
        const dateItems = document.querySelectorAll('.movieScrening-date-item');
        const showtimeDays = document.querySelectorAll('.movieScrening-list-showtime-day');

        dateItems.forEach(dateItem => {
            dateItem.onclick = function() {
                // Remove active class from all date items
                dateItems.forEach(item => item.classList.remove('active'));

                // Add active class to the selected date item
                this.classList.add('active');

                // Hide all showtime days
                showtimeDays.forEach(showtime => showtime.style.display = 'none');

                // Show the selected show's time
                const dayId = this.getAttribute('data-day');
                document.getElementById(dayId).style.display = 'block';
            }
        });
    </script>

</body>

</html>
