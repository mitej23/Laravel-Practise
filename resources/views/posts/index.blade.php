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
            
                        <div class="form-group">
                            <div class="progress" style=" position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px;">
                                <div class="bar" style="background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px;"></div >
                                <div class="percent" style=" position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;">0%</div >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>

    <script type="text/javascript">
 
        function validate(formData, jqForm, options) {
            var form = jqForm[0];
            if (!form.file.value) {
                alert('File not found');
                return false;
            }
        }
     
        (function() {
     
        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');
     
        $('form').ajaxForm({
            beforeSubmit: validate,
            beforeSend: function() {
                status.empty();
                var percentVal = '0%';
                var posterValue = $('input[name=file]').fieldValue();
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            success: function() {
                var percentVal = 'Wait, Saving';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            complete: function(xhr) {
                status.html(xhr.responseText);
                alert('Uploaded Successfully');
                window.location.href = "/file-upload";
            }
        });
         
        })();
    </script>
@endsection