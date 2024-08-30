@extends('client.layouts.master')

@section('title')
    Login
@endsection

@section('content')

    <div class="row">
        <div class="auth-container">
            <div class="content">

                    <div class="logo-container">
                        <img src="{{ asset('theme/client/images/auth-img.png') }}" alt="">
                    </div>

                    <div class="form-input">
                        <h2 class="text-login">Đăng nhập</h2>
                        <form action="#" method="POST" >

                            <div class="input-container">
                                <input type="email" name="email" placeholder="Email">
                            </div>
                            <div class="input-container">
                                <input type="password" name="password" placeholder="Password" id="your-password">
                            </div>

                            <div class="checkbox-container">
                                <div>
                                    <input type="checkbox" id="remember">
                                    <label for="remember">Lưu đăng nhập</label>
                                </div>

                                <a href="#" class="forgot-password">Quên mật khẩu?</a>
                            </div>

                            <div class="dangnhap">
                                <button type="submit" >Đăng nhập</button>
                            </div>


                            <div class="separator">Hoặc</div>

                            <div class="social-buttons" style="display: flex; justify-content: space-around">
                                <button>Facebook</button>
                                <button>Google</button>
                            </div>

                            <div class="signup-link">
                                <p>Không có tài khoản? <a href="#">Đăng ký</a></p>
                            </div>

                        </form>
                    </div>

            </div>
        </div>
    </div>


@endsection




