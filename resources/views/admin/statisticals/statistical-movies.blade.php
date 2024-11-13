@extends('admin.layouts.master')

@section('title')
    Thống kê phim
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
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0 align-items-center">
                                <h4 class="card-title mb-0 flex-grow-1">Doanh thu của phim</h4>
                            </div><!-- end card header -->

                            <div class="card-header p-0 border-0 bg-light-subtle">
                                <div class="row g-0 text-center">
                                    <div class="col-6 col-sm-4">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1"><span class="counter-value" data-target="20">0</span>
                                            </h5>
                                            <p class="text-muted mb-0">Tổng phim</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-4">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1"><span class="counter-value" data-target="150">0</span>
                                            </h5>
                                            <p class="text-muted mb-0">Tổng hóa đơn</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-4">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1"><span class="counter-value"
                                                    data-target="20000000">0</span>VND
                                            </h5>
                                            <p class="text-muted mb-0">Tổng doanh thu</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header -->

                            <canvas id="revenueChartByMovies" height="460"></canvas>

                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>               
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
        // thống kê doanh thu theo phim
        const revenueChartByMovies = document.getElementById('revenueChartByMovies').getContext('2d');
        const revenueChartByMoviesData = {
            labels: @json($revenueByMovies->pluck('name')),
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: @json($revenueByMovies->pluck('total_revenue')),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        new Chart(revenueChartByMovies, {
            type: 'bar', // Biểu đồ cột
            data: revenueChartByMoviesData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Doanh thu (VNĐ)',
                            font: {
                                size: 14 // Tăng cỡ chữ tại đây
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tên phim',
                            font: {
                                size: 14 // Tăng cỡ chữ tại đây
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection