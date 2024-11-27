@extends('layout.app')
@section('content')
    <div class="container" style="margin-top:20px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Edit Post</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{url('posts/'.$post->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if(session('success'))
                            <div class="alert alert-success">Post updated successfully</div>
                            @endif
                            @if($errors->any)
                            @foreach ($errors->all as $error )
                            <div class="alert alert-danger">{{$error}}</div>
                            @endforeach
                            @endif
                            <div class="mb-3">
                                <label for="postTitle" class="form-label">Post Title</label>
                                <input type="text" name="title" class="form-control" value="{{$post->title}}" id="title" placeholder="Enter post title">
                            </div>
                            <div class="mb-3">
                                <label for="postDescription" class="form-label">Post Description</label>
                                <textarea class="form-control" name="description" id="description"rows="4" placeholder="Enter post description"> {{$post->description}} </textarea>
                            </div>
                           
                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <select class="form-control" name="tags[]" multiple id="tags">
                                    @foreach ($tags as $tag)
                                        <option @if ($post->tags->contains($tag)) selected @endif value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">User</label>
                                <select name="user_id" class="form-control">
                                    @foreach ($users as $user)
                                        <option @selected($user->id==$post->user_id) value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success w-100">ADD</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection