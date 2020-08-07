<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SmartBoon</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background: url('{{ asset('faculty.png') }}') no-repeat center center/cover;
            /* background-color: #37474F; */
            color: white;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
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
            background-color: #FF8A66;
            padding: 50px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5)
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: white;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        .btn {
            font-size: 20px;
            border: 1px solid white;
            color: white
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                <h1 style="color: white">SmartBoon</h1>
            </div>
            @if (Route::has('login'))
            <div>
                @auth
                <a href="{{ url('/home') }}" class="btn ">Home</a>
                @else
                <a href="{{ route('login') }}" class="btn">Login</a>

                <a href="{{ route('password.request') }}"
                    class="btn">Register</a>
                @endauth
            </div>
            @endif
        </div>
    </div>
</body>

</html>
