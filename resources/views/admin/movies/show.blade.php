@extends('admin.layouts.master')

@section('title')
    Thông tin phim
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thông tin phim</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.movies.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active">Chi tiết</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- thông tin -->

    <div class="card">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="sticky-side-div" style="width: 90%;">
                        <div class="card ribbon-box border shadow-none right">
                            <div class="ribbon-two ribbon-two-danger">
                                <span>{{ $movie->is_hot == 1 ? 'HOT' : '' }}</span>
                            </div>
                            @php
                                $url = $movie->img_thumbnail;

                                if (!\Str::contains($url, 'http')) {
                                    $url = Storage::url($url);
                                }

                            @endphp
                            @if($movie->img_thumbnail)
                                <div class="text-center mt-2">
                                    <img src="{{ $url }}" alt="" width="80%">
                                </div>
                            @else
                                No image !
                            @endif
                            {{--                            ảnh nhỏ--}}
                            {{--                            <div class="position-absolute bottom-0 p-3">--}}
                            {{--                                <div class="position-absolute top-0 end-0 start-0 bottom-0 bg-white opacity-25"></div>--}}
                            {{--                                <div class="row justify-content-center">--}}
                            {{--                                    <div class="col-3">--}}
                            {{--                                        <img src="assets/images/nft/img-02.jpg" alt="" class="img-fluid rounded">--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-3">--}}
                            {{--                                        <img src="assets/images/nft/img-03.jpg" alt="" class="img-fluid rounded">--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-3">--}}
                            {{--                                        <img src="https://img.themesbrand.com/velzon/images/img-3.gif" alt=""--}}
                            {{--                                             class="img-fluid rounded h-100 object-fit-cover">--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-3">--}}
                            {{--                                        <img src="assets/images/nft/img-06.jpg" alt="" class="img-fluid rounded">--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="card ribbon-box border shadow-none right">
                            <h3 class="text-center mt-2">Trailer</h3>
                            <div class="d-flex justify-content-center align-content-center">
                                @if ($movie->trailer_url )
                                    <div class="text-center">
                                        <iframe class="w-100 mt-2"
                                                src="https://www.youtube.com/embed/{{ $movie->trailer_url  }}"
                                                title="YouTube video player" allowfullscreen>
                                        </iframe>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div><!--end col-->
                <div class="col-lg-8">
                    <div>

                        <span class="badge bg-info-subtle text-info mb-3 fs-12"><i
                                class="ri-eye-line me-1 align-bottom"></i> Hiển thị lượt view</span>
                        <h4>{{ $movie->name }}</h4>
                        <div class="hstack gap-3 flex-wrap">
                            {{--<div class="text-muted">Seller : <span class="text-body fw-medium">Rickey Teran</span></div>
                            <div class="vr"></div>--}}
                            <div class="text-muted">Ngày bắt đầu : <span
                                    class="text-body fw-medium">{{ $movie->release_date }}</span>
                            </div>
                            <div class="text-muted">Ngày kết thúc : <span
                                    class="text-body fw-medium">{{ $movie->end_date }}</span>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                            <div class="text-muted fs-16">
                                <span class="mdi mdi-star text-warning"></span>
                                <span class="mdi mdi-star text-warning"></span>
                                <span class="mdi mdi-star text-warning"></span>
                                <span class="mdi mdi-star text-warning"></span>
                                <span class="mdi mdi-star text-warning"></span>
                            </div>
                            <div class="text-muted">( 5.50k Customer Review )</div>
                        </div>

                        <div class="mt-4 text-muted">
                            <h5 class="fs-14">Mô tả :</h5>
                            <p>{{ $movie->description }}</p>
                        </div>
                        <div class="product-content mt-5">
                            <h5 class="fs-14 mb-3">Chi tiết phim :</h5>

                            <div class="tab-content border  p-4" id="nav-tabContent">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                        <tr>
                                            <th scope="row" style="width: 200px;">Thể loại</th>
                                            <td>{{ $movie->category }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Đạo diễn</th>
                                            <td>{{ $movie->director }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Diễn viên</th>
                                            <td>{{ $movie->cast }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Thời lượng</th>
                                            <td>{{ $movie->duration }} phút</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Độ tuổi</th>
                                            <td>{{ $movie->rating }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Ngôn ngữ</th>
                                            <td>
                                            @foreach ( $movie->movieVersions as $version)
                                                <span class="badge bg-info">{{ $version->name }}</span>
                                            @endforeach
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">

                            <div class="row gy-4 gx-0">
                                <div class="col-lg-4">
                                    <div>
                                        <div class="pb-3">
                                            <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <div class="fs-16 align-middle text-warning">
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-half-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <h6 class="mb-0">4.8 out of 5</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-muted">Total <span class="fw-medium">7.32k</span>
                                                    reviews
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <div class="row align-items-center g-2">
                                                <div class="col-auto">
                                                    <div class="p-2">
                                                        <h6 class="mb-0">5 star</h6>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="p-2">
                                                        <div class="progress animated-progress progress-sm">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                 style="width: 50.16%" aria-valuenow="50.16"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="p-2">
                                                        <h6 class="mb-0 text-muted">2758</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->

                                            <div class="row align-items-center g-2">
                                                <div class="col-auto">
                                                    <div class="p-2">
                                                        <h6 class="mb-0">4 star</h6>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="p-2">
                                                        <div class="progress animated-progress progress-sm">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                 style="width: 19.32%" aria-valuenow="19.32"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="p-2">
                                                        <h6 class="mb-0 text-muted">1063</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->

                                            <div class="row align-items-center g-2">
                                                <div class="col-auto">
                                                    <div class="p-2">
                                                        <h6 class="mb-0">3 star</h6>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="p-2">
                                                        <div class="progress animated-progress progress-sm">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                 style="width: 18.12%" aria-valuenow="18.12"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="p-2">
                                                        <h6 class="mb-0 text-muted">997</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->

                                            <div class="row align-items-center g-2">
                                                <div class="col-auto">
                                                    <div class="p-2">
                                                        <h6 class="mb-0">2 star</h6>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="p-2">
                                                        <div class="progress animated-progress progress-sm">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                 style="width: 7.42%" aria-valuenow="7.42"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="p-2">
                                                        <h6 class="mb-0 text-muted">408</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->

                                            <div class="row align-items-center g-2">
                                                <div class="col-auto">
                                                    <div class="p-2">
                                                        <h6 class="mb-0">1 star</h6>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="p-2">
                                                        <div class="progress animated-progress progress-sm">
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                 style="width: 4.98%" aria-valuenow="4.98"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="p-2">
                                                        <h6 class="mb-0 text-muted">274</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-8">
                                    <div class="ps-lg-4">
                                        <div class="d-flex flex-wrap align-items-start gap-3">
                                            <h5 class="fs-14">Reviews: </h5>
                                        </div>

                                        <div class="me-lg-n3 pe-lg-4 simplebar-scrollable-y" data-simplebar="init"
                                             style="max-height: 225px;">
                                            <div class="simplebar-wrapper" style="margin: 0px -24px 0px 0px;">
                                                <div class="simplebar-height-auto-observer-wrapper">
                                                    <div class="simplebar-height-auto-observer"></div>
                                                </div>
                                                <div class="simplebar-mask">
                                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                        <div class="simplebar-content-wrapper" tabindex="0"
                                                             role="region" aria-label="scrollable content"
                                                             style="height: auto; overflow: hidden scroll;">
                                                            <div class="simplebar-content"
                                                                 style="padding: 0px 24px 0px 0px;">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li class="py-2">
                                                                        <div class="border border-dashed rounded p-3">
                                                                            <div class="d-flex align-items-start mb-3">
                                                                                <div class="hstack gap-3">
                                                                                    <div class="text-warning">
                                                                                        <i class="mdi mdi-star"></i>
                                                                                        <i class="mdi mdi-star"></i>
                                                                                        <i class="mdi mdi-star"></i>
                                                                                        <i class="mdi mdi-star"></i>
                                                                                        <i class="mdi mdi-star"></i>
                                                                                    </div>
                                                                                    <div class="vr"></div>
                                                                                    <div class="flex-grow-1">
                                                                                        <h6 class="mb-0"> Superb
                                                                                            Artwork</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="d-flex flex-grow-1 gap-2 mb-3">
                                                                                <a href="#" class="d-block">
                                                                                    <img
                                                                                        src="assets/images/small/img-12.jpg"
                                                                                        alt=""
                                                                                        class="avatar-sm rounded object-fit-cover">
                                                                                </a>
                                                                                <a href="#" class="d-block">
                                                                                    <img
                                                                                        src="assets/images/small/img-11.jpg"
                                                                                        alt=""
                                                                                        class="avatar-sm rounded object-fit-cover">
                                                                                </a>
                                                                                <a href="#" class="d-block">
                                                                                    <img
                                                                                        src="assets/images/small/img-10.jpg"
                                                                                        alt=""
                                                                                        class="avatar-sm rounded object-fit-cover">
                                                                                </a>
                                                                            </div>

                                                                            <div class="d-flex align-items-end">
                                                                                <div class="flex-grow-1">
                                                                                    <h5 class="fs-14 mb-0">Henry</h5>
                                                                                </div>

                                                                                <div class="flex-shrink-0">
                                                                                    <p class="text-muted fs-13 mb-0">12
                                                                                        Jul, 21</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="py-2">
                                                                        <div class="border border-dashed rounded p-3">
                                                                            <div class="d-flex align-items-start mb-3">
                                                                                <div class="hstack gap-3">
                                                                                    <div
                                                                                        class="badge rounded-pill bg-success mb-0">
                                                                                        <i class="mdi mdi-star"></i> 4.0
                                                                                    </div>
                                                                                    <div class="vr"></div>
                                                                                    <div class="flex-grow-1">
                                                                                        <p class="text-muted mb-0">
                                                                                            Great at this price, Product
                                                                                            quality and look is
                                                                                            awesome.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex align-items-end">
                                                                                <div class="flex-grow-1">
                                                                                    <h5 class="fs-14 mb-0">Nancy</h5>
                                                                                </div>

                                                                                <div class="flex-shrink-0">
                                                                                    <p class="text-muted fs-13 mb-0">06
                                                                                        Jul, 21</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="py-2">
                                                                        <div class="border border-dashed rounded p-3">
                                                                            <div class="d-flex align-items-start mb-3">
                                                                                <div class="hstack gap-3">
                                                                                    <div
                                                                                        class="badge rounded-pill bg-success mb-0">
                                                                                        <i class="mdi mdi-star"></i> 4.2
                                                                                    </div>
                                                                                    <div class="vr"></div>
                                                                                    <div class="flex-grow-1">
                                                                                        <p class="text-muted mb-0">Good
                                                                                            product. I am so happy.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex align-items-end">
                                                                                <div class="flex-grow-1">
                                                                                    <h5 class="fs-14 mb-0">Joseph</h5>
                                                                                </div>

                                                                                <div class="flex-shrink-0">
                                                                                    <p class="text-muted fs-13 mb-0">06
                                                                                        Jul, 21</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="py-2">
                                                                        <div class="border border-dashed rounded p-3">
                                                                            <div class="d-flex align-items-start mb-3">
                                                                                <div class="hstack gap-3">
                                                                                    <div
                                                                                        class="badge rounded-pill bg-success mb-0">
                                                                                        <i class="mdi mdi-star"></i> 4.1
                                                                                    </div>
                                                                                    <div class="vr"></div>
                                                                                    <div class="flex-grow-1">
                                                                                        <p class="text-muted mb-0">Nice
                                                                                            Product, Good Quality.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex align-items-end">
                                                                                <div class="flex-grow-1">
                                                                                    <h5 class="fs-14 mb-0">Jimmy</h5>
                                                                                </div>

                                                                                <div class="flex-shrink-0">
                                                                                    <p class="text-muted fs-13 mb-0">24
                                                                                        Jun, 21</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="simplebar-placeholder"
                                                     style="width: 515px; height: 483px;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-horizontal"
                                                 style="visibility: hidden;">
                                                <div class="simplebar-scrollbar"
                                                     style="width: 0px; display: none;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-vertical"
                                                 style="visibility: visible;">
                                                <div class="simplebar-scrollbar"
                                                     style="height: 104px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end Ratings & Reviews -->
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
    </div><!--end card-->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <a href="{{ route('admin.movies.index') }}" class="btn btn-info">Danh sách</a>
                    <a href="{{ route('admin.movies.edit',$movie) }}">
                        <button type="submit" class="btn btn-primary mx-1">Chỉnh sửa</button>
                    </a>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>

@endsection

@section('style-libs')
    <!-- App favicon -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css"/>
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/select2.init.js') }}"></script>

    <script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("content", {
            width: "100%",
            height: "750px"
        });
    </script>
@endsection
