<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    public function send_reset_password_email(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);
        $email = $request->email;

        // Check User's Email Exists or Not
        $user = User::where('email', $email)->first();
        if(!$user){
            return response([
                'message'=>'Email doesnt exists',
                'status'=>'failed'
            ], 404);
        }

        // Generate Token
        $token = Str::random(60);

        // Saving Data to Password Reset Table
        PasswordReset::create([
            'email'=>$email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);
        
        // Sending EMail with Password Reset View
        Mail::send('reset', ['token'=>$token], function(Message $message)use($email){
            $message->subject('Reset Your Password');
            $message->to($email);
        });
        // \Mail::to($email)->send(new UserMail($event->product));

        return response([
            'message'=>'Password Reset Email Sent... Check Your Email',
            'status'=>'success'
        ], 200);
    }

    public function reset_password(Request $request)
    {
        $token = $request->token;
        // Delete Token older than 2 minute
        // $formatted = Carbon::now()->subMinutes(2)->toDateTimeString();
        // PasswordReset::where('created_at', '<=', $formatted)->delete();

        $request->validate([
            'password' => 'required',
        ]);

        $passwordreset = PasswordReset::where('token', $token)->first();


        if(!$passwordreset) {
            return response([
                'message'=>'Token is Invalid or Expired',
                'status'=>'failed'
            ], 404);
        }

        $user = User::where('email', $passwordreset->email)->first();

        if(!$user) {
            return response([
                'message'=>'User doesnt exist',
                'status'=>'failed'
            ], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the token after resetting password
        PasswordReset::where('email', $user->email)->delete();

        return response([
            'message'=>'Password Reset Success',
            'status'=>200
        ], 200);

        // return response([
        //     'message' => 'Password reset successful',
        //     'status' => 200
        // ], 200);
    }
}
