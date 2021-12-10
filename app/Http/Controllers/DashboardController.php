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

        if($request->search) {

            if($request->search == '') {
                $posts = Post::paginate(10);
            } 

            $posts = Post::where('name', 'like', '%'.$request->search.'%')->paginate(10);
        } else {
            $posts = Post::paginate(10);
        }

        return view('dashboard',[
            'posts' => $posts
        ]);
    }
    public function download($name)
    {   
        return response()->download(storage_path('app/public/files/'.$name));
    }
}
