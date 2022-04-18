@extends('layouts.app')

@section('content')

    <div class="posts-body">
        <div class="posts">
            <div class="upload-file" >
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
                        <label for="tags">Add Tags:</label>
                        <select class="form-control tags" multiple="multiple" name="tags[]">
                            @foreach ($alltags as $tag)
                            <option>{{$tag->name}}</option>
                            @endforeach
                        </select>
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
                $(".select2-search__field").css("fontSize", "1rem");

                $('#fileUploadForm').ajaxForm({
                    beforeSend: function () {
                        var percentage = '0';
                        $('#progress-container').show();
                        console.log("beforeSend");
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        console.log("uploadProgress");
                        console.log(percentComplete);
                        var percentage = percentComplete;
                        $('#progress-bar').width(`${percentComplete}%`);
                        $('#percent').html(`${percentComplete}%`);
                    },
                    complete: function (xhr) {
                        console.log('File has uploaded');
                        $('#progress-bar').width(`0%`);
                        $('#percent').html(`0%`);
                        $('#progress-container').hide();
                        //get input values
                        //redirect to post page
                        window.location.href = "{{route('dashboard')}}";
                    }

                });
            });
        });
    </script>
@endsection