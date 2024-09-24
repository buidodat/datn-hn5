// Hàm mở modal
function openModalMovieScrening(movieId) {
    const modalMovieScrening = document.getElementById("modalMovieScrening");
    modalMovieScrening.style.display = "block"; // Mở modal
    // Lưu movie_id vào modal
    modalMovieScrening.setAttribute('data-movie-id', movieId);

    // Gửi AJAX để lấy dữ liệu xuất chiếu của phim
    const routeApi = `/api/movie/${movieId}/showtimes`;
    fetch(routeApi)
        .then(response => response.json())
        .then(data => {
            // Cập nhật nội dung modal với lịch chiếu nhận được
            console.log(data);
            updateModalContent(data);
        })
        .catch(error => {
            console.error('Error fetching showtimes:', error);
        });
}

// Đóng modal khi nhấn nút đóng
const spanClose = document.getElementsByClassName("closeModalMovieScrening")[0];
spanClose.onclick = function () {
    const modalMovieScrening = document.getElementById("modalMovieScrening");
    modalMovieScrening.style.display = "none"; // Đóng modal
}

// Đóng modal khi nhấn bên ngoài modal
window.onclick = function (event) {
    const modalMovieScrening = document.getElementById("modalMovieScrening");
    if (event.target == modalMovieScrening) {
        modalMovieScrening.style.display = "none"; // Đóng modal
    }
}

function updateModalContent(data) {
    const modalContent = document.querySelector('.modalMovieScrening-content'); // Lấy modal content

    // Xóa toàn bộ nội dung trong modalContent
    modalContent.innerHTML = '';

    // Thêm tiêu đề modal
    const modalHeader = document.createElement('div');
    modalHeader.classList.add('modalMovieScrening-header');

    const modalTitle = document.createElement('span');
    modalTitle.classList.add('modalMovieScrening-title');
    modalTitle.textContent = 'LỊCH CHIẾU - Cám'; // Bạn có thể thay đổi tiêu đề tùy theo dữ liệu

    const closeModalButton = document.createElement('span');
    closeModalButton.classList.add('closeModalMovieScrening');
    closeModalButton.innerHTML = '&times;';

    // Gắn sự kiện đóng modal
    closeModalButton.onclick = function () {
        const modalMovieScrening = document.getElementById("modalMovieScrening");
        modalMovieScrening.style.display = "none"; // Đóng modal
    };

    modalHeader.appendChild(modalTitle);
    modalHeader.appendChild(closeModalButton);
    modalContent.appendChild(modalHeader); // Thêm header vào modalContent

    // Thêm tiêu đề rạp chiếu (cinema-title)
    const cinemaTitle = document.createElement('h2');
    cinemaTitle.classList.add('cinema-title');
    cinemaTitle.textContent = 'Rạp Poly Hà Đông'; // Bạn có thể thay đổi tên rạp tùy theo dữ liệu thực tế

    // Thêm tiêu đề rạp vào modalContent
    modalContent.appendChild(cinemaTitle);

    // Tạo phần Date Picker (listMovieScrening-date)
    const datePickerDiv = document.createElement('div');
    datePickerDiv.classList.add('listMovieScrening-date');

    data.dates.forEach((date, index) => {
        const dateItemDiv = document.createElement('div');
        dateItemDiv.classList.add('movieScrening-date-item');
        if (index === 0) dateItemDiv.classList.add('active'); // Set ngày đầu tiên là active
        dateItemDiv.setAttribute('data-day', date.day_id);
        dateItemDiv.textContent = date.date_label;

        // Gắn sự kiện chọn ngày
        dateItemDiv.onclick = function () {
            // Xóa class 'active' khỏi tất cả các ngày chiếu
            document.querySelectorAll('.movieScrening-date-item').forEach(item => item.classList.remove('active'));
            // Thêm class 'active' cho ngày chiếu đang được chọn
            dateItemDiv.classList.add('active');

            // Ẩn tất cả các suất chiếu
            document.querySelectorAll('.movieScrening-list-showtime-day').forEach(showtime => showtime.style.display = 'none');
            // Hiển thị suất chiếu tương ứng với ngày được chọn
            document.getElementById(date.day_id).style.display = 'block';
        };

        datePickerDiv.appendChild(dateItemDiv);
    });

    // Thêm Date Picker vào modalContent
    modalContent.appendChild(datePickerDiv);

    // Tạo nội dung suất chiếu
    data.dates.forEach((date, index) => {
        const dateDiv = document.createElement('div');
        dateDiv.classList.add('movieScrening-list-showtime-day');
        dateDiv.id = date.day_id;

        // Hiển thị ngày đầu tiên, ẩn các ngày khác
        if (index === 0) {
            dateDiv.style.display = 'block';
        } else {
            dateDiv.style.display = 'none';
        }

        const showtimeVersion = document.createElement('div');
        showtimeVersion.classList.add('movieScrening-showtime-version');

        const versionMovie = document.createElement('h4');
        versionMovie.classList.add('version-movie');
        versionMovie.textContent = '2D phụ đề'; // Bạn có thể điều chỉnh theo định dạng suất chiếu

        const listShowtimes = document.createElement('div');
        listShowtimes.classList.add('list-showtimes');

        date.showtimes.forEach(showtime => {
            const showtimeItem = document.createElement('div');
            showtimeItem.classList.add('showtime-item');

            const startTime = document.createElement('div');
            startTime.classList.add('showtime-item-start-time');
            startTime.textContent = showtime.start_time; // Format lại nếu cần

            const emptySeat = document.createElement('div');
            emptySeat.classList.add('empty-seat-showtime');
            emptySeat.textContent = '150 ghế trống'; // Hoặc cập nhật số ghế trống từ dữ liệu

            showtimeItem.appendChild(startTime);
            showtimeItem.appendChild(emptySeat);
            listShowtimes.appendChild(showtimeItem);
        });

        showtimeVersion.appendChild(versionMovie);
        showtimeVersion.appendChild(listShowtimes);
        dateDiv.appendChild(showtimeVersion);
        modalContent.appendChild(dateDiv);
    });
}
