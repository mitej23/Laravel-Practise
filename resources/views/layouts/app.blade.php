<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title> 

    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png')}}">   

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    
</head>
<body>
    <div class="nav">
        <a href="{{route("home")}}" style="text-decoration: none;color: black;" class="logo">
            <img src="{{ asset('images/nm_logo.png') }}" alt="tag" id="logo" height="60" width="60"/>
            <div class="logo-text-container">
                <p>NM College</p>
                <p>Library</p>
            </div>
        </a>            
        <div class="nav-right">
            @auth
                <a style="margin-right: 30px">{{auth()->user()->name}}</a>    
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <input id="nav-right-text" type="submit" value="logout" style="background-color: var(--color-primary)"></button>
                </form>
            @endauth

            @guest
                <a >Contact us</a>
            @endguest
        </div>
    </div>
    @yield('content')
</body>
</html>