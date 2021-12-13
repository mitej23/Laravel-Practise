<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="admin-dashboard">
        <div class="side-bar">
            <div class="logo">
                <h2>Dashboard</h2>
            </div>
            <div class="menu">
                <a href="{{route('admin.users')}}">Users</a>
                <a href="{{route('admin.chat')}}">Chats</a>
                <a href="{{route('admin.approval')}}">Approvals</a>
                <a href="{{route('logout')}}">Logout</a>
            </div>
        </div>
        @yield('dashboard-content')
    </div>   
</body>
</html>