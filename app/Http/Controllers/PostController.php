<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use Auth;
use App;
use App\Services\ImageResizing;
use Mail;
use App\Mail\PostUpdateMail; 

class PostController extends Controller
{

    public function __construct(ImageResizing  $imageResizing){
        $this->imageResizing = $imageResizing;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->get()->sortByDesc('created_at');
        // $posts = Post::paginate(5);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $request->validated();
        $post = new Post;
        $post->titre=$request->titre;
        $post->contenu= $request->contenu;
        if ($request->image != null) {    
            
            $post->image = $this->imageResizing->imageStore($request->image);


            
        }

        $post->user_id = Auth::user()->id;
        if($post->save()) {
            return redirect()->route('posts.index')->with(["status"=>"success", "message" => trans('validation.post-create')]);
        } else {
            return redirect()->route('posts.index')->with(["status"=>"danger", "message" => trans('validation.post-error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, Post $post)
    {
        $this->authorize('update', $post);
        $request->validated();
        $post->titre = $request->titre;
        $post->contenu = $request->contenu;
         if ($request->image != null) {   

            $this->imageResizing->imageDelete($post->image);
            $post->image = $this->imageResizing->imageStore($request->image);

        }
        if($post->save()) {
            Mail::to($post->user)->send(new PostUpdateMail($post));
            return redirect()->route('posts.show', ['post'=>$post->id])->with(["status"=>"success", "message" => trans('validation.post-edit')]);
        } else {
            return redirect()->route('posts.show', ['post'=>$post->id])->with(["status"=>"danger", "message" => trans('validation.post-error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        
        if($post->delete()) {
            if($post->image != null) {
                $this->imageResizing->imageDelete($post->image);
            }
            return redirect()->route('posts.index', ['post'=>$post->id])->with(["status"=>"success", "message" => trans('validation.post-delete')]);
        } else {
            return redirect()->route('posts.index', ['post'=>$post->id])->with(["status"=>"danger", "message" => trans('validation.post-error')]);
        }
    }
}
