<div id="showtime-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <div class="showtime-container">
            <div class="date-display active">
                <div class="date-top">08</div>
                <div class="date-middle">31</div>
                <div class="date-bottom">T7</div>
            </div>
            <div class="date-display">
                <div class="date-top">09</div>
                <div class="date-middle">01</div>
                <div class="date-bottom">CN</div>
            </div>
            <div class="date-display">
                <div class="date-top">09</div>
                <div class="date-middle">02</div>
                <div class="date-bottom">T2</div>
            </div>
            <div class="date-display">
                <div class="date-top">09</div>
                <div class="date-middle">03</div>
                <div class="date-bottom">T3</div>
            </div>
            <div class="date-display">
                <div class="date-top">09</div>
                <div class="date-middle">04</div>
                <div class="date-bottom">T4</div>
            </div>
            <div class="date-display">
                <div class="date-top">09</div>
                <div class="date-middle">04</div>
                <div class="date-bottom">T4</div>
            </div>
            <div class="date-display">
                <div class="date-top">09</div>
                <div class="date-middle">04</div>
                <div class="date-bottom">T4</div>
            </div>



            <div class="location-selection">
                <button class="location-btn active">Hà Nội</button>
                <button class="location-btn">Hồ Chí Minh</button>
                <button class="location-btn">Huế</button>
                <button class="location-btn">Đà Nẵng</button>
            </div>

            <div class="format-selection">
                <button class="format-btn active">2D Phụ Đề</button>
                <button class="format-btn">Thuyết Minh</button>
                <button class="format-btn">VietSub</button>
                <button class="format-btn">3D</button>
               
            </div>

            <div class="showtimes">
                <div class="showtime-item">
                    <h3>Poly Hà Đông</h3>
                    <p>Rạp 2D</p>
                    <button class="time-btn">7:30 am</button>
                    <button class="time-btn">10:00 am</button>
                    <button class="time-btn">12:30 pm</button>
                    <button class="time-btn">14:00 pm</button>
                    <button class="time-btn">16:30 pm</button>
                    <button class="time-btn">20:00 pm</button>
                    <!-- Add more times as needed -->
                </div>
                <div class="showtime-item">
                    <h3>Poly Cầu Giấy</h3>
                    <p>Rạp 2D</p>
                    <button class="time-btn">7:30 am</button>
                    <button class="time-btn">10:00 am</button>
                    <!-- Add more times as needed -->
                </div>
                <div class="showtime-item">
                    <h3>Poly Thanh Xuân</h3>
                    <p>Rạp 2D</p>
                    <button class="time-btn">7:30 am</button>
                    <button class="time-btn">10:00 am</button>
                    <!-- Add more times as needed -->
                </div>
                <!-- Add more showtime-items as needed -->
            </div>
        </div>
    </div>
</div>

<script>
    // Handle date selection
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

    // Handle location selection
    document.querySelectorAll('.location-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelector('.location-btn.active').classList.remove('active');
            btn.classList.add('active');
        });
    });

    // Handle format selection
    document.querySelectorAll('.format-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelector('.format-btn.active').classList.remove('active');
            btn.classList.add('active');
        });
    });

    // Optional: Handle time selection (if needed)
    document.querySelectorAll('.time-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // You can add custom functionality here for when a time is selected
            alert(`You selected the ${btn.innerText} showtime.`);
        });
    });

    // Modal hiển thị 
    // Lấy các phần tử
    const modal = document.getElementById("showtime-modal");
    const btn = document.getElementById("buy-ticket-btn");
    const span = document.getElementsByClassName("close-btn")[0];

    // Khi người dùng click vào nút "Mua vé", modal sẽ hiển thị
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Khi người dùng click vào nút "X" (close), modal sẽ đóng lại
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Khi người dùng click ra ngoài modal, modal sẽ đóng lại
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
