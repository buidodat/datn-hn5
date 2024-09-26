
function openModalMovieScrening(movieId) {
    const modalMovieScrening = document.getElementById("modalMovieScrening");
    modalMovieScrening.style.display = "block"; // Mở modal
    // Lưu movie_id vào modal
    modalMovieScrening.setAttribute('data-movie-id', movieId);

    // Gửi AJAX để lấy dữ liệu xuất chiếu của phim
    const routeApi = `${APP_URL}/api/movie/${movieId}/showtimes`;
    fetch(routeApi)
        .then(response => response.json())
        .then(data => {
            // Cập nhật tiêu đề modal với tên phim từ dữ liệu
            document.getElementById("modalMovieTitle").textContent = `LỊCH CHIẾU - ${data.movie.name}`; // Giả sử bạn có thuộc tính movie_title trong data

            // Cập nhật nội dung modal với lịch chiếu nhận được
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
    const modalBody = document.querySelector('.modalMovieScrening-body');
    modalBody.innerHTML = ''; // Xóa nội dung cũ

    // Thêm tiêu đề rạp chiếu (cinema-title)
    const cinemaTitle = document.createElement('h2');
    cinemaTitle.classList.add('cinema-title');
    cinemaTitle.textContent = 'Rạp Poly Hà Đông'; // Bạn có thể thay đổi tên rạp tùy theo dữ liệu thực tế

    // Thêm tiêu đề rạp vào modal
    modalBody.appendChild(cinemaTitle);

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

    // Thêm Date Picker vào modal
    modalBody.appendChild(datePickerDiv);

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

            // // Gắn sự kiện click vào startTime để hiển thị showtime_id
            startTime.onclick = function () {
                alert(`Showtime ID: ${showtime.id}`); // Thay đổi showtime_id thành tên trường thực tế từ dữ liệu của bạn
            };
            startTime.onclick = function () {
                window.location.href = `${APP_URL}/choose-seat/${showtime.id}`; // Chuyển hướng đến trang chi tiết suất chiếu
            };

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
        modalBody.appendChild(dateDiv);
    });
}
