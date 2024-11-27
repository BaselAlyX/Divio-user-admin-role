@extends('layout.app')
@section('content')

  <body>
<div class="container">
<h1 class="my-3 text-center">Edit Tag</h1>
    <div class="row col-6 mx-auto">
        

<form action="{{route('ajax-tags.update',$tag->id)}} "  id="send-data" class="form border p-3" method="post">
    @csrf
    <alert class="alert-danger d-none" id="show-message"></alert>

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
 @section('script')
<script>
  let formElement = document.getElementById("send-data");
let messageElement = document.getElementById("show-message");

formElement.addEventListener("submit", function (e) {
    e.preventDefault();
    let input = document.querySelector("input[name='name']");
    let token = document.querySelector("input[name='_token']");

    fetch(formElement.action, {
        method: "PUT",
        headers: {
            'X-CSRF-TOKEN': token.value,
            'Accept': "application/json",
            'Content-Type': "application/json"
        },
        body: JSON.stringify({ name: input.value })
    })
    .then(response => response.json()) // Parse the response as JSON
    .then(data => {
        messageElement.classList.remove('d-none');

        if (data.status === 'success') { // Ensure the correct condition
            messageElement.classList.remove('alert-danger');
            messageElement.classList.add('alert-success');
            // input.value = "";
        } else {
            messageElement.classList.remove('alert-success');
            messageElement.classList.add('alert-danger');
        }
        messageElement.textContent = data.message; // Display the message
    })
    .catch(error => {
        messageElement.classList.remove('alert-success');
        messageElement.classList.add('alert-danger');
        messageElement.classList.remove('d-none');
        messageElement.textContent = "An error occurred. Please try again.";
        console.error("Error:", error); // Log error for debugging
    });
});

</script>
 @endsection