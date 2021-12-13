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
    <div class="chat-box" style="display: none">
        <div class="chat-close">
        </div>
        <div class="chats">
            <div class="insert-here">

            </div>
        </div>
        <div style="display: flex;">
            <input type="text" name="" class="chat-box-input" placeholder="type.." >
            <button type="submit" class="chatbox-send" style="margin-top:0px;margin-bottom:0px;width:max-content;">
                <p>Send</p>  
            </button>
        </div>
    </div>

    <div class="chat-icon" ></div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <script type="text/javascript">



        document.addEventListener('DOMContentLoaded', function() {
            let chatBox = document.querySelector('.chat-box');
            let chatClose = document.querySelector('.chat-close');
            let chatIcon = document.querySelector('.chat-icon');

            chatIcon.addEventListener('click', function() {
                chatIcon.style.display = 'none';
                chatBox.style.display = 'block';
            });

            chatClose.addEventListener('click', function() {
                chatIcon.style.display = 'block';
                chatBox.style.display = 'none';
            });


            $(document).on('click' , '.chatbox-send',function(e){
                e.preventDefault();
                var data = $('.chat-box-input').val();

                if(data == ''){
                    console.log('empty');
                    return false;
                }

                $('.insert-here').append(`<div id="question">
                         <p>${data}</p>
                     </div>`
                );

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/admin",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'data': data
                    },
                    dataType: "json",
                    success: function(data){
                        $('.insert-here').append(`<div id="answer">
                            <p>${data.answer}</p>
                        </div>`
                        );
                        $('.chat-box-input').val('');
                    }

                })
            });

        });
    </script>
@endsection