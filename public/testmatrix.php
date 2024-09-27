<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Selection</title>
    <style>
        table {
            border-collapse: collapse;
        }

        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        .seatRegular {
            background-color: #c8e6c9;
        }

        .seatDouble {
            background-color: #ffccbc;
        }

        .seatVip {
            background-color: #ffc107;
        }

        .select-all {
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Seat Selection</h2>

<table id="seatTable">
    <thead>
        <tr>
            <th></th> <!-- For row select -->
            <!-- Columns select checkboxes -->
            <th class="select-all" onclick="toggleColumnSelect(0)">Select All Col 1</th>
            <th class="select-all" onclick="toggleColumnSelect(1)">Select All Col 2</th>
            <th class="select-all" onclick="toggleColumnSelect(2)">Select All Col 3</th>
            <th class="select-all" onclick="toggleColumnSelect(3)">Select All Col 4</th>
            <th class="select-all" onclick="toggleColumnSelect(4)">Select All Col 5</th>
            <th class="select-all" onclick="toggleColumnSelect(5)">Select All Col 6</th>
            <th class="select-all" onclick="toggleColumnSelect(6)">Select All Col 7</th>
            <th class="select-all" onclick="toggleColumnSelect(7)">Select All Col 8</th>
            <th class="select-all" onclick="toggleColumnSelect(8)">Select All Col 9</th>
            <th class="select-all" onclick="toggleColumnSelect(9)">Select All Col 10</th>
        </tr>
    </thead>
    <tbody>
        <script>
            let rows = 10;
            let cols = 10;
            let rowSeatRegular = 4; // 4 hàng đầu là ghế thường
            let rowSeatDouble = 1; // 1 hàng cuối là ghế đôi

            // Create the table body
            for (let row = 0; row < rows; row++) {
                let tr = document.createElement('tr');

                // Create row select checkbox
                let rowSelectCell = document.createElement('td');
                let rowSelectCheckbox = document.createElement('input');
                rowSelectCheckbox.type = 'checkbox';
                rowSelectCheckbox.onclick = function () {
                    toggleRowSelect(row);
                };
                rowSelectCell.appendChild(rowSelectCheckbox);
                tr.appendChild(rowSelectCell);

                // Create the seats in the row
                for (let col = 0; col < cols; col++) {
                    let td = document.createElement('td');
                    let checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.classList.add('seatCheckbox');
                    checkbox.dataset.row = row;
                    checkbox.dataset.col = col;

                    // Set seat types based on row number
                    if (row < rowSeatRegular) {
                        td.classList.add('seatRegular');
                    } else if (row >= rows - rowSeatDouble) {
                        td.classList.add('seatDouble');
                    } else {
                        td.classList.add('seatVip');
                    }

                    td.appendChild(checkbox);
                    tr.appendChild(td);
                }

                document.getElementById('seatTable').appendChild(tr);
            }

            // Toggle row selection
            function toggleRowSelect(row) {
                let checkboxes = document.querySelectorAll(`input[data-row='${row}']`);
                let isChecked = checkboxes[0].checked;
                checkboxes.forEach(cb => {
                    cb.checked = isChecked;
                });
            }

            // Toggle column selection
            function toggleColumnSelect(col) {
                let checkboxes = document.querySelectorAll(`input[data-col='${col}']`);
                let isChecked = checkboxes[0].checked;
                checkboxes.forEach(cb => {
                    cb.checked = isChecked;
                });
            }
        </script>
    </tbody>
</table>

</body>
</html>
