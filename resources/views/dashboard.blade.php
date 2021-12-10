@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <div class="dashboard-title-bar">
            <p class="dashboard-title">Library</p>
            <div class="dashboard-features-container">
                <div class="dashboard-add-post">
                    <a href="{{route('posts')}}">
                        <p>Add</p>
                    </a>
                </div>
                <div class="dashboard-search">
                    <form action="{{route('dashboard')}}" method="get" style="display: flex;">
                        <input type="text" name="search" class="dashboard-search-bar" placeholder="Search" value="{{old('search')}}">
                        <button type="submit" class="dashboard-add-post" style="margin-top:0px;margin-bottom:0px;width:max-content;">
                            <p>Search</p>  
                        </button>
                    </form>
                </div>
               
            </div>
        </div>
        <div class="posts-container">
            @if($posts->count())
                @foreach ($posts as $post)
                    <div class="post">
                        <div class="post-data">
                            <div class="post-title">
                                <p >{{$post->name}}</>
                            </div>
                            <div class="post-date">
                                <p>Added on: {{$post->created_at->format('d/m/Y')}}</p>
                            </div>
                            <div class="created_by">
                                <p>By: {{$post->user->name}}</p>
                            </div>
                            <a href="{{route('download', basename($post->path))}}" >Download</a>
                        </div>
                        
                        {{-- <div class="download-btn">
                           
                        </div> --}}
                    </div>
                @endforeach
            @else
                <div class="no-posts">
                    <h3>No posts yet</h3>
                </div>
            @endif
        </div>
    </div>
@endsection