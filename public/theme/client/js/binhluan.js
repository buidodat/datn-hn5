//load binh luan
let comments = [];
let currentPage = 0;
const perPage = 3;
// const movieId = {{ $movie->id }};

function fetchComments() {
    fetch(`/movie/${movieId}/comments`)
        .then(response => response.json())
        .then(data => {
            comments = data;
            if (comments.length > perPage) {
                document.getElementById('prev').style.visibility = 'visible';
                document.getElementById('next').style.visibility = 'visible';
            } else {
                document.getElementById('prev').style.visibility = 'hidden';
                document.getElementById('next').style.visibility = 'hidden';
            }
            showComments();
        })
        .catch(error => console.error('Lỗi khi tải bình luận:', error));
}

function showComments() {
    const start = currentPage * perPage;
    const selectedComments = comments.slice(start, start + perPage);

    let html = '';

    selectedComments.forEach(comment => {
        html += `
        <div class="review">
            <div class="review-header">
                <span class="reviewer-name">${comment.user.name}</span>
                <div class="review-rating">
        `;

        for (let i = 1; i <= 5; i++) {
            if (i <= comment.rating) {
                html += `<span class="star">&#9733;</span>`;
            } else {
                html += `<span class="star empty">&#9733;</span>`;
            }
        }

        html += `
                <span class="review-score">${comment.rating}</span>
                </div>
            </div>
            <p class="review-content">${comment.description}</p>
            <div class="review-footer">
                <span class="review-date">${new Date(comment.created_at).toLocaleDateString()}</span>
            </div>
        </div>
        `;
    });

    document.getElementById('comments').innerHTML = html;

    document.getElementById('prev').disabled = currentPage === 0;
    document.getElementById('next').disabled = (currentPage + 1) * perPage >= comments.length;
}

function nextComments() {
    if ((currentPage + 1) * perPage < comments.length) {
        currentPage++;
        showComments();
    }
}

function previousComments() {
    if (currentPage > 0) {
        currentPage--;
        showComments();
    }
}

fetchComments();

//them binh luan
/*document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');
    const ratingScore = document.querySelector('.rating-score');
    let selectedRating = 0;

    stars.forEach(star => {
        star.addEventListener('mouseover', function () {
            resetStars();
            const value = parseInt(this.getAttribute('data-value'));
            highlightStars(value);
            ratingScore.textContent = `${value} điểm`;
        });

        // Handle mouseout event
        star.addEventListener('mouseout', function () {
            resetStars();
            let currentRating = selectedRating > 0 ? selectedRating : 0;
            highlightStars(currentRating);
            ratingScore.textContent = `${currentRating} điểm`;
        });

        star.addEventListener('click', function () {
            selectedRating = parseInt(this.getAttribute('data-value'));
            ratingInput.value = selectedRating;
            resetStars();
            highlightStars(selectedRating);
            ratingScore.textContent = `${selectedRating} điểm`;
        });
    });

    function highlightStars(rating) {
        stars.forEach(star => {
            if (parseInt(star.getAttribute('data-value')) <= rating) {
                star.classList.add('hover');
                star.classList.add('highlighted');
            } else {
                star.classList.remove('highlighted');
            }
        });
    }

    function resetStars() {
        stars.forEach(star => {
            star.classList.remove('hover');
        });
    }
});*/

document.addEventListener('DOMContentLoaded', function () {
    const starInputs = document.querySelectorAll('.rating input[type="radio"]');
    const ratingScoreDisplay = document.querySelector('.rating h3'); // Nơi hiển thị điểm
    let selectedRating = 0; // Lưu giá trị đã chọn

    starInputs.forEach(input => {
        const label = input.nextElementSibling;

        label.addEventListener('mouseover', function () {
            resetStars();
            highlightStars(input.value);
            ratingScoreDisplay.textContent = `${input.value} điểm`;
        });

        label.addEventListener('mouseout', function () {
            resetStars();
            highlightStars(selectedRating);
            ratingScoreDisplay.textContent = `${selectedRating} điểm`;
        });

        label.addEventListener('click', function () {
            selectedRating = input.value;
            highlightStars(selectedRating);
            ratingScoreDisplay.textContent = `${selectedRating} điểm`;
        });
    });

    function highlightStars(rating) {
        starInputs.forEach(input => {
            const starValue = parseInt(input.value);
            const label = input.nextElementSibling;

            if (starValue <= rating) {
                label.classList.add('highlighted');
            } else {
                label.classList.remove('highlighted');
            }
        });
    }

    function resetStars() {
        starInputs.forEach(input => {
            const label = input.nextElementSibling;
            label.classList.remove('highlighted');
        });
    }
});

