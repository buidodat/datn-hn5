@extends('client.layouts.master')

@section('title')
    Đặt mật khẩu
@endsection

@section('content')
    <div class="content-forgot row">
        <div class="bg-round-forgot col-md-12">
            <h2 style="text-align: center">Đặt mật khẩu</h2>
            <div class="col-md-3"></div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="col-md-6 forgot-fom">

                    <div class="st_profile_input float_left">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="st_profile_input float_left">
                        <label for="password">Mật khẩu</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="st_profile_input float_left">
                        <label for="password-confirm">Xác nhận mật khẩu</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>

                    <div class="rs-pw">
                        <button type="submit" class="btn btn-primary">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/login.css') }}" />
@endsection
