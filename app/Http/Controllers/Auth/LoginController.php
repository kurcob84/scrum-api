<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Rules\UserConfirmed;
use App\Rules\UserDeleted;
use App\Rules\UserCredentials;
use Socialite;
use Exception;
use Auth;

class LoginController extends Controller
{
    /**
     * @OAS\Post(
     *     path="auth/login",
     *     tags={"Auth"},
     *     summary="Login for Users",
     *     @OAS\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     * )
     */    
    public function login(Request $request) {

        $validator = Validator::make($request->all(), [ 
            'email'             => 'required|email',
            'password'          => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([ 'error' => $validator->errors() ], 422);
        }
        $credentials = $request->only(['email', 'password']);  
        $user = User::where('email', strtolower($credentials['email']))->first();
        if($user) {

            $validator = Validator::make(
                [
                    "confirmed_at"  => $user->confirmed_at,
                    "deleted_at"    => $user->deleted_at
                ], 
                [ 
                    'confirmed_at'  => new UserConfirmed,
                    'deleted_at'    => new UserDeleted
                ]
            );
    
            if($validator->fails())
            {
                return response()->json([ 'error' => $validator->errors() ], 422);
            }

            if(Auth::attempt(['email' => strtolower($credentials['email']), 'password' => $credentials['password']])){
                // dd($user);
                $token = $user->createToken('Login Token')->accessToken;
                return response()->json([
                    'status' => 'ok',
                    'user' => $user,
                    'token' => $token
                ], 201);
            }
            else {
                return response()->json([
                    'status' => 'ok',
                    'user' => 'password missmatch'
                ], 201); 
            }
        }
        else {
            return response()->json([
                'status' => 'ok',
                'user' => 'user does not exist'
            ], 201);
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback($provider)
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['facebook_id'] = $user->getId();


            $userModel = new User;
            $createdUser = $userModel->addNew($create);
            Auth::loginUsingId($createdUser->id);


        return response()->json([
            'status' => 'ok',
            'user' => $user
        ], 201); 


        } catch (Exception $e) {




        }

        return response()->json([
            'status' => 'ok',
            'user' => $user
        ], 201); 
    }
}