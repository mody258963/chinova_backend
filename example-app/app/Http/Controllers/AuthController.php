<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLoginPage(){
        return view('auth.login');
    }


    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'passoword' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('posts.index')); // Redirect to the intended page
        } else {
            return back()->withErrors([
                'email' => 'Invalid credentials',
            ]);
        }
    }
}
