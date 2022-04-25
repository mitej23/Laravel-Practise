@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <div class="dashboard-title-bar">
            <h2 class="dashboard-title">Library</h2>
            <div class="dashboard-features-container">
                <button class="dashboard-btn" onclick="location.href='{{route('posts')}}'">
                    Add
                </button>
            </div>
        </div>
        <div class="searh-filter-container">
            <form action="{{route('dashboard')}}" method="get" style="display: flex;margin-bottom:20px">
                <input type="text" name="search" class="dashboard-search-bar" placeholder="Search" value="{{$search}}">
                <select class="form-control tags-filter" multiple="multiple" name="tags[]">
                    @foreach ($alltags as $tag)
                        <option class="filter-options"
                            @if($tags != null)
                                @if (in_array($tag->name, $tags))
                                    selected  
                                @endif
                            @endif
                        >{{$tag->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="dashboard-btn" style="margin-top:0px;margin-bottom:0px;width:max-content;">
                    Search  
                </button>
            </form>
        </div>
        <div class="posts-container">
            @if($posts->count())
                @foreach ($posts as $post)
                    <div class="post">
                        <div class="post-data">
                            <div class="post-title" onclick="location.href='{{route('pdf', basename($post->path))}}'" > 
                                <p >{{$post->name}}</p>
                            </div>
                            <div class="post-date">
                                <p>Added on: {{$post->created_at->format('d/m/Y')}}</p>
                            </div>
                            <div class="created_by">
                                <p>By: {{$post->user->name}}</p>
                            </div>
                            <div class="tag-holder">
                                @foreach($post->tags as $tag)
                                    <div class="tag">
                                        <p>{{ $tag->name }}</p>
                                    </div>     
                                @endforeach
                            </div>
                            
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            onclick="location.href='{{route('download', basename($post->path))}}'" >    
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                            <polyline points="7 11 12 16 17 11" />
                            <line x1="12" y1="4" x2="12" y2="16" />
                        </svg>
                       
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
        <div class="chat-close"style="display: flex;align-content: center;justify-content: center;align-items: center;">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="16" height="16" viewBox="0 0 24 24" stroke-width="1" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
              </svg>
        </div>
        <div class="chats">
            <div class="insert-here">

            </div>
        </div>
        <div style="display: flex;">
            <input type="text" name="" class="chat-box-input" placeholder="type.." >
            <button type="submit" class="chatbox-send" style="margin-top:0px;margin-bottom:0px;width:max-content;display: flex;
                justify-content: center;align-items: center;padding-right: 9px;"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    style="transform: rotate(45deg);"    
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <line x1="10" y1="14" x2="21" y2="3" />
                    <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" />
                  </svg>
            </button>
        </div>
    </div>

    <div class="chat-icon" >
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-circle" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
            <line x1="12" y1="12" x2="12" y2="12.01" />
            <line x1="8" y1="12" x2="8" y2="12.01" />
            <line x1="16" y1="12" x2="16" y2="12.01" />
        </svg>
    </div>

    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script> --}}

    <script type="text/javascript">



        $(function () {
            $(document).ready(function () {

                $(".tags-filter").select2({
                    allowClear: true,
                    placeholder: "Filter by tags",
                    tags: true,
                    display: "inline-block",
                    maximumSelectionLength: 4
                });
                $(".select2-search__field").css("fontSize", "1rem");
               
            });
        });



        document.addEventListener('DOMContentLoaded', function() {
            let chatBox = document.querySelector('.chat-box');
            let chatClose = document.querySelector('.chat-close');
            let chatIcon = document.querySelector('.chat-icon');

            chatIcon.addEventListener('click', function() {
                chatIcon.style.display = 'none';
                chatBox.style.display = 'block';
            });

            chatClose.addEventListener('click', function() {
                chatIcon.style.display = 'flex';
                chatBox.style.display = 'none';
            });

            //tag-input
            


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