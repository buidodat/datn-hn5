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
                <h4 class="mb-sm-0">Quản lý giá vé</h4>

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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0"> Quản lý giá vé </h5>
                    <a href="{{-- {{ route('admin.slideshow.create') }} --}}" class="btn btn-primary mb-3 ">Cập nhật</a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success m-3">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <div class="card-body">
                    <table class="table table-bordered rounded align-middle "
                        style="width:100%">
                        <thead>
                            <tr class="table-warning">
                                <th colspan='2' class="text-center">GIÁ VÉ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-light" >
                                <td>Ghế tiêu chuẩn</td>
                                <td><input type="number" name="" id="" class="form-control" placeholder="50.000 đ"></td>
                            </tr>
                            <tr class="table-light" >
                                <td>Ghế vip</td>
                                <td><input type="number" name="" id="" class="form-control" placeholder="60.000 đ"></td>
                            </tr>
                            <tr class="table-light" >
                                <td>Ghế đôi</td>
                                <td><input type="number" name="" id="" class="form-control" placeholder="110.000 đ"></td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr class="table-warning">
                                <th colspan='2' class="text-center">PHỤ THU</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-light">
                                <td>3D</td>
                                <td><input type="number" name="" id="" class="form-control" placeholder="20.000 đ"></td>
                            </tr>
                            <tr class="table-light">
                                <td>4D</td>
                                <td><input type="number" name="" id="" class="form-control" placeholder="25.000 đ"></td>
                            </tr>
                            <tr class="table-light">
                                <td>IMAX</td>
                                <td><input type="number" name="" id="" class="form-control" placeholder="50.000 đ"></td>
                            </tr >
                        </tbody>

                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection


@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
@endsection
