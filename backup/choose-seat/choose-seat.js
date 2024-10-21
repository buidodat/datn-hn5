import './bootstrap';
document.addEventListener('DOMContentLoaded', () => {
    const seats = document.querySelectorAll('.seat');
    const selectedSeatsDisplay = document.getElementById('selected-seats');
    const hiddenSelectedSeats = document.getElementById('hidden-selected-seats');
    const hiddenSeatIds = document.getElementById('hidden-seat-ids');
    const totalPriceElement = document.getElementById('total-price');
    const hiddenTotalPrice = document.getElementById('hidden-total-price');
    const submitButton = document.getElementById('submit-button');
    const showtimeId = document.getElementById('showtime-id').value; // Đảm bảo có trường hidden với id này

    let selectedSeats = [];
    let selectedSeatIds = [];
    let totalPrice = 0;

    seats.forEach(seat => {
        seat.addEventListener('click', async () => {
            const seatId = seat.getAttribute('data-seat-id');
            const seatLabel = seat.querySelector('.seat-label').textContent;
            const seatPrice = parseInt(seat.getAttribute('data-seat-price'));

            if (!seat.classList.contains('hold') && !seat.classList.contains('sold')) {
                if (seat.classList.contains('selected')) {
                    // Bỏ chọn ghế
                    selectedSeats = selectedSeats.filter(s => s !== seatLabel);
                    selectedSeatIds = selectedSeatIds.filter(id => id !== seatId);
                    totalPrice -= seatPrice;

                    seat.classList.remove('selected');
                    seat.classList.add('available');

                    try {
                        axios.post('/release-seats', {
                            seat_ids: [seatId],
                            showtime_id: showtimeId
                        }).then(response => {
                            console.log(response.data.message);
                        }).catch(error => {
                            console.error(error.response.data.message);
                        });
                    } catch (error) {
                        console.error('Error releasing seat:', error);
                        // Khôi phục trạng thái ghế nếu lỗi
                        seat.classList.remove('available');
                        seat.classList.add('selected');
                    }
                } else {
                    if (selectedSeats.length < 8) {
                        selectedSeats.push(seatLabel);
                        selectedSeatIds.push(seatId);
                        totalPrice += seatPrice;

                        seat.classList.add('selected');
                        seat.classList.remove('available');

                        try {
                            axios.post('/hold-seats', {
                                seat_ids: [seatId],
                                showtime_id: showtimeId
                            }).then(response => {
                                console.log(response.data.message);
                            }).catch(error => {
                                console.error(error.response.data.message);
                            });
                        } catch (error) {
                            console.error('Error holding seat:', error);
                            // Khôi phục trạng thái ghế nếu lỗi
                            seat.classList.remove('selected');
                            seat.classList.add('available');
                        }
                    } else {
                        alert('Bạn chỉ được chọn tối đa 8 ghế!');
                    }
                }

                selectedSeatsDisplay.textContent = selectedSeats.join(', ');
                hiddenSelectedSeats.value = selectedSeats.join(',');
                hiddenSeatIds.value = JSON.stringify(selectedSeatIds);
                totalPriceElement.textContent = totalPrice.toLocaleString() + ' Vnđ';
                hiddenTotalPrice.value = totalPrice;
            } else {
                if(seat.classList.contains('hold')){
                    alert('Ghế này đã được giữ!');
                }
                if(seat.classList.contains('sold')){
                    alert('Ghế này đã được bán!');
                }
            }
        });
    });

    window.Echo.channel(`showtime.${showtimeId}`)
        .listen('SeatHold', (e) => {
            const seatElement = document.getElementById(`seat-${e.seatId}`);
            if (seatElement && !seatElement.classList.contains('selected')) {
                seatElement.classList.add('hold');
                seatElement.classList.remove('available');
            }
        })
        .listen('SeatRelease', (e) => {
            const seatElement = document.getElementById(`seat-${e.seatId}`);
            if (seatElement) {
                console.log(`Seat ${e.seatId} is being released.`); // Thêm log để kiểm tra sự kiện
    
                if (seatElement.classList.contains('selected')) {
                    // Nếu ghế đã được chọn và giữ chỗ hết hạn, tự động bỏ chọn
                    const seatLabel = seatElement.querySelector('.seat-label').textContent;
                    const seatId = seatElement.getAttribute('data-seat-id');
                    const seatPrice = parseInt(seatElement.getAttribute('data-seat-price'));
    
                    // Xóa khỏi danh sách ghế đã chọn
                    selectedSeats = selectedSeats.filter(s => s !== seatLabel);
                    selectedSeatIds = selectedSeatIds.filter(id => id !== seatId);
                    totalPrice -= seatPrice;
    
                    // Cập nhật lại giao diện
                    selectedSeatsDisplay.textContent = selectedSeats.join(', ');
                    hiddenSelectedSeats.value = selectedSeats.join(',');
                    hiddenSeatIds.value = JSON.stringify(selectedSeatIds);
                    totalPriceElement.textContent = totalPrice.toLocaleString() + ' Vnđ';
                    hiddenTotalPrice.value = totalPrice;
    
                    // Loại bỏ trạng thái 'selected'
                    seatElement.classList.remove('selected');
                }
    
                // Đưa ghế trở lại trạng thái 'available'
                seatElement.classList.remove('hold');
                seatElement.classList.add('available');
            }
        });

    // Hàm kiểm tra xem có ghế trống nằm giữa hai ghế được chọn không (cho ghế sole)
    function checkSoleSeats() {
        const rows = document.querySelectorAll('.table-seat tr'); // Mỗi hàng trong bảng ghế
        let soleSeatsMessage = ''; // Chuỗi thông báo ghi lại các ghế bị trống
        let isSoleSeatIssue = false;

        rows.forEach(row => {
            const seatsInRow = Array.from(row.querySelectorAll('.seat')); // Các ghế trong hàng này
            let selectedIndexes = []; // Danh sách các index của ghế đã chọn trong hàng

            // Lấy index của các ghế được chọn trong hàng
            seatsInRow.forEach((seat, index) => {
                if (seat.classList.contains('selected')) {
                    selectedIndexes.push(index);
                }
            });

            // Kiểm tra nếu có ghế trống nằm giữa hai ghế được chọn (chỉ khi có đúng 1 ghế bị trống)
            for (let i = 0; i < selectedIndexes.length - 1; i++) {
                const gap = selectedIndexes[i + 1] - selectedIndexes[i];
                if (gap === 2) { // Nếu chỉ có 1 ghế trống giữa hai ghế đã chọn
                    isSoleSeatIssue = true;
                    const emptySeatIndex = selectedIndexes[i] + 1;
                    soleSeatsMessage += seatsInRow[emptySeatIndex].querySelector('.seat-label').textContent + ' ';
                }
            }
        });

        return {
            isSoleSeatIssue,
            soleSeatsMessage
        };
    }

    // Hàm kiểm tra xem ghế ngoài cùng có bị trống không khi ghế ngay cạnh được chọn
    function checkAdjacentEdgeSeats() {
        const rows = document.querySelectorAll('.table-seat tr'); // Mỗi hàng trong bảng ghế
        let edgeSeatsMessage = ''; // Chuỗi thông báo ghi lại các ghế ngoài cùng bị trống
        let isEdgeSeatIssue = false;

        rows.forEach(row => {
            const seatsInRow = row.querySelectorAll('.seat'); // Các ghế trong hàng này
            if (seatsInRow.length >= 2) {
                const firstSeat = seatsInRow[0]; // Ghế ngoài cùng trái
                const secondSeat = seatsInRow[1]; // Ghế ngay bên cạnh ghế ngoài cùng trái

                const lastSeat = seatsInRow[seatsInRow.length - 1]; // Ghế ngoài cùng phải
                const beforeLastSeat = seatsInRow[seatsInRow.length - 2]; // Ghế ngay bên cạnh ghế ngoài cùng phải

                // Kiểm tra điều kiện ghế ngoài cùng không được chọn và ghế bên cạnh nó được chọn
                // Nhưng nếu ghế ngoài cùng đã được chọn thì không cần kiểm tra nữa
                if (!firstSeat.classList.contains('selected') && secondSeat.classList.contains('selected')) {
                    isEdgeSeatIssue = true;
                    edgeSeatsMessage += firstSeat.querySelector('.seat-label').textContent + ' ';
                }
                if (!lastSeat.classList.contains('selected') && beforeLastSeat.classList.contains('selected')) {
                    isEdgeSeatIssue = true;
                    edgeSeatsMessage += lastSeat.querySelector('.seat-label').textContent + ' ';
                }
            }
        });

        return {
            isEdgeSeatIssue,
            edgeSeatsMessage
        };
    }

    // Kiểm tra cả hai điều kiện trước khi submit form
    submitButton.addEventListener('click', (event) => {
        const { isEdgeSeatIssue, edgeSeatsMessage } = checkAdjacentEdgeSeats();
        const { isSoleSeatIssue, soleSeatsMessage } = checkSoleSeats();

        if (selectedSeats.length === 0) {
            event.preventDefault();
            alert('Bạn chưa chọn ghế nào! Vui lòng chọn ghế trước khi tiếp tục.');
            return false;
        } else if (selectedSeats.length > 8) {
            event.preventDefault();
            alert('Bạn chỉ được chọn tối đa 8 ghế!');
        } else if (isEdgeSeatIssue) {
            event.preventDefault();
            alert(`Bạn không được để trống ghế: ${edgeSeatsMessage}`);
            return false;
        } else if (isSoleSeatIssue) {
            event.preventDefault();
            alert(`Bạn không được để trống ghế: ${soleSeatsMessage}`);
            return false;
        }
    });
});
