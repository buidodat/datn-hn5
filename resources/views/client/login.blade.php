@extends('client.layouts.master')

@section('title')
    Login
@endsection

@section('content')

    <div class="content-login-3 row">
        <h2 style="text-align: center">Đăng nhập</h2>
        <div class="col-md-6">

            <div class="st_profile_input float_left">
                <label>Email</label>
                <input type="text" >
            </div>
            <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                <input type="password" placeholder="Mật khẩu">
            </div>
            <div class="st_form_pop_fp float_left">
                <h3><a href="#" data-toggle="modal" data-target="#myModa2" target="_blank">Quên mật khẩu?</a></h3>
            </div>
            <div class="st_form_pop_login_btn float_left"><a href="page-1-7_profile_settings.html">Đăng nhập</a>
            </div>
            <div class="st_form_pop_or_btn float_left">
                    <span>Hoặc</span>
            </div>
            <div class="st_form_pop_facebook_btn float_left nutfb" ><a href="#"> Đăng nhập với Facebook</a>
            </div>
            <div class="st_form_pop_gmail_btn float_left nutgm" ><a href="#"> Đăng nhập với Google</a>
            </div>
            <div class="st_form_pop_signin_btn float_left">
                <h4>Không có tài khoản? <a href="#" data-toggle="modal" data-target="#myModa3" target="_blank">Đăng ký</a></h4>
                <h5>Chấp nhận <a href="#">Điều Khoản &amp; Điều kiện</a> của chúng tôi! {{--&amp; <a href="#">Privacy Policy</a>--}}</h5>
            </div>
        </div>
        <div class="col-md-6">
            <div class="logo-container">
                <img src="{{ asset('theme/client/images/auth-img.png') }}" alt="">
            </div>
        </div>

    </div>

@endsection




