@extends('layouts.app')

@section('content')
    <div class="home">
        {{-- <a href="{{ route('posts') }}">
            Posts
        </a>
        <a href="{{ route('dashboard') }}">
            Dashboard
        </a> --}}
        <h1>Access 1000's of Books from our Library</h1>
        <div class="home-btns-container">
           <div class="auth-btn">
               <a style="text-decoration: none" href="{{route('register')}}">Register</a>
           </div>
           <div class="auth-btn">
            <a style="text-decoration: none" href="{{route('login')}}">Login</a></div>
           </div>
        </div>
    </div>
@endsection