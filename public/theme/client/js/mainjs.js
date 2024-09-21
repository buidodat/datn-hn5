/*document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    let selectedRating = 0;

    stars.forEach(star => {
        // Handle hover event
        star.addEventListener('mouseover', function () {
            resetStars();
            const value = parseInt(this.getAttribute('data-value'));
            highlightStars(value);
            document.querySelector('.rating-score').innerText = `${value} điểm`;
        });

        // Handle mouseout event
        star.addEventListener('mouseout', function () {
            resetStars();
            if (selectedRating > 0) {
                highlightStars(selectedRating);
                document.querySelector('.rating-score').innerText = `${selectedRating} điểm`;
            } else {
                document.querySelector('.rating-score').innerText = `0 điểm`;
            }
        });

        // Handle click event to select rating
        star.addEventListener('click', function () {
            selectedRating = parseInt(this.getAttribute('data-value'));
            resetStars();
            highlightStars(selectedRating);
            document.querySelector('.rating-score').innerText = `${selectedRating} điểm`;
        });
    });

    function highlightStars(rating) {
        stars.forEach(star => {
            if (parseInt(star.getAttribute('data-value')) <= rating) {
                star.classList.add('hover');
            }
        });
    }

    function resetStars() {
        stars.forEach(star => {
            star.classList.remove('hover');
        });
    }
});*/

// Js cho tăng giảm số lượng trang thanh toán




document.addEventListener('DOMContentLoaded', function () {
    const decreaseBtns = document.querySelectorAll('.quantity-btn.decrease');   //dấu trừ
    const increaseBtns = document.querySelectorAll('.quantity-btn.increase');   //dấu cộng
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const totalPriceElement = document.querySelector('.total-price-checkout .total-price-checkout');
    const totalPriceInput = document.getElementById('total-price');

    // Hàm tính tổng tiền
    function calculateTotal() {
        let totalPrice = 0;

        quantityInputs.forEach(input => {
            const quantity = parseInt(input.value); //parseInt: chuyển thành số nguyên
            const pricePerCombo = parseInt(input.closest('tr').querySelector('.combo-price').dataset.price);
            totalPrice += quantity * pricePerCombo;
        });

        totalPriceElement.textContent = totalPrice.toLocaleString() + ' VNĐ';

        // Cập nhật tổng tiền trong ô input
        totalPriceInput.value = totalPrice;
    }

    // Sự kiện bấm nút tăng số lượng
    increaseBtns.forEach(button => {
        button.addEventListener('click', function () {
            const input = this.closest('.quantity-container').querySelector('.quantity-input');
            let currentValue = parseInt(input.value);
            const max = parseInt(input.getAttribute('max'));
            if (currentValue < max) { // Chỉ tăng nếu giá trị hiện tại nhỏ hơn max
                input.value = currentValue + 1;
                calculateTotal(); // Cập nhật tổng tiền
            }
        });
    });

    // Sự kiện bấm nút giảm số lượng
    decreaseBtns.forEach(button => {
        button.addEventListener('click', function () {
            const input = this.closest('.quantity-container').querySelector('.quantity-input');
            let currentValue = parseInt(input.value);
            if (currentValue > 0) { // Chỉ giảm khi giá trị lớn hơn 0
                input.value = currentValue - 1;
                calculateTotal(); // Cập nhật tổng tiền
            }
        });
    });
});



// Js cho đoạn nhập voucher và điểm trang thanh toán 
document.querySelectorAll('.voucher-title, .points-title').forEach(title => {
    title.addEventListener('click', function () {
        const section = this.parentElement;
        section.classList.toggle('active');
    });
});

//ajax voucher
$(document).ready(function () {
    $('#voucher-form').on('submit', function (e) {
        e.preventDefault();

        $('#apply-voucher-btn').attr('disabled', true);

        var formData = {
            code: $('#voucher_code').val(),
            _token: csrfToken
        };

        console.log(formData);

        $.ajax({
            url: routeUrl,
            type: "POST",
            data: formData,
            success: function (response) {
                var discountAmount = response.discount;
                var discountAmountFormated = response.discount.toLocaleString();

                $('#voucher-response').html(`
                        <div class="t-success" style="">${response.success}</div>
                        <div class="show-text">
                        <span>Voucher: <b>${response.voucher_code}</b></span>
                        <span>Giảm giá: <b>${discountAmountFormated}</b> vnđ</span>
                        <button id="cancel-voucher-btn" data-voucher-id="${response.id}">Hủy</button>
                        </div>
                    `);

                // Tính toán số tiền cần thanh toán
                var totalPrice = parseInt($('#total-price').val());
                var totalPricePayment = totalPrice - discountAmount;

                // Hiển thị số tiền cần thanh toán với toLocaleString
                $('.total-price-payment').text(totalPricePayment.toLocaleString() + ' VNĐ');
                $('.total-discount').text(discountAmount.toLocaleString() + ' VNĐ');

// js cho modal chọn suất chiếu trang home 

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.date-display').forEach(btn => {

        btn.addEventListener('click', () => {
            // console.log('Button clicked:', btn);

            const currentActive = document.querySelector('.date-display.active');
            if (currentActive) {
                currentActive.classList.remove('active');
            }
            btn.classList.add('active');
        });
    });
});

//
document.querySelectorAll('.location-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('.location-btn.active').classList.remove('active');
        btn.classList.add('active');
    });
});

// 
document.querySelectorAll('.format-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('.format-btn.active').classList.remove('active');
        btn.classList.add('active');
    });
});

// 
document.querySelectorAll('.time-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        // You can add custom functionality here for when a time is selected
        alert(`You selected the ${btn.innerText} showtime.`);
    });
});








                $('#apply-voucher-btn').attr('disabled', false);
                attachCancelVoucherEvent();
            },
            error: function (xhr) {
                var error = xhr.responseJSON.error || 'Voucher không hợp lệ';
                showModalError(error);
                $('#apply-voucher-btn').attr('disabled', false);
            }
        });
    });

    function showModalError(errorMessage) {
        const modalHTML = `
                    <div id="error-modal" class="modal">
                        <div class="modal-content" >
                            <p class="text-error">${errorMessage}</p>
                            <span class="close-modal button-error">Hủy</span>
                        </div>
                    </div>
                `;

        $('body').append(modalHTML);

        $('#error-modal').css('display', 'block');

        $('.close-modal').on('click', function () {
            $('#error-modal').remove();
        });

        $(window).on('click', function (event) {
            if ($(event.target).is('#error-modal')) {
                $('#error-modal').remove();
            }
        });
    }
});

//cancer voucher
// function attachCancelVoucherEvent() {
//     $('#voucher-response').on('click', '#cancel-voucher-btn', function () {
//         let voucherId = $(this).data('voucher-id');  // Lấy bằng đúng thuộc tính
//         console.log('Voucher ID:', voucherId);  // Kiểm tra ID trong console
//
//         if (voucherId !== undefined) {
//             $.ajax({
//                 url: "{{ route('cancelVoucher') }}",
//                 type: "POST",
//                 data: {
//                     voucher_id: voucherId,
//                     _token: '{{ csrf_token() }}'
//                 },
//                 success: function (response) {
//                     $('#voucher-response').html('<span class="success">' + response.success + '</span>');
//                 },
//                 error: function (xhr) {
//                     var error = xhr.responseJSON.error || 'Có lỗi xảy ra';
//                     $('#voucher-response').html('<span class="error">' + error + '</span>');
//                 }
//             });
//         } else {
//             console.error('Voucher ID is undefined.');
//         }
//     });
// }


