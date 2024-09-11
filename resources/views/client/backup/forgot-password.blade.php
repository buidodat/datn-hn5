@extends('client.layouts.master')

@section('title')
    Forgot password
@endsection

@section('content')

    <div class="content-login-3 row" >
        <h2 style="text-align: center">Quên mật khẩu</h2>
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <div class="st_profile_input float_left">
                <label>Email</label>
                <input type="text" >
            </div>


            <div class="st_form_pop_login_btn" style="margin: 25px auto 0px auto; width: 50%; text-align: center;">
                <a href="page-1-7_profile_settings.html">Gửi email</a>
            </div>

            <div class="st_form_pop_signin_btn float_left">
                <h4>Đã có tài khoản? <a href="#" data-toggle="modal" data-target="#myModa3" target="_blank">Đăng nhập</a></h4>
            </div>
        </div>
        <div class="col-md-3"></div>


    </div>




@endsection



