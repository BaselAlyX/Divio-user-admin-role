<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::orderBy('id','DESC')->paginate();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=User::select('id','name')->get();
        return view('users.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>['required','string','min:3','max:50'],
            'email'=>['required','string','email','unique:users,email'],
            'password'=>['required','string','min:5','max:30'],
            'confirm_password'=>['required','string','same:password'],
            'type'=>['required','in:Admin,Writer']

        ]);
        User::create($data);
        return back()->with('success',"User created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function posts(string $id)
    {
        $user=User::findorfail($id);
        return view('users.posts',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {$user=User::findOrFail($id);
     return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {        $user=User::findOrFail($id);

        $data=$request->validate([
            'name'=>['required','string','min:3','max:50'],
            'email'=>['required','string','email',Rule::unique('users')->ignore($user->id)],
            'password'=>['nullable','string','min:5','max:30'],
            'confirm_password'=>['nullable','string','same:password'],
            'type'=>['required','in:Admin,Writer']

        ]);
        $data['password']=$request->has('password') ? bcrypt($request->password) : $user->password;
        unset($data['confirm_password']);
        User::where('id',$id)->update($data);
        return redirect()->route('users.index')->with('success',"Data Updated Successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return back()->with('success',"user deleted successfully");
    }
}
