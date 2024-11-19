@extends('admin.layouts.master')

@section('title')
    Thống kê hóa đơn
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row">
                    <div class="col-md-10">
                        <form action="" method="GET">
                            {{-- TÌm kiếm --}}
                            <div class="row">
                                @if (Auth::user()->hasRole('System Admin'))
                                    <div class="col-md-2">
                                        <select name="branch_id" id="branch" class="form-select">
                                            <option value="">Chi nhánh</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">
                                                    {{-- {{ request('branch_id') == $branch->id ? 'selected' : '' }} --}}
                                                    {{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <select name="cinema_id" id="cinema" class="form-select">
                                            <option value="">Chọn Rạp</option>
                                        </select>
                                    </div>
                                @else
                                    <div class="col-md-2">
                                        <label for="">Lọc theo ngày:</label>
                                    </div>
                                @endif


                                <div class="col-md-3">
                                    <input type="datetime-local" name="date" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <input type="datetime-local" name="date" class="form-control">
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-success" type="submit">
                                        <i class="ri-equalizer-fill me-1 align-bottom"></i>Lọc</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-md-2" align="right">
                        <a href="" class="btn btn-primary mb-3 ">Tổng quan</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center">
                                <h4 class="card-title mb-0 flex-grow-1">Doanh thu theo khung giờ chiếu </h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <canvas id="revenueChartTimeSlot"></canvas>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Thống kê hóa đơn</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div id="line_chart_dashed" data-colors='["--vz-primary", "--vz-danger", "--vz-success"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                </div> <!-- end row-->
            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>
@endsection

@section('script-libs')
    <!-- linecharts init -->
    <script src="{{ asset('theme/admin/assets/js/pages/apexcharts-line.init.js') }}"></script>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Lấy giá trị branchId và cinemaId từ Laravel
            // var selectedBranchId = "{{ old('branch_id', '') }}";
            // var selectedCinemaId = "{{ old('cinema_id', '') }}";

            // Xử lý sự kiện thay đổi chi nhánh
            $('#branch').on('change', function() {
                var branchId = $(this).val();
                var cinemaSelect = $('#cinema');
                cinemaSelect.empty();
                cinemaSelect.append('<option value="">Chọn Rạp</option>');

                if (branchId) {
                    $.ajax({
                        url: "{{ env('APP_URL') }}/api/cinemas/" + branchId,
                        method: 'GET',
                        success: function(data) {
                            $.each(data, function(index, cinema) {
                                cinemaSelect.append('<option value="' + cinema.id +
                                    '" >' + cinema.name + '</option>');
                            });

                            // Chọn lại cinema nếu có selectedCinemaId
                            if (selectedCinemaId) {
                                cinemaSelect.val(selectedCinemaId);
                                // selectedCinemaId = false;
                            }
                        }
                    });
                }
            });

            // Nếu có selectedBranchId thì tự động kích hoạt thay đổi chi nhánh để load danh sách cinema
            // if (selectedBranchId) {
            //     $('#branch').val(selectedBranchId).trigger('change');

            // }
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script>
        // thống kê doanh thu theo khung giờ chiếu
        const revenueChartTimeSlot = document.getElementById('revenueChartTimeSlot').getContext('2d');
        const revenueChartTimeSlotData = {
            labels: @json(array_column($revenueTimeSlot, 'label')),
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: @json(array_column($revenueTimeSlot, 'revenue')),
                backgroundColor: [
                    'rgb(247, 184, 75)',
                    'rgb(10, 179, 156)',
                    'rgb(240, 101, 72)'
                ]
            }]
        };

        new Chart(revenueChartTimeSlot, {
            type: 'doughnut', // Biểu đồ tròn
            data: revenueChartTimeSlotData,
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        formatter: (value, context) => {
                            // Chuyển đổi giá trị revenue từ chuỗi sang số
                            const total = context.chart.data.datasets[0].data.reduce((sum, currentValue) =>
                                sum + parseFloat(currentValue), 0);

                            // Tính phần trăm chính xác dựa trên tổng
                            const percentage = ((parseFloat(value) / total) * 100).toFixed(2) + '%';
                            return percentage; // Hiển thị phần trăm
                        },
                        color: '#fff', // Màu chữ hiển thị
                        font: {
                            weight: 'bold',
                            size: 14 // Cỡ chữ
                        },
                        anchor: 'center',
                        align: 'center',
                        offset: 0 // Đặt lại vị trí hiển thị
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString() + ' VNĐ';
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels] // Kích hoạt plugin
        });
    </script>
@endsection