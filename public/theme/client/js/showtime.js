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
