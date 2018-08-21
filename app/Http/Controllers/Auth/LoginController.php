<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function login(LoginRequest $request, JWTAuth $JWTAuth) {

        $credentials = $request->only(['email', 'password']);        
        $credentials['email'] = strtolower($credentials['email']);
        
        try {

            $token = $JWTAuth->attempt($credentials);
            $user = $JWTAuth->toUser($token);
            $user->token = $token;
            $user->role =  $user->getRoles();

            if($user->deleted_at != NULL) 
            {
                throw new AccessDeniedHttpException();
            }
            
            if(!$token) 
            {
                throw new AccessDeniedHttpException();
            }

            return response()->json([
                'status' => 'ok',
                'user' => $user
            ], 201);
            
        } catch (JWTException $e) 
        {   
           throw new AccessDeniedHttpException();
        }
    }
}
