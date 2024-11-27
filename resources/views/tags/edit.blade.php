@extends('layout.app')
@section('content')

  <body>
<div class="container">
<h1 class="my-3 text-center">Edit Tag</h1>
    <div class="row col-6 mx-auto">
        

<form action="{{route('tags.update',$tag->id)}}" class="form border p-3" method="post">
    @csrf
    @include('inc.message')
    @method('PUT')
<div class="mb-3">
    <label for="">Name</label>
    <input type="text" class="form-control" Name="name" value="{{$tag->name}}">
</div>


<div class="mb-3">
    <input type="submit" class="form-control bg-success text-white" value="Save">
</div>


</form>
</div>
 
 @endsection
  