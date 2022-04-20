@extends('layouts.app')

@section('content')
    <div class="login">
        <h2>Login</h2>
        @if (session('status'))
            <div class="error-text">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{route('login')}}" method="post" class="auth-form">
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Your email" value="{{old('email')}}">
            @error('email')
                <div class="error-text">{{ $message }}</div>
            @enderror
            <br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Your password" >
            @error('password')
                <div class="error-text">{{ $message }}</div>
            @enderror            
            <button type="submit" id="auth-submit-btn" value="Login" style="margin-top:30px;margin-bottom:15px;font-size:1.125rem;">Login</button>
        </form>
    </div>
@endsection