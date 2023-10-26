<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Laravel\Passport\TokenRepository;
use Illuminate\Support\Facades\Hash;

//line added below
use Auth;
use DB;

class UserController extends Controller
{
    public function registerUser(Request $request) 
    {
        // $request->validate([
        //     'name'=>'required',
        //     'email'=>'required|email|unique:users',
        //     'password'=>'required',
        // ]);
        $data = $request->only('name', 'email', 'password');

        try {
            $data['password'] = Hash::make($data['password']);

            User::create($data);

            return response([
                'status' => 200,
                'message' => 'User registered successfully',
            ], 200);
        } 
        catch (\Exception $exception) {
            return response([
                'status' => 401,
                'message' => 'user not created',
                'error' => $exception
            ], 401);
        }
        
    }
    /**
     * Display a listing of the resource.
     */
    // public function loginUser(Request $request){

    //     try{

    //         if (Auth::attempt($request->only('email','password'))) {
    //             $user = Auth::user();
    //             $token = $user->createToken('app')->accessToken;

    //             return response([
    //                 'message' => "Successfully Login",
    //                 'token' => $token,
    //                 'user' => $user
    //             ],200); // States Code
    //         }

    //     }catch(Exception $exception){
    //         return response([
    //             'message' => $exception->getMessage()
    //         ],400);
    //     }
    //     return response([
    //         'message' => 'Invalid Email Or Password' 
    //     ],401);

    // } // end method 
    
    public function loginUser(Request $request)
    {
        $input = $request->only('email', 'password');

        Auth::attempt($input);

        if (Auth::check()) 
        {
            $user = Auth::user();
    
            $token = $user->createToken('token_new');
            
            // Get the access token and the refresh token
            $accessToken = $token->accessToken;


            return response([
                'status' => 200,
                'access_token' => $accessToken,
            ], 200);
        }

        return response(['status' => 401, 'message' => 'Unauthorized'], 401);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function userDetails()
    {
        if(Auth::guard('api')->check())
        {
            $user = Auth::guard('api')->user();

            return Response([
                'data' => $user,
                'status' => 200
            ],200);
        }
        return Response([
            'data' => 'Unauthorized',
            'status' => 401
        ],401);
    }

    /**
     * Display the specified resource.
     */
    public function userLogout()
    {
        if(Auth::guard('api')->check())
        {
            // $access_token = Auth::guard('api')->user()->token();

            // // DB::table('oauth_refresh_tokens')
            // //     ->where('id', $access_token->id)
            // //     ->update([
            // //         'revoked' => true
            // //     ]);
            // DB::table('oauth_access_tokens')
            //     ->where('access_token_id', $access_token->id)
            //     ->update([
            //         'revoked' => true
            //     ]);

            // $access_token->revoke();


            $access_token_id = Auth::guard('api')->user()->token()->id;
            $tokenRepository = app(TokenRepository::class);

            $tokenRepository->revokeAccessToken($access_token_id);
            

            return Response(['status' => 200, 'message' => 'User logged out successfully'], 200);
        }

        return Response(['data' => 'Unauthorized'],401);
    }

}
