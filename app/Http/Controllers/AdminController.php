<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Qna;


class AdminController extends Controller
{   
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function chatbox(Request $request){
        
    
        $answers = Qna::where('question', 'like', '%'.$request->data.'%')->paginate(1);

        // if answer is empty
        if(count($answers) == 0){
            return response()->json([
                'status' => 'success',
                'answer' => "Sorry, I don't know what you mean."
            ]);  
        }

        return response()->json([
            'status' => 'success',
            'answer' => $answers[0]->answer
        ]);
    }

    public function index()
    {
        return view('admin.index');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function chat()
    {
        return view('admin.chat');
    }
    
    public function approvals()
    {
        $posts = Post::where('approval', 'PENDING')->get();

        return view('admin.approvals',[
            'posts' => $posts
        ]);
    }

    public function approve($id)
    {
        $post = Post::find($id);
        $post->approval = 'APPROVED';
        $post->save();

        $posts = Post::where('approval', 'PENDING')->get();

        return view('admin.approvals',[
            'posts' => $posts
        ]);
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();

        $posts = Post::where('approval', 'PENDING')->get();

        return view('admin.approvals',[
            'posts' => $posts
        ]);
        
    }
}
