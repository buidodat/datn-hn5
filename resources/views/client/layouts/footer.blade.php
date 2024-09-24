{{--<div class="prs_newsletter_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="prs_newsletter_text">
                    <h3>Get update sign up now !</h3>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="prs_newsletter_field">
                    <input type="text" placeholder="Enter Your Email">
                    <button type="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>--}}
<!-- prs Newsletter Wrapper End -->
<!-- prs footer Wrapper Start -->
<div class="prs_footer_main_section_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="prs_footer_cont1_wrapper prs_footer_cont1_wrapper_1">
                    <h2>Poly Cenimas</h2>

                    <ul>
                        <li style="margin-top: 0">
                            <a href="#">
                                <img style=" height: 80px"
                                     src="{{ asset('theme/client/images/header/logo7.svg') }}" alt="logo"/>
                            </a>
                        </li>
                        <li>
                             <span style="color: rgba(255, 255, 255, 0.57);">Trang mạng xã hội</span> <br>
                            <a href="#"><i style="color: #ffffff; font-size: 20px;margin: 6% 3%;" class="fa fa-facebook"></i></a>

                            <a href="#"><i style="color: #ffffff; font-size: 20px;margin: 6% 3%;" class="fa fa-twitter"></i></a>

                            <a href="#"><i style="color: #ffffff; font-size: 20px;margin: 6% 3%;" class="fa fa-linkedin"></i></a>

                            <a href="#"><i style="color: #ffffff; font-size: 20px;margin: 6% 3%;" class="fa fa-youtube-play"></i></a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="prs_footer_cont1_wrapper prs_footer_cont1_wrapper_1">
                    <h2>Quy định & điều khoản</h2>
                    <ul>
                        <li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Chính sách và Điều khoản</a>
                        </li>
                        <li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Giá vé</a>
                        </li>
                        <li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Tin tức</a>
                        </li>
                        <li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">Liên hệ</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="prs_footer_cont1_wrapper prs_footer_cont1_wrapper_2">
                    <h2>chi nhánh</h2>
                    <ul>
                        @foreach($listBranch as $branch)
                            <li><i class="fa fa-circle"></i> &nbsp;&nbsp;<a href="#">{{ $branch->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="prs_footer_cont1_wrapper prs_footer_cont1_wrapper_3">
                    <h2>Thông tin website</h2>
                    <ul>
                        <li>
                            <span style="color: rgba(255, 255, 255, 0.57);">Email:</span> &nbsp;&nbsp;
                            <span style="color: #ff4444;">Polycenimas@gmail.com</span>
                        </li>
                        <li>
                            <span style="color: rgba(255, 255, 255, 0.57);">Hotline:</span> &nbsp;&nbsp;
                            <span style="color: #ff4444">1900.2004</span>
                        </li>
                        <li>
                            <span style="color: rgba(255, 255, 255, 0.57);">Giờ làm việc:</span> &nbsp;&nbsp;
                            <span style="color: #ff4444">9h - 24h (Tất cả các ngày bao gồm cả Lễ, Tết)</span>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="prs_bottom_footer_wrapper"><a href="javascript:" id="return-to-top"><i
            class="flaticon-play-button"></i></a>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="prs_bottom_footer_cont_wrapper">
                    <p style=" text-align: center;">
                        Copyright @ 2024 by <a href="#">POLY CENIMAS</a> {{--. All rights reserved - Design by <a
                            href="#">Webstrot</a>--}}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
