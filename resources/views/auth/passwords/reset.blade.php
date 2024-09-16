@extends('client.layouts.master')

@section('title')
    Đặt mật khẩu
@endsection

@section('content')
    <div class="content-forgot row">
        <div class="bg-round-forgot col-md-12">
            <h2 class="text-login">Đặt mật khẩu</h2>
            <div class="col-md-3"></div>
            <form class="fom2"  method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="col-md-6 forgot-fom">

                    <div class="st_profile_input float_left">

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ $email ?? old('email') }}" placeholder="Email của bạn" required autocomplete="email"
                               autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="st_profile_input float_left" style="margin: 10px 0">

                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password" placeholder="Nhập mật khẩu mới">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="st_profile_input float_left">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               required autocomplete="new-password" placeholder="Xác nhận mật khẩu">
                    </div>

                    <div class="rs-pw-2" >
                        <button type="submit" class="btn" style="margin-top: 22px; margin-bottom: 10px;">
                            Đặt lại mật khẩu
                        </button>
                    </div>
                </div>
            </form>

            <div class="col-md-3"></div>
        </div>

    </div>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/login.css') }}"/>
@endsection
