<div class="ms-1 header-item d-none d-sm-flex">
    <div>
        <!-- center modal -->
        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-bs-toggle="modal"
                data-bs-target=".bs-example-modal-center"><i class='ri-qr-code-line fs-22'></i>
        </button>
        <div class="modal fade bs-example-modal-center" id="scanModal" tabindex="-1"
             aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="width: 680px; ">
                    <div class="modal-body text-center">
                        <div id="camera"
                             style="width: 640px; height: 360px; border: 1px solid gray; margin: 0 auto;"></div>
                        <div class="mt-4">
                            <h4 class="mb-3">Đưa mã vạch vào camera để quét</h4>
                            {{--<div id="message-result" style="color: #26ee26; margin-top: 10px;"></div>--}}
                            <div id="barcode-result" style="color: #eed223; margin-top: 10px;"></div>
                            <div id="error-message" style="color: red; margin-top: 10px;"></div>
                            <div class="hstack gap-2 justify-content-center">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng
                                </button>
                                <button type="button" class="btn btn-warning" id="scanAnotherBtn">Quét lại
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>

<script>
    /*modal quét qr*/
    document.addEventListener("DOMContentLoaded", function () {
        const scanModal = document.getElementById('scanModal');
        const scanAnotherBtn = document.getElementById("scanAnotherBtn");
        const errorMessage = document.getElementById("error-message");
        const barcodeResult = document.getElementById("barcode-result");

        // Khởi tạo sự kiện mở modal
        scanModal.addEventListener('shown.bs.modal', startScanner);
        scanModal.addEventListener('hidden.bs.modal', function () {
            stopScanner();
            clearBarcodeResult();
        });

        // Hàm khởi động Quagga
        function startScanner() {
            Quagga.init({
                inputStream: {
                    type: "LiveStream",
                    target: document.querySelector("#camera"),
                    constraints: {
                        width: 640,
                        height: 380,
                        facingMode: "user" // Thay đổi thành "environment" neeus sử dụng camera sau
                    }
                },
                decoder: {
                    readers: ["code_128_reader"]
                }
            }, function (err) {
                if (err) {
                    console.log("Lỗi: ", err);
                    errorMessage.innerText = "Không thể truy cập camera, vui lòng kiểm tra quyền truy cập!";
                    return;
                }
                Quagga.start();
            });

            Quagga.onDetected(detectedCode);
        }

        // Hàm dừng Quagga
        function stopScanner() {
            Quagga.stop();
            Quagga.offDetected(detectedCode);
        }

        // Hàm xử lý mã quét được
        function detectedCode(result) {
            const code = result.codeResult.code;
            barcodeResult.innerText = code; // Hiển thị mã vạch quét được
            stopScanner(); // Dừng scanner sau khi đọc được mã

            // Gửi mã code qua AJAX
            fetch('{{ route("admin.tickets.processScan") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({code: code})
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success && data.redirect_url) {
                        window.location.href = data.redirect_url;
                    }
                })
                .catch(error => {
                    console.error("Lỗi:", error);
                    errorMessage.innerText = 'Lỗi kết nối, vui lòng thử lại sau!';
                });
        }

        // Hàm xóa mã vạch và thông báo lỗi
        function clearBarcodeResult() {
            barcodeResult.innerText = ""; // Xóa mã vạch quét được khi mở lại modal
            errorMessage.innerText = ""; // Xóa thông báo lỗi nếu có
        }

        // Xử lý khi bấm nút "Quét lại mã khác"
        scanAnotherBtn.addEventListener("click", function () {
            barcodeResult.innerText = ""; // Xóa mã quét được trước đó
            errorMessage.innerText = ""; // Xóa thông báo lỗi
            startScanner(); // Bắt đầu quét lại
        });
    });
</script>
