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
document.getElementById('decrease').addEventListener('click', function () {
    var quantityInput = document.getElementById('quantity-input');
    var currentValue = parseInt(quantityInput.value);

    if (currentValue >= 1) {
        quantityInput.value = currentValue - 1;
    }
});

document.getElementById('increase').addEventListener('click', function () {
    var quantityInput = document.getElementById('quantity-input');
    var currentValue = parseInt(quantityInput.value);

    quantityInput.value = currentValue + 1;
});

// Js cho đoạn nhập voucher và điểm trang thanh toán 
document.querySelectorAll('.voucher-title, .points-title').forEach(title => {
    title.addEventListener('click', function () {
        const section = this.parentElement;
        section.classList.toggle('active');
    });
});






