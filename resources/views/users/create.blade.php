@extends('layout.app')
@section('content')

  <body>
<div class="container">
<h1 class="my-3 text-center">Create New User</h1>
    <div class="row col-6 mx-auto">
        

<form action="{{route('users.store')}}" class="form border p-3" method="post">
    @csrf
    @include('inc.message')
<div class="mb-3">
    <label for="">Name</label>
    <input type="text" class="form-control" Name="name">
</div>
<div class="mb-3">
    <label for="">Email</label>
    <input type="email" class="form-control" Name="email">
</div>
<div class="mb-3">
    <label for="">password</label>
    <input type="password" class="form-control" Name="password">
</div>
<div class="mb-3">
    <label for=""> confirm password</label>
    <input type="password" class="form-control" Name="confirm_password">
</div>
<div class="mb-3">
    <label for=""> type</label>
    <select name="type" class="form-control"><option value="Admin">Admin</option>
    <option value="Writer">Writer</option>
</select>
</div>
<div class="mb-3">
    <input type="submit" class="form-control bg-success text-white" value="Save">
</div>


</form>
</div>
 
 @endsection
  