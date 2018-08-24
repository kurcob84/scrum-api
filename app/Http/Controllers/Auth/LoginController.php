<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

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
        
        try {
            
            $token = $JWTAuth->attempt($credentials);
            $JWTAuth->setToken($token);
            $user = $JWTAuth->toUser($token);
            $user->load('roles');

            if($user->confirmed_at == NULL) 
            {
                throw new AccessDeniedHttpException("user_not_confirmed");
            }

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
                'user' => $user,
                'user' => new UserResource($user),
                'token' => $token
            ], 201);
            
        } catch (JWTException $e) 
        {   
           throw new AccessDeniedHttpException();
        }
    }
}