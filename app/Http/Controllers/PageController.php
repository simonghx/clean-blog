<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PageController extends Controller
{
    public function index() {
        $posts = Post::with('user')->get()->sortByDesc('created_at');
        return view('index', compact('posts'));
        
    }
}
