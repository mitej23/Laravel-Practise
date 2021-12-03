@extends('layouts.app')

@section('content')
    <div class="posts-body">
        <div class="posts">
            {{-- upload a file --}}
            <div class="upload-file">
                @error('file')
                    <div class="error-text">{{ $message }}</div>
                @enderror
                <form action="{{route('posts')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Title</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="name">
                    <label for="file">File</label>
                    <input type="file" class="form-control-file" name="file" id="file">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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