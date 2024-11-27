<?php

namespace App\Http\Controllers;
use File;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(15);
        return view("posts.index", ['posts' => $posts]);
    }

    public function view()
    {
        Gate::authorize('create-post');
        $users = User::all();
        $tags = Tag::all();
        return view("posts.add", ['users' => $users, 'tags' => $tags]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $users = User::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();
        return view("posts.edit", ['post' => $post, 'users' => $users, 'tags' => $tags]);
    }

    public function store(Request $request)
    {
        Gate::authorize('create-post');

        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:50'],
            'description' => ['required', 'string', 'min:3', 'max:2000'],
            'user_id' => ['required', 'exists:users,id'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
            'tags' => ['array', 'exists:tags,id']  
        ]);

        $image = $request->file('image')->store('public');
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $post->image = $image;
        $post->save();

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return back()->with('success', 'Post created successfully');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return back()->with('deleted', "Post deleted successfully");
    }

    public function update($id, Request $request)
    {
        $post = Post::findOrFail($id);
        $old_image = $post->image;
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:50'],
            'description' => ['required', 'string', 'min:3', 'max:2000'],
            'user_id' => ['required', 'exists:users,id'],
            // You may include image validation if you are allowing image updates
        ]);
        
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;

        // If an image is provided, update it
        if ($request->hasFile('image')) {
            $new_image = $request->file('image')->store('public');
            File::delete($old_image);
            $post->image = $new_image;
        }

        $post->save();
        
        
        $post->tags()->detach();
        $post->tags()->sync($request->tags);
        return redirect('/posts')->with('success', 'Post updated successfully');
    }

    public function show()
    {
        $posts = Post::paginate(15);
        return view("home", ['posts' => $posts]);
    }

    public function more($id)
    {
        $post = Post::findOrFail($id);
        return view("posts.more", ['post' => $post]);
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $posts = Post::where('description', 'LIKE', '%' . $q . '%')->get();
        return view("posts.search", ['posts' => $posts]);
    }
}
