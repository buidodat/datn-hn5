@extends('client.layouts.master')

@section('title')
    Đăng ký
@endsection

@section('content')
    <div class="content-login-3 row">
        <div class="bg-round-regis col-md-12">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="col-md-6 fom-regis">
                    <h2 class="text-login">Đăng ký</h2>

                    <div class="st_profile_input float_left">
                        <input id="name" type="text" placeholder="Họ và tên"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}"  autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="st_profile_input st_profile__pass_input_pop float_left">
                        <input id="email" type="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}"  autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                        <input id="password" type="password" placeholder="Mật khẩu"
                            class="form-control @error('password') is-invalid @enderror" name="password" 
                            autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                        <input id="password-confirm" type="password" placeholder="Nhập lại mật khẩu" class="form-control" name="password_confirmation"
                             autocomplete="new-password">
                    </div>

                    <div class="float_left nutdn" style="margin-top: 15px;">
                        <button type="submit">
                            Đăng ký
                        </button>
                    </div>

                    <div class="st_form_pop_facebook_btn float_left nutfb"><a href="#"> Đăng ký với Facebook</a>
                    </div>
                    <div class="st_form_pop_gmail_btn float_left nutgm"><a href="#"> Đăng ký với Google</a>
                    </div>
                    <div class="st_form_pop_signin_btn float_left">
                        <h4>Đã có tài khoản? <a href="{{ route('login')}}">Đăng nhập</a></h4>
                    </div>
                </div>
            </form>

            <div class="col-md-6 logo-register">

                <img src="{{ asset('theme/client/images/movie1.png') }}" alt="">

            </div>
        </div>
    </div>
@endsection


@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/login.css') }}" />
@endsection
