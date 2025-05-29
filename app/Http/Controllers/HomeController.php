<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->paginate(5);


        return view('home', compact('posts'));
    }
}
