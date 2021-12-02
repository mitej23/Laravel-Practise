@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <a href="{{ route('posts') }}">
            Posts
        </a>
        <a href="{{ route('dashboard') }}">
            Dashboard
         </a>
    </div>
@endsection