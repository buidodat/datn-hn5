{{-- <h1 class="mb-4 text-center">Thống Kê Tổng Quan Doanh Thu</h1>

<!-- Thẻ doanh thu hôm nay, tuần, tháng, năm -->
<div class="row">
    @php
        $revenues = [
            ['label' => 'Doanh Thu Hôm Nay', 'amount' => $todayRevenue, 'color' => 'bg-primary'],
            ['label' => 'Doanh Thu Tuần Này', 'amount' => $weekRevenue, 'color' => 'bg-success'],
            ['label' => 'Doanh Thu Tháng Này', 'amount' => $monthRevenue, 'color' => 'bg-warning'],
            ['label' => 'Doanh Thu Năm Nay', 'amount' => $yearRevenue, 'color' => 'bg-danger'],
        ];
    @endphp
    @foreach ($revenues as $revenue)
        <div class="col-md-3 mb-4">
            <div class="card shadow-lg">
                <div class="card-header {{ $revenue['color'] }} text-white text-center">
                    {{ $revenue['label'] }}
                </div>
                <div class="card-body text-center">
                    <h4 class="font-weight-bold">{{ number_format($revenue['amount'], 0, ',', '.') }} VNĐ</h4>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Form lọc -->
 <div class="card shadow-sm p-3 mb-5">
    <form method="GET" action="{{ route('admin.statistical.ticketsRevenue') }}" class="d-flex justify-content-center">
        <input type="date" name="from_date" class="form-control mx-2" placeholder="Từ ngày">
        <input type="date" name="to_date" class="form-control mx-2" placeholder="Đến ngày">
        <button type="submit" class="btn btn-primary">Lọc</button>
    </form>
</div> 

<div class="card shadow-sm mb-5">
    <div class="card-header bg-info text-white">
        <h3 class="m-0">Doanh Thu Theo Ngày</h3>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Ngày</th>
                    <th>Doanh Thu (VNĐ)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dailyRevenue as $day)
                    <tr>
                        <td>{{ $day->date }}</td>
                        <td>{{ number_format($day->total_price, 0, ',', '.') }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bảng doanh thu theo cơ sở -->
<div class="card shadow-sm mb-5">
    <div class="card-header bg-secondary text-white">
        <h3 class="m-0">Doanh Thu Theo Cơ Sở</h3>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID Cơ Sở</th>
                    <th>Doanh Thu (VNĐ)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cinemaRevenue as $cinema)
                    <tr>
                        <td>{{ $cinema->cinema_id }}</td>
                        <td>{{ number_format($cinema->total_price, 0, ',', '.') }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection --}}





@extends('admin.layouts.master')

@section('title')
    Doanh thu theo hóa đơn trên toàn quốc
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection



@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"> Doanh thu trên toàn quốc</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Thống kê</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @php
            $revenues = [
                ['label' => 'Doanh Thu Hôm Nay', 'amount' => $todayRevenue, 'color' => 'bg-primary'],
                ['label' => 'Doanh Thu Tuần Này', 'amount' => $weekRevenue, 'color' => 'bg-success'],
                ['label' => 'Doanh Thu Tháng Này', 'amount' => $monthRevenue, 'color' => 'bg-warning'],
                ['label' => 'Doanh Thu Năm Nay', 'amount' => $yearRevenue, 'color' => 'bg-danger'],
            ];
        @endphp
        @foreach ($revenues as $revenue)
            <div class="col-md-2 mb-4">
                <div class="card shadow-lg">
                    <div class="card-header {{ $revenue['color'] }} text-white text-center">
                        {{ $revenue['label'] }}
                    </div>
                    <div class="card-body text-center">
                        <h4 class="font-weight-bold">{{ number_format($revenue['amount'], 0, ',', '.') }} VNĐ</h4>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                @if (session()->has('success'))
                    <div class="alert alert-success m-3">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-warning m-3">
                        {{ session()->get('error') }}
                    </div>
                @endif

                <div class="card-header">
                    <div class="row mb-3">
                        <h5 class="card-title mb-0">Thống kê theo ngày
                            @if (Auth::user()->cinema_id != '')
                                - {{ Auth::user()->cinema->name }}
                            @endif
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Cơ sở</th>
                                    <th>Từ Ngày - Đến Ngày</th>
                                    <th>Doanh Thu (VNĐ)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dailyRevenue as $day)
                                    <tr>
                                        <td>Mỹ Đình</td>
                                        <td>{{ $day->date }}</td>
                                        <td>{{ number_format($day->total_price, 0, ',', '.') }} VNĐ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    <div class="row mb-3">
                        <h5 class="card-title mb-0">Thống kê theo cơ sở
                            @if (Auth::user()->cinema_id != '')
                                - {{ Auth::user()->cinema->name }}
                            @endif
                        </h5>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID Cơ Sở</th>
                                    <th>Doanh Thu (VNĐ)</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cinemaRevenue as $cinema)
                                    <tr>
                                        <td>{{ $cinema->cinema_id }}</td>
                                        <td>{{ number_format($cinema->total_price, 0, ',', '.') }} VNĐ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
