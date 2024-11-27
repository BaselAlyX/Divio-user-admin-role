@extends('layout.app')
@section('content')

  <body>
<div class="container">
    @can('create-post')
<a href="{{url('posts/add')}}" class="btn btn-primary my-3">Add new Post</a>
@endcan

    <div class="row col-12">
    <h1 class="p-3 border text-center my-3">All posts</h1>

 <table class="table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Writer</th>
            <th>Tags</th>
            <th>Image</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
    </thead>
    @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if(session('deleted'))
    <div class="alert alert-info">{{session('deleted')}}</div>
    @endif
    <tbody>
        @foreach ($posts as $post)
        
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$post->title}}</td>
            <td>{{\Str::limit($post->description,50)}} </td>
            <td>{{$post->user->name}}</td>
            <td>
                @foreach ($post->tags as $tag )
                <span class="badge bg-warning my-1">{{$tag->name}}<br></span>
                @endforeach
            </td>
            <td>
                <img src="{{$post->image()}}" width="100" height="100" alt="">
            </td>
            <td>
            @can('update-post',$post)

                <a href="{{url('posts/'.$post->id.'/edit')}}" class="btn btn-info">Edit</a>
                @endcan
                
            </td>
            <td>
            <form action="{{url('posts/' . $post->id)}}" method="POST">
                @method('DELETE')
                @csrf
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
            </td>

        </tr>
        @endforeach

    </tbody>
 </table>
<div>{{$posts->links()}}</div>
    </div>
</div>
 @endsection
  