<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request){
        //vailidate   
       
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

    
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'STUDENT',
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('dashboard');
    }
}
