<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Rules\UserConfirmed;
use App\Rules\UserDeleted;
use App\Rules\UserCredentials;

class LoginController extends Controller
{

    public function login(Request $request, JWTAuth $JWTAuth) {

        $validator = Validator::make($request->all(), [ 
            'email'             => 'required|email',
            'password'          => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([ 'error' => $validator->errors() ], 422);
        }

        $credentials = $request->only(['email', 'password']);        
        $credentials['email'] = strtolower($credentials['email']);
        
        $token = $JWTAuth->attempt($credentials);
        $validator = Validator::make(
            [
                "token"         => $token
            ], 
            [ 
                'token'         => new UserCredentials,
            ]
        );

        if($validator->fails())
        {
            return response()->json([ 'error' => $validator->errors() ], 422);
        }

        $JWTAuth->setToken($token);
        $user = $JWTAuth->toUser($token);
        $user->load('roles');

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
        
        return response()->json([
            'status' => 'ok',
            'user' => $user,
            'user' => new UserResource($user),
            'token' => $token
        ], 201);
    }
}