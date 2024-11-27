@extends('layout.app')
@section('content')

  <body>
<div class="container">
@can('create',\App\Models\Tag::class)

<a href="{{route('tags.create')}}" class="btn btn-primary my-3">Add new Tag</a>
@endcan
    <div class="row col-12">
    <h1 class="p-3 border text-center my-3">All tags</h1>

 <table class="table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>name</th>
            <th>Posts</th>
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
        @foreach ($tags as $tag)
        
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$tag->name}}</td>
            <td>
                @foreach ($tag->posts as $post )
                <span class="badge bg-success">{{$post->title}}</span>
                @endforeach
            </td>
            <td>
                @can('view',$tag)
                <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-info">Edit</a>
            @endcan
            </td>
          
            <td>
            <form action="{{route('tags.destroy',$tag->id)}}" method="POST">
                @method('DELETE')
                @csrf
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
            </td>

        </tr>
        @endforeach

    </tbody>
 </table>
<div>{{$tags->links()}}</div>
    </div>
</div>
 @endsection
  