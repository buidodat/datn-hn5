
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
            const selectedShowtimeDiv = document.getElementById(date.day_id);
            selectedShowtimeDiv.style.display = 'block';

            // Kiểm tra nếu không có suất chiếu
            const noShowtimeMessage = selectedShowtimeDiv.querySelector('.no-showtime-message');
            if (noShowtimeMessage) {
                noShowtimeMessage.style.display = selectedShowtimeDiv.querySelectorAll('.showtime-item').length === 0 ? 'block' : 'none';
            }
        };

        datePickerDiv.appendChild(dateItemDiv);
    });

    // Thêm Date Picker vào modal
    modalBody.appendChild(datePickerDiv);

    // Tạo nội dung suất chiếu
    let hasShowtimes = false; // Biến kiểm tra xem có suất chiếu không
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

        // Kiểm tra nếu có suất chiếu
        if (date.showtimes.length === 0) {
            const noShowtimeMessage = document.createElement('div');
            noShowtimeMessage.classList.add('no-showtime-message');
            noShowtimeMessage.textContent = 'Hiện tại không có suất chiếu nào'; // Thông báo khi không có suất chiếu
            noShowtimeMessage.style.display = 'block'; // Hiển thị thông báo
            dateDiv.appendChild(noShowtimeMessage);
        } else {
            hasShowtimes = true; // Có suất chiếu
            date.showtimes.forEach(showtime => {
                const showtimeItem = document.createElement('div');
                showtimeItem.classList.add('showtime-item');

                const startTime = document.createElement('div');
                startTime.classList.add('showtime-item-start-time');
                startTime.textContent = showtime.start_time; // Format lại nếu cần

                // Gắn sự kiện click vào startTime để hiển thị showtime_id
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
        }

        showtimeVersion.appendChild(versionMovie);
        showtimeVersion.appendChild(listShowtimes);
        dateDiv.appendChild(showtimeVersion);
        modalBody.appendChild(dateDiv);
    });

    // Nếu không có suất chiếu nào trong tất cả các ngày
    if (!hasShowtimes) {
        const noShowtimeMessage = document.createElement('div');
        noShowtimeMessage.classList.add('no-showtime-message');
        noShowtimeMessage.textContent = 'Hiện tại không có suất chiếu nào cho phim này.';
        noShowtimeMessage.style.display = 'block';
        modalBody.appendChild(noShowtimeMessage);
    }
}


