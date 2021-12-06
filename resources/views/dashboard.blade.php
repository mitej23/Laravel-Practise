@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <div class="dashboard-title-bar">
            <p class="dashboard-title">Library</p>
            <div class="dashboard-features-container">
                <div class="dashboard-add-post">
                    <a href="{{route('posts')}}">
                        <p>Add</p>
                        <x-ri-add-fill style="height:20px;"/>
                    </a>
                </div>
                <input type="text" class="dashboard-search-bar" placeholder="Search">
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
                        </div>
                        <div class="download-btn">
                            <a href="{{route('download', basename($post->path))}}" class="btn btn-primary"><x-heroicon-o-download style="height: 25px;widht:25px;"/></a>
                        </div>
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