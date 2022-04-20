@extends('admin.index')

@section('dashboard-content')
    <div class="admin-content">
        <div class="header-container">
            <h2>Question and Answers</h2>
            <div class="btn-container" style="display: flex">
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
                    <td class="question" contenteditable="false">{{$qna->question}}</td>
                    <td class="answer" contenteditable="false">
                        {{$qna->answer}}
                    </td>
                    <td style="display: flex">
                        <div class="btn" onclick="editAns(this,{{$qna->id}})">Edit</div>
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
                            <input type="text" name="question" class="modal-input" required />
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
                <h2 style="margin:1rem 0px;">Import using a csv file</h2>
                  
            </div>
            <div class="modal-body">
                <form action="{{route('admin.qna.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="modal-label" for="file">File</label>
                        <input type="file" name="file" class="modal-input" required style="margin-bottom:0.5rem">
                        <p style="font-size:0.9rem;">Note: Format question, answer</p> 
                        <br />
                    </div>
                    <div class="form-group">
                        <button class="btn" type="submit" style="margin: 0px;">Import</button>
                    </div>
                </form>
            </div>
        </div>


    </div>


    <script type="text/javascript">

        function editAns(e,id){
            let ques = e.parentNode.parentNode.querySelector('.question');
            let ans = e.parentNode.parentNode.querySelector('.answer');
            if(ans.getAttribute('contenteditable') == 'false'){
                ques.setAttribute('contenteditable', 'true');
                ans.setAttribute('contenteditable', 'true');
                ques.focus();
                ans.focus();
                e.innerHTML = 'Save';

            }else{

                var question = ques.innerHTML;
                var answer = ans.innerHTML;

                ques.setAttribute('contenteditable', 'false');
                ans.setAttribute('contenteditable', 'false');
                ques.blur();
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
                            id: id,
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
            console.log("close modal")
            var modal = document.getElementsByClassName("modal");
            modal[0].style.display = "none";
            modal[1].style.display = "none";
        }

        function addQnA(){
            var modal = document.querySelector('#single-qna-modal');
            modal.style.display = 'block';
        }

        function addQnAUsingFile(){
            var modal = document.querySelector('#file-qna-modal');
            modal.style.display = 'block';
        }

        //add event listner to content editable tags
        document.querySelectorAll(".editable").forEach(e => {
            e.addEventListener('keydown', function(e){
                if(e.keyCode === 13 || e.keyCode === 27){
                    e.preventDefault();
                    e.target.blur();
                }
                if(e.keyCode === 32){
                    e.preventDefault();
                    e.stopPropagation();
                    document.execCommand("insertText", false, ' ');
                } 
            });
        });


    </script>
@endsection