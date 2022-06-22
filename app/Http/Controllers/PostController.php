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

        $alltags = Post::existingTags();
        return view('posts.index', compact('alltags'));
    }

    public function store(Request $request)
    {
        // link_to_paper
        $this->validate($request, [
            'name' => 'required|max:255',
            'file' => 'nullable|file|mimes:pdf,word',
            'tags' => 'required|array',
            'file_type' => 'required|max:255',
            'publications' => 'required|array',
            'publication_date' => 'required|date',
            'link_to_paper' => 'nullable|max:255'
        ]);

        //dd(request()->all());

        $name = time().'.'.request()->file->getClientOriginalExtension();
        $path = request()->file->storeAs('public/files', $name);
        $name = $request->name;

        $post = new Post;
        $post->name = $name;
        $post->path = $path;
        $post->user_id = Auth::user()->id;
        $post->file_type = request()->file_type;
        $post->publications = request()->publications;
        $post->publication_date = request()->publication_date;
        $post->link_to_paper = request()->link_to_paper; 

        
        if(Auth::user()->type == 'STUDENT'){
            $post->approval = 'PENDING'; 
        }else{
            $post->approval = 'APPROVED';
        }
        $post->save();
        
        $post->retag($request->tags);

        $post->save();

        return redirect('library')->with('status', 'File Has been uploaded successfully in laravel 8');
    
    }
    
}
   