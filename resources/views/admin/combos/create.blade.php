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
                        <div class="alert alert-success">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label "> <span class="text-danger">*</span>Tên
                                                combo
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}" placeholder="Nhập tên combo">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="price_sale" class="form-label "> <span
                                                    class="text-danger">*</span>Giá bán</label>
                                            <input type="number" class="form-control" id="price_sale" name="price_sale"
                                                value="{{ old('price_sale') }}" placeholder="Nhập giá bán">
                                            @error('price_sale')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 d-flex justify-content-between">
                                            <label for="price_sale" class="form-label">Đồ ăn</label>
                                            <button type="button" class="btn btn-primary" onclick="addFood()">Thêm đồ
                                                ăn</button>
                                        </div>
                                        <div id="food_list" class="col-md-12">
                                            <!-- Các phần tử food sẽ được thêm vào đây -->
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="description" class="form-label"> <span
                                                    class="text-danger">*</span>Mô tả
                                                ngắn</label>
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
    function addFood() {
        const id = 'gen_' + Math.random().toString(36).substring(2, 15).toLowerCase();
        const foodList = document.getElementById('food_list');

        // Tạo HTML mới
        const html = `
        <div class="col-md-12 mb-1" id="${id}_item">
            <div class="d-flex">
                <div class="col-md-6">
                    <label for="${id}_select" class="form-label">Đồ ăn</label>
                    <select name="combo_food[]" id="${id}_select" class="form-control mb-3 mx-2">
                        <option value="1">hihi</option>
                        <option value="2">haha</option>
                    </select>
                </div>

                <div class="col-md-5 mx-3">
                    <label for="${id}" class="form-label">Số lượng</label>
                    <input type="number" class="form-control" name="combo_quantity[]" id="${id}">
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-btn mt-4">
                        <span class="bx bx-trash"></span>
                    </button>
                </div>
            </div>
        </div>
    `;

        // Thêm HTML vào danh sách food
        foodList.insertAdjacentHTML('beforeend', html);

        // Gán sự kiện cho nút xóa
        foodList.querySelector(`#${id}_item .remove-btn`).addEventListener('click', function() {
            removeFood(`${id}_item`);
        });
    }

    function removeFood(id) {
        if (confirm('Chắc chắn xóa không?')) {
            // Thêm hiệu ứng khi xóa
            const element = document.getElementById(id);
            element.style.transition = 'opacity 0.5s ease';
            element.style.opacity = '0';

            // Xóa phần tử sau khi hiệu ứng hoàn tất
            setTimeout(() => {
                element.remove();
            }, 500);
        }
    }
</script>


@endsection


{{-- <label for="${id}" class="form-label">Đồ ăn</label>
<div class="d-flex">
    <select name="" id="" class="form-control mb-3 mx-2">
        <option value="1">hihi</option>
        <option value="2">haha</option>
    </select>

    <input type="number" class="form-control" name="combo_food[]" id="${id}">
    <button type="button" class="btn btn-danger remove-btn mx-2">
        <span class="bx bx-trash"></span>
    </button>
</div> --}}
