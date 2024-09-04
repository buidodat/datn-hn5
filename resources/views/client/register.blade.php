@extends('client.layouts.master')

@section('title')
    Register
@endsection

@section('content')

    <div class="content-login-3 row" >
        <h2 style="text-align: center">Đăng ký tài khoản</h2>
        <div class="col-md-6">

            <div class="st_profile_input float_left">
                <label>Họ và tên</label>
                <input type="text" >
            </div>
            <div class="st_profile_input float_left">
                <label>Email</label>
                <input type="text" >
            </div>
            <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                <input type="password" placeholder="Mật khẩu">
            </div>
            <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                <input type="password" placeholder="Nhập lại mật khẩu">
            </div>

            <div class="st_form_pop_login_btn float_left" style="margin-top: 15px;"><a href="page-1-7_profile_settings.html">Đăng ký</a>
            </div>
            <div class="st_form_pop_or_btn float_left">
                <span>Hoặc</span>
            </div>
            <div class="st_form_pop_facebook_btn float_left nutfb" ><a href="#"> Đăng ký với Facebook</a>
            </div>
            <div class="st_form_pop_gmail_btn float_left nutgm" ><a href="#"> Đăng ký với Google</a>
            </div>
            <div class="st_form_pop_signin_btn float_left">
                <h4>Đã có tài khoản? <a href="#" data-toggle="modal" data-target="#myModa3" target="_blank">Đăng nhập</a></h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="logo-container-2">
                <img src="{{ asset('theme/client/images/auth-img.png') }}" alt="">
            </div>
        </div>

    </div>


@endsection




