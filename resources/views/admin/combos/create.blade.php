@extends('admin.layouts.master')

@section('title')
    Thêm mới Combo
@endsection

@section('content')
    <form action="{{ route('admin.combos.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thêm mới Combo</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.combos.index') }}">Danh sách</a></li>
                            <li class="breadcrumb-item active">Thêm mới</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- thông tin -->
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm thông tin Combo</h4>
                    </div><!-- end card header -->

                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12 px-4">
                                    <div class="row">
                                        <div id="food_list" class="col-md-12 mb-3">
                                            <div class="col-md-12 mb-1">
                                                <div class="d-flex">
                                                    <div class="col-md-8">
                                                        <label for="combo_food" class="form-label">Đồ ăn</label>
                                                        <select name="combo_food[]" id="combo_food"
                                                            class="form-control food-select">
                                                            <option value="">Chọn đồ ăn</option>
                                                            @foreach ($food as $item)
                                                                @if ($item->type == 'Đồ Ăn')
                                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('combo_food.0')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 mx-3">
                                                        <label for="combo_quantity" class="form-label">Số lượng</label>
                                                        <div class="d-flex flex-wrap align-items-start gap-2">
                                                            <div class="input-step step-primary">
                                                                <button type="button" class="minuss">-</button>
                                                                <input type="number" name="combo_quantity[]"
                                                                    class="product-quantity" value="0" min="0"
                                                                    max="10" readonly>
                                                                <button type="button" class="pluss">+</button>
                                                            </div>
                                                        </div>
                                                        @error('combo_quantity.0')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="food_list" class="col-md-12">
                                            <div class="col-md-12 mb-1">
                                                <div class="d-flex">
                                                    <div class="col-md-8">
                                                        <label for="combo_food" class="form-label">Nước uống</label>
                                                        <select name="combo_food[]" id="combo_food"
                                                            class="form-control food-select">
                                                            <option value="">Chọn nước uống</option>
                                                            @foreach ($food as $item)
                                                                @if ($item->type == 'Nước Uống')
                                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('combo_food.1')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 mx-3">
                                                        <label for="combo_quantity" class="form-label">Số lượng</label>
                                                        <div class="d-flex flex-wrap align-items-start gap-2">
                                                            <div class="input-step step-primary">
                                                                <button type="button" class="minuss">-</button>
                                                                <input type="number" name="combo_quantity[]"
                                                                    class="product-quantity" value="0" min="0"
                                                                    max="10" readonly>
                                                                <button type="button" class="pluss">+</button>
                                                            </div>
                                                        </div>
                                                        @error('combo_quantity.1')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="name" class="form-label "> <span class="text-danger">*</span>Tên
                                                combo</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}" placeholder="Nhập tên combo">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="price" class="form-label ">Giá gốc</label>
                                            <input type="number" class="form-control" id="price" name="price"
                                                value="0" disabled>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="price_sale" class="form-label "> <span
                                                    class="text-danger">*</span>Giá bán</label>
                                            <input type="number" class="form-control" id="price_sale" name="price_sale"
                                                value="{{ old('price_sale') }}" placeholder="Nhập giá bán">
                                            @error('price_sale')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="description" class="form-label"> <span
                                                    class="text-danger">*</span>Mô tả ngắn</label>
                                            <textarea class="form-control" rows="3" name="description" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-2">
                                    <label for="img_thumbnail" class="form-label"> <span class="text-danger">*</span>Hình
                                        ảnh</label>
                                    <input type="file" name="img_thumbnail" id="img_thumbnail" class="form-control">
                                    @error('img_thumbnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-check-label" for="is_active">Is active:</label>
                                            <div class="form-check form-switch form-switch-default">
                                                <input class="form-check-input" type="checkbox" role=""
                                                    name="is_active" checked value="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <a href="{{ route('admin.combos.index') }}" class="btn btn-info">Danh sách</a>
                        <button type="submit" class="btn btn-primary mx-1">Thêm mới</button>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mảng giá đồ ăn lấy từ PHP
            var foodPrices = @json($food->pluck('price', 'id')); // Mảng giá với key là ID

            function updatePrice() {
                let totalPrice = 0;

                // Lặp qua các combo food
                document.querySelectorAll('select[name="combo_food[]"]').forEach(function(select, index) {
                    let quantityInput = document.querySelectorAll('input[name="combo_quantity[]"]')[index];
                    let quantity = parseInt(quantityInput.value);

                    // Lấy giá của món ăn dựa trên ID
                    let price = foodPrices[select.value] || 0;

                    totalPrice += price * quantity;
                });

                // Cập nhật giá trị cho ô price
                document.querySelector('#price').value = totalPrice;
            }

            // Gán sự kiện thay đổi cho combo_food và combo_quantity
            document.querySelectorAll('select[name="combo_food[]"]').forEach(function(select) {
                select.addEventListener('change', updatePrice);
            });

            document.querySelectorAll('input[name="combo_quantity[]"]').forEach(function(input) {
                input.addEventListener('input', updatePrice);
            });

            // Gán sự kiện click cho nút tăng số lượng
            document.querySelectorAll('.pluss').forEach(function(button, index) {
                button.addEventListener('click', function() {
                    let quantityInput = document.querySelectorAll('input[name="combo_quantity[]"]')[
                        index];
                    let currentValue = parseInt(quantityInput.value);
                    quantityInput.value = currentValue + 1; // Tăng số lượng
                    updatePrice(); // Tính lại giá
                });
            });

            // Gán sự kiện click cho nút giảm số lượng
            document.querySelectorAll('.minuss').forEach(function(button, index) {
                button.addEventListener('click', function() {
                    let quantityInput = document.querySelectorAll('input[name="combo_quantity[]"]')[
                        index];
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue > 0) { // Đảm bảo số lượng không âm
                        quantityInput.value = currentValue - 1; // Giảm số lượng
                        updatePrice(); // Tính lại giá
                    }
                });
            });

            // Khởi tạo giá ngay khi trang tải xong
            updatePrice();
        });
    </script>
@endsection
