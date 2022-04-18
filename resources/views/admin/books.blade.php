@extends('admin.index')

@section('dashboard-content')
    <div class="admin-content">
        <div class="dashboard-title-bar">
            <h2>Books</h2>
            <div class="dashboard-features-container">
                <button class="dashboard-btn" onclick="location.href='{{route('posts')}}'">
                    Add
                </button>
            </div>
        </div>  
        {{-- <h2>Search: {{$search}}</h2>
        <h2>Approval: {{$approval}}</h2> --}}
        <div class="searh-filter-container">
            <form action="{{route('admin.books')}}" method="get" style="display:flex;margin-bottom:1.25rem;flex-direction: column;">
                <div style="display: flex;">
                    <input type="text" name="search" class="dashboard-search-bar" placeholder="Search" value="{{$search}}">
                    <select class="form-control tags-filter" multiple="multiple" name="tags[]" >
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
                </div>
                
            </form>
            <div style="height: 1px;width: 100%;background-color: #e0e0e0;"></div>
            <div class="approval-tags-container">
                <div class="approval-tag"
                    @if($approval == 'all')
                        style="background-color: var(--color-secondary);color:white;"
                    @endif
                    onclick="location.href='{{route('admin.books', ['approval' => 'all'])}}'">
                    <p>All</p>
                </div>
                <div class="approval-tag"
                    @if($approval == 'approved')
                        style="background-color: var(--color-secondary);color:white;"
                    @endif
                    onclick="location.href='{{route('admin.books', ['approval' => 'approved'])}}'">
                    <p>Approved</p>
                </div>
                <div class="approval-tag"
                    @if($approval == 'pending')
                        style="background-color: var(--color-secondary);color:white;"
                    @endif
                    onclick="location.href='{{route('admin.books', ['approval' => 'pending'])}}'">
                    <p>Pending</p>
                </div>
                <div class="approval-tag"
                    @if($approval == 'rejected')
                        style="background-color: var(--color-secondary);color:white;"
                    @endif
                    onclick="location.href='{{route('admin.books', ['approval' => 'rejected'])}}'">
                    <p>Rejected</p>
                </div>
            </div>
        </div>
        
        <div class="posts-container">    
            @if($posts->count() > 0)
                @foreach ($posts as $post)
                    <div class="post">
                        <div class="post-data">
                            <div class="tag-holder">
                                <div class="tag approval" style="{{$post->approval == "APPROVED" ? 
                                    "background-color: #EAFFE8;" : ($post->approval == "PENDING" ? "background-color:#ffffd1;" : "background-color:#ffdfd2;")}}">
                                    <p style="{{$post->approval == "APPROVED" ? 
                                        "color: #57c84d;" : ($post->approval == "PENDING" ? "color:#b1b03a;" : "color:#cc5a30;")}}">{{ ucfirst(strtolower(trans($post->approval)))}}</p>
                                </div> 
                            </div>
                            <div class="post-title">
                                <p >{{$post->name}}</>
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
                            {{-- <a href="{{route('download', basename($post->path))}}" >Download</a> --}}
                            {{-- <a href="{{route('admin.approve', $post->id)}}" >Approve</a>
                            <a href="{{route('admin.delete', $post->id)}}" >Delete</a> --}}
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

    <script type="text/javascript">



        $(function () {
            $(document).ready(function () {

                $(".tags-filter").select2({
                    allowClear: true,
                    placeholder: "Filter by tags",
                    tags: true,
                    width: '30%',
                    display: "inline-block",
                    maximumSelectionLength: 4
                });
                $(".select2-search__field").css("fontSize", "1rem");
               
            });
        });


    </script>
@endsection