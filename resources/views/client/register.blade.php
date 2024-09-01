@extends('client.layouts.master')

@section('title')
    Register
@endsection

@section('content')

    <div class="row row-login">
        <div class="auth-container">
            <div class="content-register">

                <div class="form-input-2">
                    <h2 class="text-login">Đăng ký</h2>
                    <form action="#" method="POST">

                        <div class="input-container">
                            <input type="text" name="name" placeholder="Tên người dùng">
                        </div>
                        <div class="input-container">
                            <input type="email" name="email" placeholder="Email">
                        </div>
                        <div class="input-container">
                            <input type="password" name="password" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="input-container">
                            <input type="password" name="re-password" placeholder="Nhập lại mật khẩu">
                        </div>

                        <div class="checkbox-container">
                            <div>
                                <input type="checkbox" id="remember">
                                <label for="remember">Đồng ý với điều khoản của chúng tôi!</label>
                            </div>
                        </div>

                        <div class="dangnhap">
                            <button type="submit" >Đăng ký</button>
                        </div>

                        <div class="separator">Hoặc</div>

                        <div class="social-buttons" style="display: flex; justify-content: space-around">
                            <button>Facebook</button>
                            <button>Google</button>
                        </div>

                        <div class="signup-link">
                            <p>Đã có tài khoản? <a href="#">Đăng nhập</a></p>
                        </div>

                    </form>
                </div>

                <div class="logo-container-2">
                    <img src="{{ asset('theme/client/images/auth-img.png') }}" alt="">
                </div>

            </div>
        </div>
    </div>


@endsection




