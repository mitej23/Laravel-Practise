<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <div class="nav">
        <div class="logo">
            NM Library
        </div>
        <div class="nav-right">
            @auth
                <a style="margin-right: 30px">{{auth()->user()->name}}</a>    
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <input type="submit" value="logout"></button>
                </form>
            @endauth

            @guest
                <a href="{{route('register')}}">Register</a>
                <a href="{{route('login')}}">Login</a>
            @endguest
        </div>
    </div>
    @yield('content')
</body>
</html>