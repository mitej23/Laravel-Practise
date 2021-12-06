<?php

namespace App\Http\Controllers;
use App\Models\Post;

// use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $posts = Post::all();

        return view('dashboard',[
            'posts' => $posts
        ]);
    }
    public function download($name)
    {   
        return response()->download(storage_path('app/public/files/'.$name));
    }
}