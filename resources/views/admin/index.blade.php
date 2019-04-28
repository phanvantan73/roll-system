<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background-image: url('./image/bg.png');
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }

            a {
              color: white;
              font-weight: bold;
              text-decoration: none;
              background-color: transparent;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                
                font-size: 15px;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                color: #fff;
                font-weight: bold;
                
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .welcome-school {
                color: white;
                font-size: 40px;
                font-weight: bold;
                text-shadow: 2px 2px 1px #c8c8c8;
                margin: 40px 0;
            }
            .content-box {
                width: 1000px;
                height: 500px;
                margin-top: -250px;
                background-color: white;
            }
            
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('dashboard') }}">Trang chủ || </a>
                        <a href="{{ url('/get-all-student') }}">Sinh viên || </a>
                        <a href="{{ url('/get-all') }}">Tổng quan </a>
                    @else
                        <a href="{{ route('login') }}">Đăng nhập ||</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Đăng ký</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
            </div>
        </div>
    </body>
</html>
