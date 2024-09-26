<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Matrix</title>
    <style>
        .box-item-seat { width: 30px; height: 30px; }
        .light-orange { background-color: lightcoral; }
        .light-blue { background-color: lightblue; }
        table { border-collapse: collapse; }
        td, th { border: 1px solid #ccc; padding: 5px; }
    </style>
</head>
<body>

<!-- Dropdown select -->
<label for="matrix-size">Chọn ma trận ghế:</label>
<select id="matrix-size">
    <option value="11x11">11x11</option>
    <option value="12x12">12x12</option>
    <option value="13x13">13x13</option>
</select>

<!-- Table to display seat matrix -->
<div id="seat-matrix"></div>

<script>
    const seatMatrixContainer = document.getElementById('seat-matrix');
    const matrixSelect = document.getElementById('matrix-size');

    function generateSeatMatrix(rows, cols) {
        let matrixHTML = `<table class="table-chart-chair table-none align-middle mx-auto text-center">
            <thead>
                <tr>
                    <th></th>`;
        // Tạo cột
        for (let col = 0; col < cols; col++) {
            matrixHTML += `<th class="box-item">${col + 1}</th>`;
        }
        matrixHTML += `<th></th></tr></thead><tbody>`;

        // Tạo hàng ghế
        for (let row = 0; row < rows; row++) {
            matrixHTML += `<tr><td class="box-item">${String.fromCharCode(65 + row)}</td>`;
            for (let col = 0; col < cols; col++) {
                const seatData = {
                    x: col + 1,
                    y: String.fromCharCode(65 + row)
                };
                const seatJson = JSON.stringify(seatData);

                if (row < Math.floor(rows / 2)) {
                    // Ghế thường (hàng trên)
                    matrixHTML += `
                    <td class="box-item-seat border-1 light-orange">
                        <div class="box-item-seat-selected">
                            <img src="seat-regular.svg" class='seat' width="100%">
                            <input type="hidden" name="seatJsons[]" value='${seatJson}'>
                        </div>
                    </td>`;
                } else {
                    // Ghế VIP (hàng dưới)
                    matrixHTML += `
                    <td class="box-item-seat border-1 light-blue">
                        <div class="box-item-seat-selected">
                            <img src="seat-vip.svg" class='seat' width="100%">
                            <input type="hidden" name="seatJsons[]" value='${seatJson}'>
                        </div>
                    </td>`;
                }
            }
            matrixHTML += `<td class="box-item"></td></tr>`;
        }
        matrixHTML += `</tbody></table>`;
        return matrixHTML;
    }

    // Render initial seat matrix
    seatMatrixContainer.innerHTML = generateSeatMatrix(11, 11);

    // Handle seat matrix size change
    matrixSelect.addEventListener('change', function() {
        const [rows, cols] = this.value.split('x').map(Number);
        seatMatrixContainer.innerHTML = generateSeatMatrix(rows, cols);
    });
</script>

</body>
</html>
