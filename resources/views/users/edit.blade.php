@extends('layout.app')
@section('content')

  <body>
<div class="container">
<h1 class="my-3 text-center">Update User Data</h1>
    <div class="row col-6 mx-auto">
        

<form action="{{route('users.update',$user->id)}}" class="form border p-3" method="post">
    @csrf
    @method('PUT')
    @include('inc.message')
<div class="mb-3">
    <label for="">Name</label>
    <input type="text" class="form-control" Name="name" value="{{$user->name}}" >
</div>
<div class="mb-3">
    <label for="">Email</label>
    <input type="email" class="form-control" Name="email"  value="{{$user->email}}">
</div>
<div class="mb-3">
    <label for="">password</label>
    <input type="password" class="form-control" Name="password" >
</div>
<div class="mb-3">
    <label for=""> confirm password</label>
    <input type="password" class="form-control" Name="confirm_password" >
</div>
<div class="mb-3">
    <label for=""> type</label>
    <select name="type" class="form-control"><option @selected($user->type=='Admin') value="Admin">Admin</option>
    <option @selected($user->type=='Writer') value="Writer">Writer</option>
</select>
</div>
<div class="mb-3">
    <input type="submit" class="form-control bg-success text-white" value="Update">
</div>


</form>
</div>
 
 @endsection
  