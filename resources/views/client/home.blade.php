@extends('client.layouts.master')

@section('title')
    Trang Chủ
@endsection

@section('content')
    @include('client.layouts.slideshow')


    <div class="prs_upcom_slider_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_heading_section_wrapper">
                        <h2>Upcoming Movies</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_upcome_tabs_wrapper">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#best" aria-controls="best" role="tab"
                                    data-toggle="tab">Upcoming Movies</a>
                            </li>
                            <li role="presentation"><a href="#hot" aria-controls="hot" role="tab"
                                    data-toggle="tab">Relesed Movies</a>
                            </li>
                            <li role="presentation"><a href="#trand" aria-controls="trand" role="tab"
                                    data-toggle="tab">Best of library</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="best">
                        <div class="prs_upcom_slider_slides_wrapper">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up1.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a id="buy-ticket-btn">Buy Ticket</a>
                                                            </li>
                                                            {{-- <li>
																<button id="buy-ticket-btn">Mua vé</button>

															</li> --}}
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up2.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up3.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up4.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up5.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up6.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up7.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up8.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up8.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up7.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up6.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up5.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up4.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up3.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up2.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up1.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                    <ul>
                                        <li><a href="#" class="button button--tamaya prs_upcom_main_btn"
                                                data-text="view all"><span>View All</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="hot">
                        <div class="prs_upcom_slider_slides_wrapper">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up8.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up7.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up6.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up5.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up4.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up3.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up2.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up1.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up1.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up2.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up3.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up4.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up5.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up6.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up7.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up8.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                    <ul>
                                        <li><a href="#" class="button button--tamaya prs_upcom_main_btn"
                                                data-text="view all"><span>View All</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="trand">
                        <div class="prs_upcom_slider_slides_wrapper">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up1.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up2.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up3.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up4.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up5.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up6.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up7.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up7.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up1.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up2.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up4.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/up5.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up4.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up3.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up2.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/up1.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                    <ul>
                                        <li><a href="#" class="button button--tamaya prs_upcom_main_btn"
                                                data-text="view all"><span>View All</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="prs_upcom_slider_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_heading_section_wrapper">
                        <h2>web series</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_upcome_tabs_wrapper">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#best1" aria-controls="best"
                                    role="tab" data-toggle="tab">Upcoming Movies</a>
                            </li>
                            <li role="presentation"><a href="#hot1" aria-controls="hot" role="tab"
                                    data-toggle="tab">Relesed Movies</a>
                            </li>
                            <li role="presentation"><a href="#trand1" aria-controls="trand" role="tab"
                                    data-toggle="tab">Best of library</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="best1">
                        <div class="prs_upcom_slider_slides_wrapper">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper prs_upcom_movie_video_box_wrapper">
                                                <div class="prs_upcom_movie_video_overlay"></div>
                                                <div class="prs_upcom_movie_img_box prs_webseri_movie_img_box">
                                                    <div class="prs_webseri_video_img_sec_icon_wrapper">
                                                        <ul>
                                                            <li><a class="test-popup-link button" rel='external'
                                                                    href='https://www.youtube.com/embed/ryzOXAO0Ss0'
                                                                    title='title'><i
                                                                        class="flaticon-play-button"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="prs_upcom_video_img_cont_over">
                                                        <ul>
                                                            <li>Drama,Action</li>
                                                            <li>Rating :&nbsp;&nbsp;<i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </li>
                                                        </ul>
                                                        <h2>terrorise of the year</h2>
                                                        <p>Release on cinema : 27 june 2018</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/ws2.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hidden-sm prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/ws3.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws4.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws5.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws6.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws7.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper prs_upcom_movie_video_box_wrapper">
                                                <div class="prs_upcom_movie_video_overlay"></div>
                                                <div class="prs_upcom_movie_img_box prs_webseri_movie_img_box">
                                                    <div class="prs_webseri_video_img_sec_icon_wrapper">
                                                        <ul>
                                                            <li><a class="test-popup-link button" rel='external'
                                                                    href='https://www.youtube.com/embed/ryzOXAO0Ss0'
                                                                    title='title'><i
                                                                        class="flaticon-play-button"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="prs_upcom_video_img_cont_over">
                                                        <ul>
                                                            <li>Drama,Action</li>
                                                            <li>Rating :&nbsp;&nbsp;<i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </li>
                                                        </ul>
                                                        <h2>terrorise of the year</h2>
                                                        <p>Release on cinema : 27 june 2018</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/ws7.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hidden-sm prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/ws6.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws5.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws4.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws3.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws2.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                    <ul>
                                        <li><a href="#" class="button button--tamaya prs_upcom_main_btn"
                                                data-text="view all"><span>View All</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="hot1">
                        <div class="prs_upcom_slider_slides_wrapper">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper prs_upcom_movie_video_box_wrapper">
                                                <div class="prs_upcom_movie_video_overlay"></div>
                                                <div class="prs_upcom_movie_img_box prs_webseri_movie_img_box">
                                                    <div class="prs_webseri_video_img_sec_icon_wrapper">
                                                        <ul>
                                                            <li><a class="test-popup-link button" rel='external'
                                                                    href='https://www.youtube.com/embed/ryzOXAO0Ss0'
                                                                    title='title'><i
                                                                        class="flaticon-play-button"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="prs_upcom_video_img_cont_over">
                                                        <ul>
                                                            <li>Drama,Action</li>
                                                            <li>Rating :&nbsp;&nbsp;<i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </li>
                                                        </ul>
                                                        <h2>terrorise of the year</h2>
                                                        <p>Release on cinema : 27 june 2018</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/ws7.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hidden-sm prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/ws6.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws5.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws4.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws3.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws2.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper prs_upcom_movie_video_box_wrapper">
                                                <div class="prs_upcom_movie_video_overlay"></div>
                                                <div class="prs_upcom_movie_img_box prs_webseri_movie_img_box">
                                                    <div class="prs_webseri_video_img_sec_icon_wrapper">
                                                        <ul>
                                                            <li><a class="test-popup-link button" rel='external'
                                                                    href='https://www.youtube.com/embed/ryzOXAO0Ss0'
                                                                    title='title'><i
                                                                        class="flaticon-play-button"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="prs_upcom_video_img_cont_over">
                                                        <ul>
                                                            <li>Drama,Action</li>
                                                            <li>Rating :&nbsp;&nbsp;<i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </li>
                                                        </ul>
                                                        <h2>terrorise of the year</h2>
                                                        <p>Release on cinema : 27 june 2018</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/ws2.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hidden-sm prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/ws3.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws4.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws5.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws6.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws7.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                    <ul>
                                        <li><a href="#" class="button button--tamaya prs_upcom_main_btn"
                                                data-text="view all"><span>View All</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="trand1">
                        <div class="prs_upcom_slider_slides_wrapper">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper prs_upcom_movie_video_box_wrapper">
                                                <div class="prs_upcom_movie_video_overlay"></div>
                                                <div class="prs_upcom_movie_img_box prs_webseri_movie_img_box">
                                                    <div class="prs_webseri_video_img_sec_icon_wrapper">
                                                        <ul>
                                                            <li><a class="test-popup-link button" rel='external'
                                                                    href='https://www.youtube.com/embed/ryzOXAO0Ss0'
                                                                    title='title'><i
                                                                        class="flaticon-play-button"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="prs_upcom_video_img_cont_over">
                                                        <ul>
                                                            <li>Drama,Action</li>
                                                            <li>Rating :&nbsp;&nbsp;<i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </li>
                                                        </ul>
                                                        <h2>terrorise of the year</h2>
                                                        <p>Release on cinema : 27 june 2018</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/ws7.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hidden-sm prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/ws6.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws5.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws4.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws3.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws2.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper prs_upcom_movie_video_box_wrapper">
                                                <div class="prs_upcom_movie_video_overlay"></div>
                                                <div class="prs_upcom_movie_img_box prs_webseri_movie_img_box">
                                                    <div class="prs_webseri_video_img_sec_icon_wrapper">
                                                        <ul>
                                                            <li><a class="test-popup-link button" rel='external'
                                                                    href='https://www.youtube.com/embed/ryzOXAO0Ss0'
                                                                    title='title'><i
                                                                        class="flaticon-play-button"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="prs_upcom_video_img_cont_over">
                                                        <ul>
                                                            <li>Drama,Action</li>
                                                            <li>Rating :&nbsp;&nbsp;<i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </li>
                                                        </ul>
                                                        <h2>terrorise of the year</h2>
                                                        <p>Release on cinema : 27 june 2018</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/ws2.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 hidden-sm prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('theme/client/images/content/ws3.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="movie_booking.html"><i
                                                                        class="flaticon-cart-of-ecommerce"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws4.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws5.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws6.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('theme/client/images/content/ws7.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="movie_booking.html"><i
                                                                            class="flaticon-cart-of-ecommerce"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                    <ul>
                                        <li><a href="#" class="button button--tamaya prs_upcom_main_btn"
                                                data-text="view all"><span>View All</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs web series Slider End -->
    <!-- prs theater Slider Start -->
    <div class="prs_theater_main_slider_wrapper">
        <div class="prs_theater_img_overlay"></div>
        <div class="prs_theater_sec_heading_wrapper">
            <h2>TOP MOVIES IN THEATRES</h2>
        </div>
        <div class="wrap-album-slider">
            <ul class="album-slider">
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <img src="{{ asset('theme/client/images/content/up1.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="prs_upcom_movie_img_btn_wrapper">
                                    <ul>
                                        <li><a href="#">View Trailer</a>
                                        </li>
                                        <li><a href="#">View Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="prs_upcom_movie_content_box">
                                <div class="prs_upcom_movie_content_box_inner">
                                    <h2><a href="#">Busting Car</a></h2>
                                    <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <div class="prs_upcom_movie_content_box_inner_icon">
                                    <ul>
                                        <li><a href="movie_booking.html"><i class="flaticon-cart-of-ecommerce"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <img src="{{ asset('theme/client/images/content/up2.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="prs_upcom_movie_img_btn_wrapper">
                                    <ul>
                                        <li><a href="#">View Trailer</a>
                                        </li>
                                        <li><a href="#">View Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="prs_upcom_movie_content_box">
                                <div class="prs_upcom_movie_content_box_inner">
                                    <h2><a href="#">Busting Car</a></h2>
                                    <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <div class="prs_upcom_movie_content_box_inner_icon">
                                    <ul>
                                        <li><a href="movie_booking.html"><i class="flaticon-cart-of-ecommerce"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <img src="{{ asset('theme/client/images/content/up3.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="prs_upcom_movie_img_btn_wrapper">
                                    <ul>
                                        <li><a href="#">View Trailer</a>
                                        </li>
                                        <li><a href="#">View Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="prs_upcom_movie_content_box">
                                <div class="prs_upcom_movie_content_box_inner">
                                    <h2><a href="#">Busting Car</a></h2>
                                    <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <div class="prs_upcom_movie_content_box_inner_icon">
                                    <ul>
                                        <li><a href="movie_booking.html"><i class="flaticon-cart-of-ecommerce"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <img src="{{ asset('theme/client/images/content/up4.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="prs_upcom_movie_img_btn_wrapper">
                                    <ul>
                                        <li><a href="#">View Trailer</a>
                                        </li>
                                        <li><a href="#">View Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="prs_upcom_movie_content_box">
                                <div class="prs_upcom_movie_content_box_inner">
                                    <h2><a href="#">Busting Car</a></h2>
                                    <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <div class="prs_upcom_movie_content_box_inner_icon">
                                    <ul>
                                        <li><a href="movie_booking.html"><i class="flaticon-cart-of-ecommerce"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <img src="{{ asset('theme/client/images/content/up5.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="prs_upcom_movie_img_btn_wrapper">
                                    <ul>
                                        <li><a href="#">View Trailer</a>
                                        </li>
                                        <li><a href="#">View Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="prs_upcom_movie_content_box">
                                <div class="prs_upcom_movie_content_box_inner">
                                    <h2><a href="#">Busting Car</a></h2>
                                    <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <div class="prs_upcom_movie_content_box_inner_icon">
                                    <ul>
                                        <li><a href="movie_booking.html"><i class="flaticon-cart-of-ecommerce"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <img src="{{ asset('theme/client/images/content/up6.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="prs_upcom_movie_img_btn_wrapper">
                                    <ul>
                                        <li><a href="#">View Trailer</a>
                                        </li>
                                        <li><a href="#">View Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="prs_upcom_movie_content_box">
                                <div class="prs_upcom_movie_content_box_inner">
                                    <h2><a href="#">Busting Car</a></h2>
                                    <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <div class="prs_upcom_movie_content_box_inner_icon">
                                    <ul>
                                        <li><a href="movie_booking.html"><i class="flaticon-cart-of-ecommerce"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <img src="{{ asset('theme/client/images/content/up7.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="prs_upcom_movie_img_btn_wrapper">
                                    <ul>
                                        <li><a href="#">View Trailer</a>
                                        </li>
                                        <li><a href="#">View Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="prs_upcom_movie_content_box">
                                <div class="prs_upcom_movie_content_box_inner">
                                    <h2><a href="#">Busting Car</a></h2>
                                    <p>Drama , Acation</p> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <div class="prs_upcom_movie_content_box_inner_icon">
                                    <ul>
                                        <li><a href="movie_booking.html"><i class="flaticon-cart-of-ecommerce"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
            </ul>
            <!-- End slider -->
        </div>
    </div>
    <!-- prs theater Slider End -->
    <!-- prs letest news Start	-->
    <div class="prs_ln_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_heading_section_wrapper">
                        <h2>LAtest News</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="prs_ln_left_img_wrapper">
                        <div class="prs_in_left_img_overlay"></div>
                        <div class="prs_webseri_video_sec_icon_wrapper ">
                            <ul>
                                <li><a class="test-popup-link button" rel='external'
                                        href='https://www.youtube.com/embed/ryzOXAO0Ss0' title='title'><i
                                            class="flaticon-play-button"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="prs_prs_webseri_video_sec_icon_cont_wrapper">
                            <p>28 Feb 2018</p>
                            <h2>The News of theater</h2>
                            <ul>
                                <li><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<a href="#">120 Like</a>
                                </li>
                                <li><i class="fa fa-comments-o"></i>&nbsp;&nbsp;<a href="#">52 Comments</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="prs_ln_right_main_wrapper">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_ln_right_first_box_wrapper">
                                    <div class="prs_in_right_box_img_wrapper">
                                        <img src="{{ asset('theme/client/images/content/nl2.jpg') }}" alt="news_img" />
                                    </div>
                                    <div class="prs_in_right_box_img_cont_wrapper">
                                        <h2><a href="#">The News of theater</a></h2>
                                        <h3>28 feb 2018</h3>
                                        <p>Lorem ipsum dolor sit amet, consectuir adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore.</p>
                                        <ul>
                                            <li><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<a href="#">120
                                                    Like</a>
                                            </li>
                                            <li><i class="fa fa-comments-o"></i>&nbsp;&nbsp;<a href="#">52
                                                    comments</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_ln_right_first_box_wrapper2">
                                    <div class="prs_in_right_box_img_wrapper">
                                        <img src="{{ asset('theme/client/images/content/nl3.jpg') }}" alt="news_img" />
                                    </div>
                                    <div class="prs_in_right_box_img_cont_wrapper">
                                        <h2><a href="#">The News of theater</a></h2>
                                        <h3>28 feb 2018</h3>
                                        <p>Lorem ipsum dolor sit amet, consectuir adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore.</p>
                                        <ul>
                                            <li><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<a href="#">120
                                                    Like</a>
                                            </li>
                                            <li><i class="fa fa-comments-o"></i>&nbsp;&nbsp;<a href="#">52
                                                    comments</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs letest news End -->
    <!-- prs feature slider Start -->
    <div class="prs_feature_slider_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_heading_section_wrapper">
                        <h2>FEATURED EVENTS</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_feature_slider_wrapper">
                        <div class="owl-carousel owl-theme">
                            <div class="item prs_feature_slider_item_wrapper">
                                <div class="prs_feature_img_box_wrapper">
                                    <div class="prs_feature_img">
                                        <img src="{{ asset('theme/client/images/content/ft1.jpg') }}"
                                            alt="feature_img">
                                        <div class="prs_ft_btn_wrapper">
                                            <ul>
                                                <li><a href="#">Book Now</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="prs_feature_img_cont">
                                        <h2><a href="#">Music Event in india</a></h2>
                                        <div class="prs_ft_small_cont_left">
                                            <p>Mumbai & Pune</p>
                                        </div>
                                        <div class="prs_ft_small_cont_right"> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <ul>
                                            <li>June 07 - july 08</li>
                                            <li>08:00-12:00 pm</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item prs_feature_slider_item_wrapper">
                                <div class="prs_feature_img_box_wrapper">
                                    <div class="prs_feature_img">
                                        <img src="{{ asset('theme/client/images/content/ft2.jpg') }}"
                                            alt="feature_img">
                                        <div class="prs_ft_btn_wrapper">
                                            <ul>
                                                <li><a href="#">Book Now</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="prs_feature_img_cont">
                                        <h2><a href="#">Music Event in india</a></h2>
                                        <div class="prs_ft_small_cont_left">
                                            <p>Mumbai & Pune</p>
                                        </div>
                                        <div class="prs_ft_small_cont_right"> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <ul>
                                            <li>June 07 - july 08</li>
                                            <li>08:00-12:00 pm</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item prs_feature_slider_item_wrapper">
                                <div class="prs_feature_img_box_wrapper">
                                    <div class="prs_feature_img">
                                        <img src="{{ asset('theme/client/images/content/ft3.jpg') }}"
                                            alt="feature_img">
                                        <div class="prs_ft_btn_wrapper">
                                            <ul>
                                                <li><a href="#">Book Now</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="prs_feature_img_cont">
                                        <h2><a href="#">Music Event in india</a></h2>
                                        <div class="prs_ft_small_cont_left">
                                            <p>Mumbai & Pune</p>
                                        </div>
                                        <div class="prs_ft_small_cont_right"> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <ul>
                                            <li>June 07 - july 08</li>
                                            <li>08:00-12:00 pm</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs feature slider End -->
    <!-- prs videos&photos slider Start -->
    <div class="prs_vp_main_section_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_heading_section_wrapper">
                        <h2>Video & photos</h2>
                    </div>
                </div>
                <div class="prs_vp_main_slider_wrapper">
                    <div class="prs_vp_left_slidebar_wrapper">
                        <div class="wrap-album-slider">
                            <ul class="prs_vp_left_slider">
                                <li class="album-slider__item prs_vp_hover_overlay">
                                    <figure class="album">
                                        <div class="prs_vp_img_overlay">
                                            <img src="{{ asset('theme/client/images/content/vp1.jpg') }}"
                                                alt="vp_img"> <a
                                                href="{{ asset('theme/client/images/content/vp1.jpg') }}"
                                                class="venobox info" data-title="PORTFOLIO TITTLE"
                                                data-gall="gall12"><i class="fa fa-search"></i></a>
                                        </div>
                                    </figure>
                                    <!-- End album -->
                                </li>
                                <li class="album-slider__item prs_vp_hover_overlay">
                                    <figure class="album">
                                        <div class="prs_vp_img_overlay">
                                            <img src="{{ asset('theme/client/images/content/vp2.jpg') }}"
                                                alt="vp_img"> <a
                                                href="{{ asset('theme/client/images/content/vp2.jpg') }}"
                                                class="venobox info" data-title="PORTFOLIO TITTLE"
                                                data-gall="gall12"><i class="fa fa-search"></i></a>
                                        </div>
                                    </figure>
                                    <!-- End album -->
                                </li>
                                <li class="album-slider__item prs_vp_hover_overlay">
                                    <figure class="album">
                                        <div class="prs_vp_img_overlay">
                                            <img src="{{ asset('theme/client/images/content/vp3.jpg') }}"
                                                alt="vp_img"> <a
                                                href="{{ asset('theme/client/images/content/vp3.jpg') }}"
                                                class="venobox info" data-title="PORTFOLIO TITTLE"
                                                data-gall="gall12"><i class="fa fa-search"></i></a>
                                        </div>
                                    </figure>
                                    <!-- End album -->
                                </li>
                                <li class="album-slider__item prs_vp_hover_overlay">
                                    <figure class="album">
                                        <div class="prs_vp_img_overlay">
                                            <img src="{{ asset('theme/client/images/content/vp4.jpg') }}"
                                                alt="vp_img"> <a
                                                href="{{ asset('theme/client/images/content/vp4.jpg') }}"
                                                class="venobox info" data-title="PORTFOLIO TITTLE"
                                                data-gall="gall12"><i class="fa fa-search"></i></a>
                                        </div>
                                    </figure>
                                    <!-- End album -->
                                </li>
                                <li class="album-slider__item prs_vp_hover_overlay">
                                    <figure class="album">
                                        <div class="prs_vp_img_overlay">
                                            <img src="{{ asset('theme/client/images/content/vp5.jpg') }}"
                                                alt="vp_img"> <a
                                                href="{{ asset('theme/client/images/content/vp5.jpg') }}"
                                                class="venobox info" data-title="PORTFOLIO TITTLE"
                                                data-gall="gall12"><i class="fa fa-search"></i></a>
                                        </div>
                                    </figure>
                                    <!-- End album -->
                                </li>
                                <li class="album-slider__item prs_vp_hover_overlay">
                                    <figure class="album">
                                        <div class="prs_vp_img_overlay">
                                            <img src="{{ asset('theme/client/images/content/vp6.jpg') }}"
                                                alt="vp_img"> <a
                                                href="{{ asset('theme/client/images/content/vp6.jpg') }}"
                                                class="venobox info" data-title="PORTFOLIO TITTLE"
                                                data-gall="gall12"><i class="fa fa-search"></i></a>
                                        </div>
                                    </figure>
                                    <!-- End album -->
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="prs_vp_center_slidebar_wrapper">
                        <div class="prs_vp_center_slider">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="prs_vp_center_slider_img_wrapper">
                                        <img src="{{ asset('theme/client/images/content/vp7.jpg') }}" alt="vp_img">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="prs_vp_center_slider_img_wrapper">
                                        <img src="{{ asset('theme/client/images/content/vp7.jpg') }}" alt="vp_img">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="prs_vp_center_slider_img_wrapper">
                                        <img src="{{ asset('theme/client/images/content/vp7.jpg') }}" alt="vp_img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="prs_vp_right_slidebar_wrapper">
                        <div class="wrap-album-slider">
                            <ul class="prs_vp_right_slider">
                                <li class="album-slider__item prs_vp_hover_overlay">
                                    <figure class="album">
                                        <div class="prs_vp_img_overlay">
                                            <img src="{{ asset('theme/client/images/content/vp6.jpg') }}"
                                                alt="vp_img"> <a
                                                href="{{ asset('theme/client/images/content/vp6.jpg') }}"
                                                class="venobox info" data-title="PORTFOLIO TITTLE"
                                                data-gall="gall12"><i class="fa fa-search"></i></a>
                                        </div>
                                    </figure>
                                    <!-- End album -->
                                </li>
                                <li class="album-slider__item prs_vp_hover_overlay">
                                    <figure class="album">
                                        <div class="prs_vp_img_overlay">
                                            <img src="{{ asset('theme/client/images/content/vp5.jpg') }}"
                                                alt="vp_img"> <a
                                                href="{{ asset('theme/client/images/content/vp5.jpg') }}"
                                                class="venobox info" data-title="PORTFOLIO TITTLE"
                                                data-gall="gall12"><i class="fa fa-search"></i></a>
                                        </div>
                                    </figure>
                                    <!-- End album -->
                                </li>
                                <li class="album-slider__item prs_vp_hover_overlay">
                                    <figure class="album">
                                        <div class="prs_vp_img_overlay">
                                            <img src="{{ asset('theme/client/images/content/vp4.jpg') }}"
                                                alt="vp_img"> <a
                                                href="{{ asset('theme/client/images/content/vp4.jpg') }}"
                                                class="venobox info" data-title="PORTFOLIO TITTLE"
                                                data-gall="gall12"><i class="fa fa-search"></i></a>
                                        </div>
                                    </figure>
                                    <!-- End album -->
                                </li>
                                <li class="album-slider__item prs_vp_hover_overlay">
                                    <figure class="album">
                                        <div class="prs_vp_img_overlay">
                                            <img src="{{ asset('theme/client/images/content/vp3.jpg') }}"
                                                alt="vp_img"> <a
                                                href="{{ asset('theme/client/images/content/vp3.jpg') }}"
                                                class="venobox info" data-title="PORTFOLIO TITTLE"
                                                data-gall="gall12"><i class="fa fa-search"></i></a>
                                        </div>
                                    </figure>
                                    <!-- End album -->
                                </li>
                                <li class="album-slider__item prs_vp_hover_overlay">
                                    <figure class="album">
                                        <div class="prs_vp_img_overlay">
                                            <img src="{{ asset('theme/client/images/content/vp2.jpg') }}"
                                                alt="vp_img"> <a
                                                href="{{ asset('theme/client/images/content/vp2.jpg') }}"
                                                class="venobox info" data-title="PORTFOLIO TITTLE"
                                                data-gall="gall12"><i class="fa fa-search"></i></a>
                                        </div>
                                    </figure>
                                    <!-- End album -->
                                </li>
                                <li class="album-slider__item prs_vp_hover_overlay">
                                    <figure class="album">
                                        <div class="prs_vp_img_overlay">
                                            <img src="{{ asset('theme/client/images/content/vp1.jpg') }}"
                                                alt="vp_img"> <a
                                                href="{{ asset('theme/client/images/content/vp1.jpg') }}"
                                                class="venobox info" data-title="PORTFOLIO TITTLE"
                                                data-gall="gall12"><i class="fa fa-search"></i></a>
                                        </div>
                                    </figure>
                                    <!-- End album -->
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="prs_vp_bottom_banner_wrapper">
                        <img src="{{ asset('theme/client/images/content/vp8.jpg') }}" alt="banner">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs videos&photos slider End -->
    <!-- prs patner slider Start -->
    <div class="prs_patner_main_section_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_heading_section_wrapper">
                        <h2>Our Patner’s</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_pn_slider_wraper">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="prs_pn_img_wrapper">
                                    <img src="{{ asset('theme/client/images/content/p1.jpg') }}" alt="patner_img">
                                </div>
                            </div>
                            <div class="item">
                                <div class="prs_pn_img_wrapper">
                                    <img src="{{ asset('theme/client/images/content/p2.jpg') }}" alt="patner_img">
                                </div>
                            </div>
                            <div class="item">
                                <div class="prs_pn_img_wrapper">
                                    <img src="{{ asset('theme/client/images/content/p3.jpg') }}" alt="patner_img">
                                </div>
                            </div>
                            <div class="item">
                                <div class="prs_pn_img_wrapper">
                                    <img src="{{ asset('theme/client/images/content/p4.jpg') }}" alt="patner_img">
                                </div>
                            </div>
                            <div class="item">
                                <div class="prs_pn_img_wrapper">
                                    <img src="{{ asset('theme/client/images/content/p5.jpg') }}" alt="patner_img">
                                </div>
                            </div>
                            <div class="item">
                                <div class="prs_pn_img_wrapper">
                                    <img src="{{ asset('theme/client/images/content/p6.jpg') }}" alt="patner_img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div id="showtime-modal" class="modal">
		<div class="modal-content">
			<span class="close-btn">&times;</span>
			<div class="showtime-container">
				<div class="date-display active">
					<div class="date-top">08</div>
					<div class="date-middle">31</div>
					<div class="date-bottom">T7</div>
				</div>
				<div class="date-display">
					<div class="date-top">09</div>
					<div class="date-middle">01</div>
					<div class="date-bottom">CN</div>
				</div>
				<div class="date-display">
					<div class="date-top">09</div>
					<div class="date-middle">02</div>
					<div class="date-bottom">T2</div>
				</div>
				<div class="date-display">
					<div class="date-top">09</div>
					<div class="date-middle">03</div>
					<div class="date-bottom">T3</div>
				</div>
				<div class="date-display">
					<div class="date-top">09</div>
					<div class="date-middle">04</div>
					<div class="date-bottom">T4</div>
				</div>
	
	
	
				<div class="location-selection">
					<button class="location-btn active">Hà Nội</button>
					<button class="location-btn">Hồ Chí Minh</button>
					<button class="location-btn">Huế</button>
					<button class="location-btn">Đà Nẵng</button>
				</div>
	
				<div class="format-selection">
					<button class="format-btn active">2D Phụ Đề</button>
					<button class="format-btn">Thuyết Minh</button>
					<button class="format-btn">VietSub</button>
					<button class="format-btn">3D</button>
					<button class="format-btn">Chẳng hạn thế</button>
				</div>
	
				<div class="showtimes">
					<div class="showtime-item">
						<h3>Poly Hà Đông</h3>
						<p>Rạp 2D</p>
						<button class="time-btn">7:30 am</button>
						<button class="time-btn">10:00 am</button>
						<button class="time-btn">12:30 pm</button>
						<button class="time-btn">14:00 pm</button>
						<button class="time-btn">16:30 pm</button>
						<button class="time-btn">20:00 pm</button>
						<!-- Add more times as needed -->
					</div>
					<div class="showtime-item">
						<h3>Poly Cầu Giấy</h3>
						<p>Rạp 2D</p>
						<button class="time-btn">7:30 am</button>
						<button class="time-btn">10:00 am</button>
						<!-- Add more times as needed -->
					</div>
					<div class="showtime-item">
						<h3>Poly Thanh Xuân</h3>
						<p>Rạp 2D</p>
						<button class="time-btn">7:30 am</button>
						<button class="time-btn">10:00 am</button>
						<!-- Add more times as needed -->
					</div>
					<!-- Add more showtime-items as needed -->
				</div>
			</div>
		</div>
	</div>
	<script>
		// Handle date selection
		document.addEventListener('DOMContentLoaded', () => {
			document.querySelectorAll('.date-display').forEach(btn => {
	
				btn.addEventListener('click', () => {
					// console.log('Button clicked:', btn);
	
					const currentActive = document.querySelector('.date-display.active');
					if (currentActive) {
						currentActive.classList.remove('active');
					}
					btn.classList.add('active');
				});
			});
		});
	
		// Handle location selection
		document.querySelectorAll('.location-btn').forEach(btn => {
			btn.addEventListener('click', () => {
				document.querySelector('.location-btn.active').classList.remove('active');
				btn.classList.add('active');
			});
		});
	
		// Handle format selection
		document.querySelectorAll('.format-btn').forEach(btn => {
			btn.addEventListener('click', () => {
				document.querySelector('.format-btn.active').classList.remove('active');
				btn.classList.add('active');
			});
		});
	
		// Optional: Handle time selection (if needed)
		document.querySelectorAll('.time-btn').forEach(btn => {
			btn.addEventListener('click', () => {
				// You can add custom functionality here for when a time is selected
				alert(`You selected the ${btn.innerText} showtime.`);
			});
		});
	
		// Modal hiển thị 
		// Lấy các phần tử
		const modal = document.getElementById("showtime-modal");
		const btn = document.getElementById("buy-ticket-btn");
		const span = document.getElementsByClassName("close-btn")[0];
	
		// Khi người dùng click vào nút "Mua vé", modal sẽ hiển thị
		btn.onclick = function() {
			modal.style.display = "block";
		}
	
		// Khi người dùng click vào nút "X" (close), modal sẽ đóng lại
		span.onclick = function() {
			modal.style.display = "none";
		}
	
		// Khi người dùng click ra ngoài modal, modal sẽ đóng lại
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	</script>
	
  
@endsection
