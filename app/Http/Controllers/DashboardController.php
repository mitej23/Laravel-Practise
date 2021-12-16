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

        if($request->search || $request->tags) {

            //$posts = Post::where('approval', 'APPROVED')->where('name', 'like', '%'.$request->search.'%')->paginate(100);

            $posts = Post::withAllTags($request->tags)->where('approval', 'APPROVED')->where('name', 'like', '%'.$request->search.'%')->paginate(100);
            
        } else {
            $posts = Post::where('approval', 'APPROVED')->paginate(100);
        }

        
        $alltags = Post::existingTags();
        return view('dashboard',[
            'posts' => $posts,
            'alltags' => $alltags
        ]);
    }
    public function download($name)
    {   
        return response()->download(storage_path('app/public/files/'.$name));
    }
}
