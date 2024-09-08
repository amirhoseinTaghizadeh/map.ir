<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::search($request->input("search"))->simplePaginate(15);
        return response()->json($posts);
    }
}
