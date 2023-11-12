<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLoginPage(){
        return view('auth.login');
    }
 public function regsterPage(){
    return view('auth.signup');
 }


    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials , true)) {
            return redirect(route('dashboard'))->with("success","Welcome Back!"); // Redirect to the intended page
        } else {
            return back()->withErrors([
                'email' => 'Invalid credentials',
            ]);
        }
    }

    public function regester(Request $request){
        $credentials = $request->validate([
            'name' => 'required',
            'email'=> 'required|email',
            'password'=> 'required',
            'cpassword'=> 'same:password',
            ]);
        // $user = Auth::user();
            // if ($user) {
            //  $credentials['role'] = $request->role;
        User::create($credentials);

        session()->flash("message","You Signup seccsfully");
        return redirect('dashboard');
// }else {
//     return back()->withErrors([
//         'email' => 'Invalid credentials',
//     ]);
}

public function storeUser(Request $request){

    $data = $request->validate([
        'name'=> 'required',
        "email"=> "required|email|unique:users,email,except,id",
        "password"=> "required",
        "cpassword"=> "same:cpassword"
        ]);
     User::create($data);
      return redirect(route('dashboard'))->with('success','User created Successfully!');


}

}
