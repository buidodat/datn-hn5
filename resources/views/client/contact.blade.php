@extends('client.layouts.master')

@section('title')
    Trang Chủ
@endsection

@section('content')
    <div class="prs_title_main_sec_wrapper">
        <div class="prs_title_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_title_heading_wrapper">
                        <h2>contact us</h2>
                        <ul>
                            <li><a href="#">Home</a>
                            </li>
                            <li>&nbsp;&nbsp; >&nbsp;&nbsp; contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs title wrapper End -->
    <!-- prs contact form wrapper Start -->
    <div class="prs_contact_form_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="prs_contact_left_wrapper">
                        <h2>Contact us</h2>
                    </div>
                    <div class="row">
                        <form>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="prs_contact_input_wrapper">
                                    <input name="full_name" type="text" class="require" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="prs_contact_input_wrapper">
                                    <input type="email" class="require" data-valid="email"
                                        data-error="Email should be valid." placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_contact_input_wrapper">
                                    <textarea name="message" class="require" rows="7" placeholder="Comment"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="response"></div>
                                <div class="prs_contact_input_wrapper prs_contact_input_wrapper2">
                                    <ul>
                                        <li>
                                            <input type="hidden" name="form_type" value="contact" />
                                            <button type="button" class="submitForm">Submit</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="prs_contact_right_section_wrapper">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i>
                                    &nbsp;&nbsp;&nbsp;facebook.com/presenter</a>
                            </li>
                            <li><a href="#"><i class="fa fa-twitter"></i> &nbsp;&nbsp;&nbsp;twitter.com/presenter</a>
                            </li>
                            <li><a href="#"><i class="fa fa-vimeo"></i> &nbsp;&nbsp;&nbsp;vimeo.com/presenter</a>
                            </li>
                            <li><a href="#"><i class="fa fa-instagram"></i>
                                    &nbsp;&nbsp;&nbsp;instagram.com/presenter</a>
                            </li>
                            <li><a href="#"><i class="fa fa-youtube-play"></i>
                                    &nbsp;&nbsp;&nbsp;youtube.com/presenter</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
