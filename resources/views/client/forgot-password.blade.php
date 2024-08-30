@extends('client.layouts.master')

@section('title')
Login
@endsection

@section('content')

<div class="row">
    <div class="auth-container">
        <div class="content">

            <div class="form-input">
                <h2 class="text-login">Quên mật khẩu</h2>
                <form action="#" method="POST">

                    <div class="input-container">
                        <input type="email" name="email" placeholder="Nhập email">
                    </div>

                    <div class="forgotpass">
                        <button type="submit">Gửi email</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>


@endsection




