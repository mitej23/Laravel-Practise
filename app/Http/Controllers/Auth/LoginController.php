<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function index(){
        return view('auth.login');
    }

    public function home(){
        // check if user exists
        if(Auth::check()){
            if(Auth::user()->type == 'ADMIN'){
                return redirect()->route('admin.users');
            }
            if(Auth::user()->type == 'STAFF' || Auth::user()->type == 'STUDENT'){
                return redirect()->route('dashboard');
            }
        }
        return view('home');
    }

    public function store(Request $request){
      

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!auth()->attempt($request->only('email','password'))){
           return back()->with('status', '* Invalid Email / Password');
        }

        if(Auth::user()->type == 'ADMIN'){
            return redirect()->route('admin.users');
        }

        return redirect()->route('dashboard');
    }
}
