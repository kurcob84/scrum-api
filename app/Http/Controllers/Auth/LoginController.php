<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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
    public function login(Request $request, JWTAuth $JWTAuth) {

        $credentials = $request->only(['email', 'password']);        
        $credentials['email'] = strtolower($credentials['email']);
        
        try {
            
            $token = $JWTAuth->attempt($credentials);
            $JWTAuth->setToken($token);
            $user = $JWTAuth->toUser($token);

            if($user->deleted_at != NULL) 
            {
                throw new AccessDeniedHttpException();
            }
            
            if(!$token) 
            {
                throw new AccessDeniedHttpException();
            }

            $user->token = $token;
            $user->role =  $user->roles();
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
