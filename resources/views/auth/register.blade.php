@extends('layouts.app')

@section('content')
    <div class="register">
        <h2>Register</h2>
        <form action="{{route('register')}}" method="post" class="auth-form">
            @csrf
            <label for="name">Name</label>
         
            <input type="text" name="name" id="name" placeholder="Your name" value="{{old('name')}}">
            @error('name')
                <div class="error-text">{{ $message }}</div>
            @enderror
            <br>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Your username" value="{{old('username')}}">
            @error('username')
                <div class="error-text">{{ $message }}</div>
            @enderror
            <br>
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
            <br>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" >
            @error('password_confirmation')
                <div class="error-text">{{ $message }}</div>
            @enderror
            <br>
            <button type="submit" value="Register" id="auth-submit-btn" style="margin-top:30px;margin-bottom:15px;font-size:1.125rem;">Submit</button>
        </form>
    </div>
@endsection