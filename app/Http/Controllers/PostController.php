<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {  
        $posts = Post::all();

        return view('posts.index',[
            'posts' => $posts
        ]);
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf,word|max:2048',
        ]);
    
        $name = $request->name;

        $path = $request->file('file')->store('public/files');


        $request->user()->posts()->create([
            'name' => $name,
            'path' => $path,
        ]);

        return redirect('posts')->with('status', 'File Has been uploaded successfully in laravel 8');
    
    }

    public function download($name)
    {   
        return response()->download(storage_path('app/public/files/'.$name));
    }
    
}
   