document.addEventListener('DOMContentLoaded', function () {
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
});

// Js cho tăng giảm số lượng trang thanh toán

// // Lấy tất cả các nút giảm số lượng
// document.querySelectorAll('.decrease').forEach((decreaseBtn, index) => {
//     decreaseBtn.addEventListener('click', function () {
//         var quantityInput = document.querySelectorAll('.quantity-input')[index];
//         var currentValue = parseInt(quantityInput.value);

//         if (currentValue >= 1) {
//             quantityInput.value = currentValue - 1;
//         }
//     });
// });

// // Lấy tất cả các nút tăng số lượng
// document.querySelectorAll('.increase').forEach((increaseBtn, index) => {
//     increaseBtn.addEventListener('click', function () {
//         var quantityInput = document.querySelectorAll('.quantity-input')[index];
//         var currentValue = parseInt(quantityInput.value);

//         quantityInput.value = currentValue + 1;
//     });
// });



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






