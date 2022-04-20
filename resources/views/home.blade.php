@extends('layouts.app')

@section('content')
    <div class="home">
        {{-- <a href="{{ route('posts') }}">
            Posts
        </a>
        <a href="{{ route('dashboard') }}">
            Dashboard
        </a> --}}
        <h1 style="font-size: 3rem;font-weight: 900;width: 70%;text-align: center;" id="headline">Access 1000's of Books from our Library</h1>
        <div class="home-btns-container" style="margin-top: 1rem;">
           {{-- <div class="auth-btn" style="background-color: var(--color-secondary);">
               <a style="text-decoration: none;color: white;font-weight:500" href="{{route('register')}}">Register</a>
           </div> --}}
           <div class="auth-btn" style="background-color: var(--color-secondary);">
                <a style="text-decoration: none;color: white;font-weight:500" href="{{route('login')}}">Login</a>
           </div>
        </div>
    </div>
@endsection