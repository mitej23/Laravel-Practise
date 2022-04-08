<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 

    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script> --}}
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
                    <input id="nav-right-text" type="submit" value="logout"></button>
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