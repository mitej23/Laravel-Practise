@extends('admin.index')

@section('dashboard-content')
    <div class="admin-content">
        <div class="header-container">
            <h2>Users List</h2>
            <div class="btn-container" style="display: flex">
                <button class="btn" onclick="addUsersUsingFile()">Import</a>
                <button class="btn" onclick="addUser()">Add</a>
            </div>
            
        </div>
       
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
            @foreach ($users as $user)
                <tr class="user">
                    <td class="editable name" contenteditable="false">{{$user->name}}</td>
                    <td class="editable email" contenteditable="false">{{$user->email}}</td>
                    <td class="editable password" contenteditable="false">{{$user->password}}</td>
                    <td class="editable type" contenteditable="false">{{$user->type}}</td>
                    <td style="display: flex">
                        <div class="btn" onclick="editUser(this,{{$user->id}})">Edit</div>
                        <a class="btn" href="{{route('admin.users.delete', $user->id)}}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>

        <div id="file-users-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()" >&#10799;</span>
                <h2 style="margin:1rem 0px;">Import using a csv file</h2>
                 
            </div>
            <div class="modal-body">
                <form action="{{route('admin.users.importUsingFile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="modal-label" for="file">File</label>
                        <input type="file" name="file" class="modal-input" required style="margin-bottom:0.5rem">
                        <p style="font-size:0.9rem;">Note: Format: Name, email-id, password</p> 
                        <br />
                    </div>
                    <div class="form-group">
                        <button class="btn" type="submit" style="margin:0;">Import</button>
                    </div>
                </form>
            </div>
        </div>


        <div id="single-user-modal" class="modal" style="width: 23em">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" onclick="closeModal()" >&#10799;</span>
                    <h2>Add User</h2>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.users.add')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="modal-label" for="name">Name</label>
                            <br />
                            <input type="text" name="name" class="modal-input" required />
                        </div>
                        <div class="form-group">
                            <label class="modal-label" for="email">Email</label>
                            <br />
                            <input type="email" name="email" class="modal-input" required />
                        </div>
                        <div class="form-group">
                            <label class="modal-label" for="password">Password</label>
                            <br />
                            <input type="password" name="password" class="modal-input" required />
                        </div>
                        <div class="form-group">
                            <label class="modal-label" for="type">Type</label>
                            <br />
                            <select name="type" class="modal-input" required>
                                <option value="STAFF">STAFF</option>
                                <option value="STUDENT">STUDENT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function addUsersUsingFile(){
                document.getElementById("file-users-modal").style.display = "block";
            }

            function addUser(){
                document.getElementById("single-user-modal").style.display = "block";
            }

            function closeModal(){
                var modal = document.getElementsByClassName("modal");
                modal[0].style.display = "none";
                modal[1].style.display = "none";
            }

            function editUser(e,id){
                let nameTag = e.parentNode.parentNode.querySelector(".name");
                let emailTag = e.parentNode.parentNode.querySelector(".email");
                let typeTag = e.parentNode.parentNode.querySelector(".type");
                let passwordTag = e.parentNode.parentNode.querySelector(".password");

                console.log(nameTag, emailTag, typeTag, passwordTag);

                console.log(nameTag.getAttribute('contenteditable'))

                if(nameTag.getAttribute('contenteditable') == 'false'){
                    nameTag.setAttribute('contenteditable', 'true');
                    emailTag.setAttribute('contenteditable', 'true');
                    typeTag.setAttribute('contenteditable', 'true');
                    passwordTag.setAttribute('contenteditable', 'true');

                    nameTag.focus();

                    e.innerHTML = "Save";
                }else{
                    let name = nameTag.innerHTML;
                    let email = emailTag.innerHTML;
                    let type = typeTag.innerHTML;
                    let password = passwordTag.innerHTML;


                    console.log(name, email, type, password);

                    nameTag.setAttribute('contenteditable', 'false');
                    emailTag.setAttribute('contenteditable', 'false');
                    typeTag.setAttribute('contenteditable', 'false');
                    passwordTag.setAttribute('contenteditable', 'false');

                    e.innerHTML = "Edit";

                    let url = "{{route('admin.users.update', ':id')}}";
                    url = url.replace(':id', id);

                    let data = {
                        id: id,
                        name: name,
                        email: email,
                        type: type,
                        password: password
                    }

                    if(id === null || id === undefined){
                        return;
                    }

                    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
                    fetch(url, {
                        method: 'PUT',
                        headers: {
                          'Accept': 'application/json',
                          'Content-Type': 'application/json',
                          "X-Requested-With": "XMLHttpRequest",
                          "X-CSRF-Token": csrfToken
                        },
                        credentials: "same-origin",
                        body: JSON.stringify(data)
                    })
                    .then(res => res.json())
                    .then(data => {
                        passwordTag.innerHTML = data.hashedPassword;
                        nameTag.innerHTML = data.name;
                        emailTag.innerHTML = data.email;
                        typeTag.innerHTML = data.type;
                        console.log(data);
                    })
                    .catch(err => console.log(err));
                }

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