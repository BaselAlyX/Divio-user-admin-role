@extends('layout.app')
@section('content')

  <body>
<div class="container">
<a href="{{route('users.create')}}" class="btn btn-primary my-3">Add new User</a>

    <div class="row col-12">
    <h1 class="p-3 border text-center my-3">All Users</h1>

 <table class="table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>name</th>
            <th>email</th>
            <th>type</th>
            <th>posts</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
    </thead>
    <!-- @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if(session('deleted'))
    <div class="alert alert-info">{{session('deleted')}}</div>
    @endif
    <tbody> -->
        @include('inc.message')
        @foreach ($users as $user)
        
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}} </td>
            <td>{!!$user->type()!!}</td>
            <td>
                <a href="{{route('users.edit',$user->id)}}" class="btn btn-info">Edit</a>
            </td>
            <td>
                <a href="{{route('user.posts',$user->id)}}" class="btn btn-primary">Show</a>
            </td>
            <td>
            <form action="{{route('users.destroy',$user->id)}}" method="POST">
                @method('DELETE')
                @csrf
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
            </td>

        </tr>
        @endforeach

    </tbody>
 </table>
<div>{{$users->links()}}</div>
    </div>
</div>
 @endsection
  