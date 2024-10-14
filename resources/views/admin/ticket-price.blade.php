@extends('admin.layouts.master')

@section('title')
    Giá vé
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection



@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý giá vé </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Giá vé</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0"> Giá vé theo Ghế - Loại phòng</h5>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success m-3">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <div class="card-body pt-0">
                    <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active py-3" data-bs-toggle="tab" href="#priceDefault" role="tab"
                                aria-selected="true">
                                Mặc định
                                <span class="badge bg-dark align-middle ms-1">1</span>
                            </a>
                        </li>
                        @foreach ($cinemas as $cinema)
                            <li class="nav-item">
                                <a class="nav-link py-3 isDraft" data-bs-toggle="tab"
                                    href="#priceCinemaId{{ $cinema->id }}" role="tab" aria-selected="false">
                                    {{ $cinema->name }}
                                    {{-- <span class="badge bg-warning align-middle ms-1">{{ $cinema->rooms->count() }}</span> --}}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                    <div class="card-body tab-content   w-75 mx-auto ">
                        <div class="tab-pane active " id="priceDefault" role="tabpanel">
                            <table class="table table-bordered rounded align-middle">
                                <thead>
                                    <tr class="table-light">
                                        <th colspan='2' class="text-center">GIÁ THEO GHẾ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Ghế tiêu chuẩn</td>
                                        <td><input type="number" name="" id="" class="form-control"
                                                placeholder="50.000 đ"></td>
                                    </tr>
                                    <tr>
                                        <td>Ghế vip</td>
                                        <td><input type="number" name="" id="" class="form-control"
                                                placeholder="60.000 đ"></td>
                                    </tr>
                                    <tr>
                                        <td>Ghế đôi</td>
                                        <td><input type="number" name="" id="" class="form-control"
                                                placeholder="110.000 đ"></td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr class="table-light">
                                        <th colspan='2' class="text-center">GIÁ THEO LOẠI PHÒNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>3D</td>
                                        <td><input type="number" name="" id="" class="form-control"
                                                placeholder="20.000 đ"></td>
                                    </tr>
                                </tbody>

                            </table>
                            <div class='text-end'>
                                <button class='btn btn-primary'>Cập nhật</button>
                            </div>
                        </div>

                        @foreach ($cinemas as $cinema)
                            <div class="tab-pane " id="priceCinemaId{{ $cinema->id }}" role="tabpanel">
                                <table class="table table-bordered rounded align-middle">
                                    <thead>
                                        <tr class="table-light">
                                            <th colspan='2' class="text-center">GIÁ THEO GHẾ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ghế tiêu chuẩn</td>
                                            <td><input type="number" name="" id="" class="form-control"
                                                    placeholder="50.000 đ" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Ghế vip</td>
                                            <td><input type="number" name="" id="" class="form-control"
                                                    placeholder="60.000 đ" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Ghế đôi</td>
                                            <td><input type="number" name="" id="" class="form-control"
                                                    placeholder="110.000 đ" disabled></td>
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr class="table-light">
                                            <th colspan='2' class="text-center">GIÁ THEO LOẠI PHÒNG</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>3D</td>
                                            <td><input type="number" name="" id="" class="form-control"
                                                    placeholder="20.000 đ" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Poly {{ $cinema->name }}</td>
                                            <td><input type="number" name="" id="" class="form-control"
                                                    placeholder="20.000 đ"></td>
                                        </tr>
                                    </tbody>

                                </table>
                                <div class='text-end'>
                                    <button class='btn btn-primary'>Cập nhật</button>
                                </div>


                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">

            <div class="row">
                <div class="card">
                    <div class="row">
                        <div class="card-header d-flex justify-content-between">

                            <div class="col-md-6">
                                <h5 class="card-title mb-0">Giá vé theo rạp </h5>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <form action="" method="post" class="d-flex  align-items-center " align='right'>
                                    <select name="branch_id" id="branch" class="form-select">
                                        <option value="">Lọc theo Chi nhánh</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">
                                                {{-- {{ request('branch_id') == $branch->id ? 'selected' : '' }} --}}
                                                {{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary ms-2" type="submit">Lọc</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if (session()->has('success'))
                        <div class="alert alert-success m-3">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <div class="card-body pt-0">
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Tên rạp</th>
                                    <th>Giá</th>
                                    {{-- <th>Thao tác</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <form action="" method="post">
                                    @foreach ($cinemasPaginate as $cinema)
                                        <tr>
                                            <td>{{ $cinema->name }}</td>
                                            <td><input type="text" class="form-control" id="{{ $cinema->id }}"
                                                    placeholder="{{ number_format($cinema->surcharge) }}đ"></td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="2" align="right">
                                            <button title="xem" class="btn btn-success btn-sm " type="button">
                                                Cập nhật
                                            </button>
                                        </td>
                                    </tr>
                                </form>

                            </tbody>

                        </table>
                        {{ $cinemasPaginate->links() }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="row">
                        <div class="card-header d-flex justify-content-between">

                            <div class="col-md-6">
                                <h5 class="card-title mb-0">Phụ thu theo phim</h5>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <form action="" method="post" class="d-flex  align-items-center " align='right'>
                                    <input type="text" class="form-control" placeholder="Tìm kiếm theo phim...">
                                    <button class="btn btn-primary ms-2" type="submit">Tìm </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success m-3">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <form action="" method="post">
                        <div class="card-body pt-0" style="max-height: 300px; overflow-y: auto;">

                            <table id="example"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tên phim</th>
                                        <th>Phụ thu</th>
                                        {{-- <th>Thao tác</th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($movies as $movie)
                                        <tr>
                                            <td>{{ $movie->name }}</td>
                                            <td><input type="text" class="form-control" id="{{ $movie->id }}"
                                                    placeholder="{{ number_format($movie->surcharge) }}đ"></td>
                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>

                            {{-- {{ $movies->links() }} --}}

                        </div>
                        <div class="row">
                            <div class="col-md-12 my-3 pr-4" align='right'>
                                <button title="xem" class="btn btn-success btn-sm" type="button">
                                    Cập nhật
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
