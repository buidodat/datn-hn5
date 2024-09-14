@extends('client.layouts.master')

@section('title')
    Đăng nhập
@endsection

@section('content')
    <div class="content-login-3 row">

        <div class="bg-round-login col-md-12">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-md-6 fom-login">
                    <h2 class="text-login">Đăng nhập</h2>

                    <div class="st_profile_input float_left">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="email"
                               autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                        <input id="password" type="password" placeholder="Mật khẩu"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                               autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check custom-form">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Nhớ mật khẩu') }}
                        </label>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link quenpw" href="{{ route('password.request') }}">
                                Quên mật khẩu?
                            </a>
                        @endif

                    </div>

                    <div class="float_left nutdn">
                        <button type="submit">Đăng nhập</button>
                    </div>
                    <div class="st_form_pop_or_btn float_left"></div>
                    <div class="st_form_pop_facebook_btn float_left nutfb">
                        <a href="#"> Đăng nhập với Facebook</a>
                    </div>
                    <div class="float_left nutgm">
                        <a href="#"> Đăng nhập với Google</a>
                    </div>
                    <div class="st_form_pop_signin_btn float_left">
                        <h4>Không có tài khoản? <a href="{{ route('register') }}">Đăng ký</a></h4>
                        <h5>Chấp nhận <a href="#">Điều Khoản &amp; Điều kiện</a> của chúng tôi!</h5>
                    </div>
                </div>
            </form>

            <div class="col-md-6 logo-login">
                <img src="{{ asset('theme/client/images/movie1.png') }}" alt="">
            </div>
        </div>


    </div>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/login.css') }}"/>
@endsection
