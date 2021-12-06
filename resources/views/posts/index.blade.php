@extends('layouts.app')

@section('content')

    <div class="posts-body">
        <div class="posts">
            {{-- upload a file --}}
            {{-- <div class="upload-file">
                @error('file')
                    <div class="error-text">{{ $message }}</div>
                @enderror
                <form id="fileUploadForm" action="{{route('posts')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Title</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="name">
                    <label for="file">File</label>
                    <input type="file" class="form-control-file" name="file" id="file">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <div class="progress" style="height: 30px;widht: 400px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="10" aria-valuemax="100" style="width: 400px;height:30px;"></div>
                    </div>
                </form>
            </div>     --}}
            <div class="upload-file">
                <div class="container mt-5" style="max-width: 500px">
                    <h2>Add File</h2>
                    @error('file')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                    <form id="fileUploadForm" method="POST" action="{{route('posts')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">File Name:</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="file">File</label>
                            <input name="file" type="file" class="form-control"  id="file">
                        </div>
            
                        <div class="d-grid mb-3">
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                        
                        <div class="form-group" style="display: none;">
                            <div class="progress" style=" position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="background-color: #3fcb3f!important;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div> 
                                <div class="percent" style=" position:absolute; display:inline-block; top:-1px; left:48%; color: #ffffff;">0%</div >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $(document).ready(function () {
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function () {
                        var percentage = '0';
                        console.log("beforeSend");
                        $('#fileUploadForm > div:nth-child(5)').show();
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        console.log("uploadProgress");
                        console.log(percentComplete);
                        var percentage = percentComplete;
                        $('#fileUploadForm > div:nth-child(5) > div > div.progress-bar.progress-bar-striped.progress-bar-animated.bg-danger').width(`${percentComplete}%`);
                        $('#fileUploadForm > div:nth-child(5) > div > div.percent').html(`${percentComplete}%`);
                    },
                    complete: function (xhr) {
                        console.log('File has uploaded');
                        $('#fileUploadForm > div:nth-child(5) > div > div.progress-bar.progress-bar-striped.progress-bar-animated.bg-danger').width(`0%`);
                        $('#fileUploadForm > div:nth-child(5) > div > div.percent').html(`0%`);
                        $('#fileUploadForm > div:nth-child(5)').hide();
                        //redirect to post page
                        window.location.href = "{{route('dashboard')}}";
                    }
                });
            });
        });
    </script>
@endsection