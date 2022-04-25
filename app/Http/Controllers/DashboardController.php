<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

// use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index(Request $request)
    {   

        if($request->search && $request->tags) {
            
            $posts = Post::withAllTags($request->tags)->where('name', 'like', '%'.$request->search.'%')->paginate(100);
        
        } else if($request->search) {
            
            $posts = Post::where('name', 'like', '%'.$request->search.'%')->paginate(100);
        
        } else if($request->tags) {
            
            $posts = Post::withAllTags($request->tags)->paginate(100);
        
        } else {
            
            $posts = Post::paginate(100);
        
        }

        
        $alltags = Post::existingTags();
        return view('dashboard',[
            'posts' => $posts,
            'alltags' => $alltags,
            'search' => $request->search,
            'tags' => $request->tags
        ]);
    }

    public function download($name)
    {   
        return response()->download(storage_path('app/public/files/'.$name));
    }

    public function pdf($name){
        // return pdf to the view

        $path = storage_path('app/public/files/'.$name);

        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $name . '"'
        ];
         
        return response()->file($path, $header);
    }
}
