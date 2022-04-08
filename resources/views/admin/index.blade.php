<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="admin-dashboard">
        <div class="side-bar">
            <div class="logo">
                <img src="{{ asset('images/logo.jpg') }}" id="logo"/> 
            </div>
            <div class="menu">
                <a href="{{route('admin.users')}}" class="{{ Request::routeIs('admin.users') ? 'active' : '' }}">Users</a>
                <a href="{{route('admin.qna')}}" class="{{ Request::routeIs('admin.qna') ? 'active' : '' }}">Q&A</a>
                <a href="{{route('admin.approval')}}" class="{{ Request::routeIs('admin.approval') ? 'active' : '' }}">Approvals</a>
                <a href="{{route('logout')}}" >Logout</a>
            </div>
        </div>
        @yield('dashboard-content')
    </div>   
</body>
</html>