var modalTrailer = document.getElementById("trailerModal-trailer");
var openModalBtn = document.getElementById("openModalBtn-trailer");
var closeModalTrailer = document.getElementsByClassName("close-trailer")[0];
var iframeTrailer = modalTrailer.querySelector("iframe");  // Lấy iframe trong modal
var originalSrc = iframeTrailer.src;  // Lưu lại src gốc của iframe

// Open modalTrailer
openModalBtn.onclick = function () {
    iframeTrailer.src = originalSrc;  // Gán lại src khi mở modal
    modalTrailer.style.display = "block";
}

// Close modalTrailer
closeModalTrailer.onclick = function () {
    modalTrailer.style.display = "none";
    iframeTrailer.src = "";  // Xóa src khi đóng modal để dừng video và tránh mờ
}

// Close modalTrailer when clicking outside of the modalTrailer content
window.onclick = function (event) {
    if (event.target == modalTrailer) {
        modalTrailer.style.display = "none";
        iframeTrailer.src = "";  // Xóa src khi đóng modal
    }
}
