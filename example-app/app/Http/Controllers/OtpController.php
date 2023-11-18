<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\SampleMail;
use \Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{

     public function OPTPage(){
          return view('auth.otp');
      }
      public function OPTverifyPage(){
          return view('auth.otpverify');
      }



       public function OtpRequst(Request $request){

          $credentials = $request->validate([
               'email' => 'required|email',
           ]);
           if ($credentials) {
                $otp = rand(100000, 999999);
               session(['otp'=> $otp]);
               $content = [
                'subject' => 'OTP from Chinova',
                'body' => $otp,
            ];

            Mail::to($request->input('email'))->send(new SampleMail($content));

               return redirect(route('OPT.verify.page'))->with('success','OTP has been sent');
           } else {
               return back()->withErrors([
                   'email' => 'Please SignUp first',
               ]);
           }



       }

      public function Otp(Request $request){

       if($request->input('otp') == session('otp')){
              $user = Auth::user();
              auth()->login($user);
              return redirect(route('dashboard'));

      }



}
}
