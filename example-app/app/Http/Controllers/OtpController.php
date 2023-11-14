<?php

namespace App\Http\Controllers;
use Ichtrojan\Otp\Models\Otp;
use Illuminate\Http\Request;

class OtpController extends Controller
{
 
     public function OtpRequst(Request $request){
        
        $EmailOtp = $request->input('email');
        $OtpRequst = Otp::generate($EmailOtp,6,15);
        $OptResponse = $request->input('otp');
        $OtpCheak =  Otp::validate($EmailOtp, $OptResponse);
        if($OtpCheak['status'] == 'true'){
            return redirect(route('dashboard '))->with('status', 'OTP matched');
        }
        return $OtpRequst;
     }

      public function Otp(Request $request){
    
       


      }


}
