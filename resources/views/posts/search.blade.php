@extends('layout.app')
@section('content')
<body>
<div class="container">
    <div class="row col-12 my-3">
    <h1 class="p-3 border text-center my-3">All posts</h1>
    @foreach ($posts as $post) 

<div class="card my-3" >
<div class="card-header">
{{$post->user->name}} - {{$post->created_at->format('Y-m-d')}}
</div>
<div class="card-body">
  <div class="card-image">
    <img src="{{$post->image()}}" alt="" width="100%" height="350">
</div>
<h5 class="card-title">{{$post->title}}</h5>
<p class="card-text">{{\Str::limit($post->description,200)}}</p>
<a href="{{url('/more/'.$post->id)}}" class="btn btn-primary">View More</a>
</div>
</div>
@endforeach

</div>
@endsection

