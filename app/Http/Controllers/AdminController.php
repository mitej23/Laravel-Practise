<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Qna;
use App\Models\User;
use Clockwork\Storage\Search;
use Illuminate\Support\Facades\Hash;


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
                'answer' => "Sorry, I don't know what you are trying to ask"
            ]);  
        }

        //dd($answers[0]->answer);

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
        $users = User::all('id','name','email','password','type')->where('type', '!=', 'ADMIN');
        return view('admin.users',[
            'users' => $users
        ]);
    }

    public function addUser(Request $request)
    {
        // create new user
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = $request->type;
        $user->save();

        return view('admin.users',[
            'users' => User::all('id','name','email','type')->where('type', '!=', 'ADMIN')
        ]);
    }

    public function addUsersUsingFile(Request $request){
        $file = $request->file('file');
        if($file->getClientOriginalExtension() != 'csv'){
            return redirect()->route('admin.users')->with('status', 'Please upload a csv file');
        }

        // read the file 
        $file = fopen($file, 'r');
        $i = 0;
        while(($line = fgetcsv($file)) !== false){
            if($i == 0){
                $i++;
                continue;
            }
            $user = new User();
            $user->name = $line[0];
            $user->username = $line[0];
            $user->email = $line[1];
            $user->password = Hash::make($line[2]);
            $user->type = $line[3];
            $user->save();
            
        }

        return redirect()->route('admin.users')->with('status', 'Users have been added successfully');
    }

    public function updateUser(Request $request){

        // validate the request if error return to users page

        $user = User::find($request->id);
        // remove &nbsp
        $user->name = str_replace('&nbsp;', '', $request->name);
        $user->username = str_replace('&nbsp;', '', $request->name);
        $email = $request->email;
        $email = str_replace('&nbsp;', '', $email);
        $email = str_replace(' ', '', $email);
        
        // check if password is changed else keep the old password
        if($request->password != $user->password){
            $user->password = Hash::make($request->password);
        }

        $user->email = $email;
        $user->type = $request->type;
        $user->save();


        return response()->json([
            'status' => 'success',
            'hashedPassword' => $user->password,
            'name' => $user->name,
            'email' => $user->email,
            'type' => $user->type
        ]);
    }

    public function deleteUser(Request $request){
        $user = User::find($request->id);
        $user->delete();
        return redirect()->route('admin.users')->with('status', 'User has been deleted successfully');
    }

    public function qna()
    {   
        // get all qna
        $qnas = Qna::all();
        return view('admin.qna',[
            'qnas' => $qnas
        ]);
    }

    public function updateQuestion(Request $request){
        $qna = Qna::find($request->id);
        //remove &nbsp, &lt, &gt
        $answer = str_replace('&nbsp;', '', $request->answer);
        $answer = str_replace('&lt;', '<', $answer);
        $answer = str_replace('&gt;', '>', $answer);

        $qna->question = $request->question;
        $qna->answer = $answer;

        $qna->save();
        
        return response()->json([
            'status' => 'success',
            'question' => $qna->question,
            'answer' => $qna->answer
        ]);
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
    
    public function books(Request $request)
    {

        $approval = '';

        if($request->approval){
            $approval = $request->approval;
        }

        if($request->search && $request->tags) {
            
            $posts = Post::withAllTags($request->tags)->where('name', 'like', '%'.$request->search.'%')->paginate(100);
        
        } else if($request->search) {
            
            $posts = Post::where('name', 'like', '%'.$request->search.'%')->paginate(100);
        
        } else if($request->tags) {
            
            $posts = Post::withAllTags($request->tags)->paginate(100);
        
        } else {
            
            $posts = Post::paginate(100);
        
        }

        
        if($approval == 'all'){
            $posts = Post::paginate(10);
        }else if($approval == 'approved'){
            $posts = Post::where('approval','APPROVED')->paginate(10);
        }else if($approval == 'pending'){
            $posts = Post::where('approval','PENDING')->paginate(10);
        }else if($approval == 'rejected'){
            $posts = Post::where('approval','REJECTED')->paginate(10);
        }
        else{
            $approval = 'all';
        }
       
        // dd($request->all());


        //dd($request->search, $request->tags, $posts);

        $alltags = Post::existingTags();


        return view('admin.books',[
            'posts' => $posts,
            'approval' => $approval,
            'alltags' => $alltags,
            'search' => $request->search,
            'tags' => $request->tags
        ]);
    }

    public function approve($id)
    {
        $post = Post::find($id);
        $post->approval = 'APPROVED';
        $post->save();

        // redirect to admin books route
        return redirect()->route('admin.books')->with('status', 'Book has been approved successfully');
        
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->approval = 'REJECTED';
        $post->save();
   

        return redirect()->route('admin.books')->with('status', 'Book has been approved successfully');
    }
}
