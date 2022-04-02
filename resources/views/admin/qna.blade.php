@extends('admin.index')

@section('dashboard-content')
    <div class="admin-content">
        <div class="header-container">
            <h1>Question and Answers</h1>
            <div class="btn-container">
                <button class="btn" onclick="addQnAUsingFile()">Import</a>
                <button class="btn" onclick="addQnA()">Add</a>
            </div>
            
        </div>
        
        <table>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Action</th>
            </tr>
            @foreach ($qnas as $qna)
                <tr>
                    <td class="question">{{$qna->question}}</td>
                    <td class="answer" contenteditable="false">
                        {{$qna->answer}}
                    </td>
                    <td>
                        <button class="btn" onclick="editAns(this)">Edit</button>
                        <a class="btn" href="{{route('admin.qna.delete', $qna->id)}}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>

        <div id="single-qna-modal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" onclick="closeModal()" >&#10799;</span>
                    <h2>Add Question and Answer</h2>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.qna.add')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="modal-label" for="question">Question</label>
                            <br />
                            <input type="text" name="question" class="modal-input" required>
                        </div>
                        <div class="form-group">
                            <label class="modal-label" for="answer">Answer</label>
                            <br />
                            <textarea name="answer" class="modal-input" cols="30" rows="2" required></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="file-qna-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()" >&#10799;</span>
                <h2>Import using a csv file</h2>
                 <p>Make sure that the first column is for question and second for answer</p>   
            </div>
            <div class="modal-body">
                <form action="{{route('admin.qna.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="modal-label" for="file">File</label>
                        <br />
                        <input type="file" name="file" class="modal-input" required>
                    </div>
                    <div class="form-group">
                        <button class="btn" type="submit">Import</button>
                    </div>
                </form>
            </div>
        </div>


    </div>


    <script type="text/javascript">

        function editAns(e){
            var ans = e.parentNode.parentNode.querySelector('.answer');
            if(ans.getAttribute('contenteditable') == 'false'){
                ans.setAttribute('contenteditable', 'true');
                ans.focus();
                e.innerHTML = 'Save';
            }else{

                var question = e.parentNode.parentNode.querySelector('.question').innerHTML;
                var answer = ans.innerHTML;

                ans.setAttribute('contenteditable', 'false');
                ans.blur();
                e.innerHTML = 'Edit';

                (async () => {
                    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
                    const rawResponse = await fetch('{{route('admin.qna.update')}}', {
                        method: 'POST',
                        headers: {
                          'Accept': 'application/json',
                          'Content-Type': 'application/json',
                          "X-Requested-With": "XMLHttpRequest",
                          "X-CSRF-Token": csrfToken
                        },
                        credentials: "same-origin",
                        body: JSON.stringify({
                            question: question,
                            answer: answer
                        })
                    });
                    const content = await rawResponse.json();
              
                    console.log(content);
                })();

                
            }
            
        }

        function closeModal(){
            var modal = document.querySelector('.modal');
            modal.style.display = 'none';
        }

        function addQnA(){
            var modal = document.querySelector('#single-qna-modal');
            modal.style.display = 'block';
        }

        function addQnAUsingFile(){
            var modal = document.querySelector('#file-qna-modal');
            modal.style.display = 'block';
        }


    </script>
@endsection