<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Qna;
use App\Models\User;


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
        // get all users name and email and number of posts
        $users = User::all('name','email','type')->where('type', '!=', 'ADMIN');
        return view('admin.users',[
            'users' => $users
        ]);
    }

    public function qna()
    {   
        // get all qna
        $qnas = Qna::all();
        return view('admin.qna',[
            'qnas' => $qnas
        ]);
    }

    public function updateQuestion(Request $request)
    {
        // find the question and update the answer
        $qna = Qna::where('question', $request->question)->first();
        $qna->answer = $request->answer;
        $qna->save();

        return redirect('/admin/qna')->with('status', 'Question has been updated successfully');
    }

    public function deleteQuestion($id)
    {
        // get qna by id
        $qna = Qna::find($id);

        // delete qna
        $qna->delete();

        return redirect()->route('admin.qna');
    }

    public function addQuestion(Request $request)
    {
        // create new qna
        $qna = new Qna;
        $qna->question = $request->question;
        $qna->answer = $request->answer;
        $qna->save();

        return redirect()->route('admin.qna');
    }

    public function addQuestionUsingFile(Request $request)
    {
        $file = $request->file('file');
        if($file->getClientOriginalExtension() != 'csv'){
            return redirect()->route('admin.qna')->with('status', 'Please upload a csv file');
        }

        // read the file 
        $file = fopen($file, 'r');
        $i = 0;
        while(($line = fgetcsv($file)) !== false){
            if($i == 0){
                $i++;
                continue;
            }
            $qna = new Qna;
            $qna->question = $line[0];
            $qna->answer = $line[1];
            $qna->save();
        }

        return redirect()->route('admin.qna')->with('status', 'Questions have been added successfully');
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
