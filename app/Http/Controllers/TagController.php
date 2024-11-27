<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags=Tag::paginate();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $tag= $request->validate([
            'name' => 'required|string|min:3'
        ]);
        Tag::create($tag);
        return back()->with('success','tag added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag=Tag::findOrFail($id);
        Gate::authorize('view',$tag);
        return view('tags.edit',compact('tag'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        Gate::authorize('view',$tag);
        $request->validate(['name'=>'required|string|min:3']);
        $tag->update(['name'=>$request->name]);
        $tag->save();
        return redirect()->route('tags.index')->with('success','Tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
$tag=Tag::findOrFail($id);
$tag->delete();
return back()->with('success','tag deleted successfully');
    }
}
