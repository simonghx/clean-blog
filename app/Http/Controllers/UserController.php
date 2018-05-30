<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $posts = Post::all()->sortByDesc('created_at');
        return view('admin/users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $request->validated();
        $user = new User;
        $user->name=$request->name;
        $user->email= $request->email;
        $user->password = bcrypt('secret');
        $user->role_id = $request->role_id;
        if($user->save()) {
            return redirect()->route('users.index')->with(["status"=>"success", "message" => trans('validation.post-create')]);
        } else {
            return redirect()->route('users.index')->with(["status"=>"danger", "message" => trans('validation.post-error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Post $posts)
    {
        return view('admin/users/show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin/users/edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email, '. $user->id .',id',
            'password' => 'confirmed',
            'password_confirmation' => 'required_with:password',
        ]);

        $user->name=$request->name;
        $user->email= $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        if($user->save()) {
            return redirect()->route('users.index')->with(["status"=>"success", "message" => "Votre utilisateur a bien été modifié"]);
        } else {
            return redirect()->route('users.index')->with(["status"=>"danger", "message" => "Erreur dans la création de votre utilisateur."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
        if($user->delete()) {
            return redirect()->route('users.index')->with(["status"=>"success", "message" => "Votre utilisateur a bien été supprimé"]);
        } else {
            return redirect()->route('users.index')->with(["status"=>"danger", "message" => "Erreur dans la suppression de votre utilisateur."]);
        }
    }
}
