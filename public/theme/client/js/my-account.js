$(document).ready(function () {
    $("#uploadBtn").click(function () {
        $("#file-upload").click();
    });

    $("#file-upload").change(function () {
        const reader = new FileReader();
        reader.onload = function (e) {
            $("#imagePlaceholder").html('<img src="' + e.target.result + '" class="img-fluid" alt="Uploaded Image">');
        };
        reader.readAsDataURL(this.files[0]);
    });

    $("#changePasswordBtn").click(function (e) {
        e.preventDefault();
        $("#overlay, #changePasswordForm").show();
    });

    $("#closeChangePassword").click(function () {
        $("#overlay, #changePasswordForm").hide();
    });
});
// document.getElementById('uploadBtn').addEventListener('click', function() {
//     document.getElementById('file-upload').click();
// });

// document.getElementById('file-upload').addEventListener('change', function(event) {
//     var file = event.target.files[0];
//     if (file) {
//         var reader = new FileReader();
//         reader.onload = function(e) {
//             var image = document.getElementById('previewImage');
//             image.src = e.target.result;
//             image.style.display = 'block'; // Hiển thị ảnh
//             document.getElementById('noImageText').style.display = 'none'; // Ẩn chữ "No Image"
//         };
//         reader.readAsDataURL(file); // Đọc file ảnh
//     }
// });