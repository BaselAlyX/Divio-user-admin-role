@extends('layout.app')
@section('content')

  <body>
<div class="container">

<a href="{{route('ajax-tags.create')}}" class="btn btn-primary my-3">Add new Tag</a>
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
    <div class="alert alert-danger d-none" id="show-message"></div>
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
                <a href="{{route('ajax-tags.edit',$tag->id)}}" class="btn btn-info">Edit</a>
            </td>
          
            <td>
            <form action="{{route('ajax-tags.destroy',$tag->id)}}"class="delete-items" method="POST">
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
 @section('script')
<script>
    let messageElement = document.getElementById("show-message");

    let $items = document.querySelectorAll('.delete-items');

    $items.forEach(element => {
        element.addEventListener("submit", function (e) {
            e.preventDefault();
            let token = element.querySelector("input[name='_token']");

            fetch(element.action, {
                method: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': token.value,
                    'Accept': "application/json",
                    'Content-Type': "application/json"
                }
            })
            .then(response => response.json()) // Ensure JSON response
            .then(data => {
                messageElement.classList.remove('d-none');

                if (data.status === 'success') {
                    messageElement.classList.remove('alert-danger');
                    messageElement.classList.add('alert-success');
                    messageElement.textContent = data.message;
                    element.closest("tr").remove(); // Remove the row
                } else {
                    messageElement.classList.remove('alert-success');
                    messageElement.classList.add('alert-danger');
                    messageElement.textContent = data.message || "An error occurred.";
                }

               
            })
            
            });
        });
</script>
@endsection
