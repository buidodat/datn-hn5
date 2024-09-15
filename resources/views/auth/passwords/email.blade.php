@extends('client.layouts.master')

@section('title')
    Quên mặt khẩu
@endsection

@section('content')
    <div class="content-forgot row">
        <div class="bg-round-forgot col-md-12">
            <h2 class="text-login">Quên mật khẩu</h2>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-md-3"></div>
            <form class="fom2" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="col-md-6 forgot-fom">
                    <div class="st_profile_input float_left">

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Nhập email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="rs-pw">
                        <button type="submit">
                            Gửi email
                        </button>
                    </div>
                    <div class="st_form_pop_signin_btn float_left">
                        <h4>Đã có tài khoản? <a href="{{ route('login')}}">Đăng nhập</a></h4>
                    </div>
                </div>
            </form>

            <div class="col-md-3"></div>
        </div>

    </div>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/login.css') }}" />
@endsection
