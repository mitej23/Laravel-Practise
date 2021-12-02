@extends('layouts.app')

@section('content')
    <div class="login">
        <h1>Login</h1>
        @if (session('status'))
            <div class="error-text">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{route('login')}}" method="post">
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
            <button type="submit" value="Login">Login</button>
        </form>
    </div>
@endsection