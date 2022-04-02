@extends('admin.index')

@section('dashboard-content')
    <div class="admin-content">
        <h1>Users List</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->type}}</td>
                </tr>
            @endforeach
        </table>
@endsection