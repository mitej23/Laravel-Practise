@extends('admin.index')

@section('dashboard-content')
    <div class="admin-content">
        <h1>Approvals Pending</h1>
        <div class="posts-container">
            @if($posts->count() > 0)
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
                            <a href="{{route('admin.approve', $post->id)}}" >Approve</a>
                            <a href="{{route('admin.delete', $post->id)}}" >Delete</a>
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