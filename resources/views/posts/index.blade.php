@extends('layouts.app')

@section('content')

    <div class="posts-body">
        <div class="posts">
            <div class="upload-file" >
                <div class="back-btn-post" onclick="javascript:history.back()" style="display: flex;margin-right: 5px;margin-bottom:1rem;align-items: flex-end;" hover="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <polyline points="15 6 9 12 15 18" />
                    </svg>
                    <p>Back</p>
                </div>

                <h2>Add File</h2>
                @error('file')
                    <div class="error-text">{{ $message }}</div>
                @enderror
                <form id="fileUploadForm" method="POST" action="{{route('posts')}}" enctype="multipart/form-data">
                    @csrf
                        <label for="name">File Name:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        <label for="file">File</label>
                        <br />
                        <input name="file" type="file" class="custom-file-input" size="60">
                        <label for="file_type">File Type</label><br />
                        <select name="file_type" class="form-control file-type">
                            <option value="Journal Paper">Journal Paper</option>
                            <option value="Conference Paper">Conference Paper</option>
                            <option value="Book Report">Book Report</option>
                            <option value="Book Chapter">Book Chapter</option>
                        </select>
                        <br />
                        <label for="linkpaper">Link to Paper</label><br />
                        <input type="text" class="form-control" name="link_to_paper" placeholder="Enter Link" /><br />
                        <label for="tags">Add Tags:</label>
                        <br />
                        <select class="form-control tags" multiple="multiple" name="tags[]">
                            @foreach ($alltags as $tag)
                            <option>{{$tag->name}}</option>
                            @endforeach
                        </select>
                        <br />
                        <label for="publication">Type of Publication</label>
                        <br />
                        <select class="form-control publications" multiple="multiple" name="publications[]">
                            <option value="Scopus">Scopus</option>
                            <option value="National">National</option>
                            <option value="International">International</option>
                            <option value="Web of Science">Web of Science</option>
                            <option value="Conference Proceedings">Conference Proceedings</option>
                            <option value="Other">Other</option>
                        </select>
                        <br />
                        <label for="date">Date of Publication</label>
                        <input type="date" class="form-control" name="publication_date" id="date" min="1950-01-01" max="2030-12-31" placeholder="dd-mm-yyyy">
                        <input id="post-btn" type="submit" value="Submit" class="btn btn-primary" style="margin-top:30px;margin-bottom:15px;font-size:1.125rem;">
                        <div id="progress-container" style="margin-top:20px;height: 25px;display:none;">
                        <div class="progress" style=" position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px;height:16px;">
                            <div id="progress-bar" style="background-color: #3fcb3f!important;" role="progressbar" style="height:100%;"></div> 
                            <div id="percent" style=" position:absolute; display:inline-block;left:48%; color: #ffffff;font-size:small;">0%</div >
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>


    <script type="text/javascript">
        $(function () {
            $(document).ready(function () {

                $(".tags").select2({
                    allowClear: true,
                    placeholder: "Select a tag",
                    tags: true,
                    width: '100%',
                    display: "inline-block",
                    maximumSelectionLength: 4
                });

                $(".publications").select2({
                    allowClear: true,
                    placeholder: "Select a publication",
                    width: '100%',
                    display: "inline-block",
                    maximumSelectionLength: 4
                });

                $(".file-type").select2({
                    placeholder: "Select a file type",
                    width: '100%',
                    display: "inline-block",
                    minimumResultsForSearch: Infinity
                });

                $(".select2-search__field").css("fontSize", "1rem");

                $('#fileUploadForm').ajaxForm({
                    beforeSend: function () {
                        var percentage = '0';
                        $('#progress-container').show();
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('#progress-bar').width(`${percentComplete}%`);
                        $('#percent').html(`${percentComplete}%`);
                    },
                    complete: function (xhr) {
                        console.log('File has uploaded');
                        $('#progress-bar').width(`0%`);
                        $('#percent').html(`0%`);
                        $('#progress-container').hide();
                        console.log(xhr.responseText);
                        //get input values
                        //redirect to post page
                    //    window.location.href = "{{route('dashboard')}}";
                    }
                });
            });
        });
    </script>
@endsection