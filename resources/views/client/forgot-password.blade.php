@extends('client.layouts.master')

@section('title')
    Forgot password
@endsection

@section('content')

    <div class="row row-login">
        <div class="auth-container">
            <div class="content-forgot">

                <div class="form-input-3">
                    <h2 class="text-forgot">Quên mật khẩu</h2>
                    <form action="#" method="POST">

                        <div class="input-container-3">
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



