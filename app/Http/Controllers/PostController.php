<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
        if(Auth::user()->type == 'STUDENT'){
            return redirect('library');
        }

        return view('posts.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'file' => 'required|file|mimes:pdf,word',
        ]);


        $name = time().'.'.request()->file->getClientOriginalExtension();
        $path = request()->file->storeAs('public/files', $name);
        $name = $request->name;
        
        // $path = $request->file('file')->store('public/files');

        $request->user()->posts()->create([
            'name' => $name,
            'path' => $path,
        ]);

        return redirect('library')->with('status', 'File Has been uploaded successfully in laravel 8');
    
    }
    
}
   