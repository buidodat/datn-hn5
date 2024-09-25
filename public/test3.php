<!-- Button to Open the Modal -->
<style>
    /* Button to open modal */
    .modalConfirm-open-button {
        background-color: #0071ce;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .modalConfirm-open-button:hover {
        background-color: #005bb5;
    }

    /* Modal background */
    .modalConfirm {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    /* Modal content */
    .modalConfirm-content {
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 90%; /* Make it responsive */
        max-width: 600px; /* Limit maximum width */
        background-color: white;
        border-radius: 5px;
        overflow: hidden;
        animation: fadeIn 0.3s;
        max-height: 80vh;
        font-family: Arial, sans-serif;
    }

    .modalConfirm-close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        margin-top: -7px;
    }

    .modalConfirm-close:hover,
    .modalConfirm-close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Modal header */
    .modalConfirm-header {
        border-bottom: 2px solid #ddd; /* Add bottom border */
        padding: 15px;
        background-color: #f2f2f2;
    }

    .modalConfirm-title {
        font-size: 23px;
        font-weight: bold;
        color:#707070;
        text-transform: uppercase;
    }

    /* Movie title */
    .modalConfirm-movie-title {
        text-align: center;
        color: #0071ce;
        font-size: 28px;
        margin: 0;
        padding: 20px 0;
        border-bottom: solid #ccc 1px;
    }

    /* Table styling */
    .modalConfirm-table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
    }

    /* Style only the header with a bottom border */
    .modalConfirm-table-header {
        padding: 10px;
        font-size: 20px;
        font-weight: normal;
        color: gray;
        text-align: center;
        border-bottom: 2px solid #ddd; /* Only bottom border for header */
    }

    /* Table data */
    .modalConfirm-table-data {
        text-align: center;
        font-weight: bold;
        padding: 15px; /* Increased padding for more height */
        font-size: 20px;
        background-color: #f9f9f9;
    }

    /* Adjust row height */
    .modalConfirm-table-row {
        height: 70px; /* Adjust height as needed */
    }

    /* Footer button */
    .modalConfirm-footer {
        margin: 20px auto;
        text-align: center;
    }

    .modalConfirm-confirm-button {
        background-color: #0071ce;
        color: #fff;
        border: none;
        padding: 15px 30px;
        font-size: 18px;
        cursor: pointer;
        border-radius: 5px;
        margin: 0 auto;
    }

    .modalConfirm-confirm-button:hover {
        background-color: #005bb5;
    }

    /* Responsive styling */
    @media screen and (max-width: 768px) {
        .modalConfirm-title {
            font-size: 20px; /* Adjust title size for smaller screens */
        }

        .modalConfirm-movie-title {
            font-size: 24px; /* Adjust movie title size */
        }

        .modalConfirm-table-header,
        .modalConfirm-table-data {
            font-size: 16px; /* Adjust font size for table */
        }

        .modalConfirm-confirm-button {
            padding: 10px 20px; /* Adjust button size */
            font-size: 16px; /* Adjust button font size */
        }
    }

    @media screen and (max-width: 480px) {
        .modalConfirm-title {
            font-size: 18px; /* Further adjust title size */
        }

        .modalConfirm-movie-title {
            font-size: 22px; /* Further adjust movie title size */
        }

        .modalConfirm-table-header,
        .modalConfirm-table-data {
            font-size: 14px; /* Further adjust font size for table */
        }

        .modalConfirm-confirm-button {
            font-size: 14px; /* Adjust button font size */
            padding: 8px 16px; /* Adjust button padding */
        }

        .modalConfirm-open-button {
            font-size: 14px; /* Adjust open button font size */
            padding: 8px 16px; /* Adjust open button padding */
        }
    }
</style>

<!-- Button to open the modal -->
<button id="openModalConfirmBtn" class="modalConfirm-open-button">Đặt vé</button>

<!-- Modal container -->
<div id="ticketBookingModal" class="modalConfirm">
    <div class="modalConfirm-content">
        <div class="modalConfirm-header">
            <span class="modalConfirm-title">Bạn đang đặt vé xem phim</span>
            <span class="modalConfirm-close">&times;</span>
        </div>
        <div class="modalConfirm-body">
            <h2 class="modalConfirm-movie-title">Cám</h2>
            <table class="modalConfirm-table">
                <thead>
                    <tr class="modalConfirm-table-row">
                        <th class="modalConfirm-table-header">Rạp chiếu</th>
                        <th class="modalConfirm-table-header">Ngày chiếu</th>
                        <th class="modalConfirm-table-header">Giờ chiếu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="modalConfirm-table-row">
                        <td class="modalConfirm-table-data">Beta Thái Nguyên</td>
                        <td class="modalConfirm-table-data">25/09/2024</td>
                        <td class="modalConfirm-table-data">15:45</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modalConfirm-footer">
            <button class="modalConfirm-confirm-button">Đồng ý</button>
        </div>
    </div>
</div>

<script>
    // Get modal element
    var modalConfirm = document.getElementById("ticketBookingModal");

    // Get open modal button
    var openModalBtn = document.getElementById("openModalConfirmBtn");

    // Get close button
    var closeBtnConfirm = document.getElementsByClassName("modalConfirm-close")[0];

    // Open modal on button click
    openModalBtn.onclick = function() {
        modalConfirm.style.display = "flex"; // Change to 'flex' for centering content
    }

    // Close modal when clicking on close button
    closeBtnConfirm.onclick = function() {
        modalConfirm.style.display = "none";
    }

    // Close modal when clicking outside of the modal content
    window.onclick = function(event) {
        if (event.target == modalConfirm) {
            modalConfirm.style.display = "none";
        }
    }
</script>
