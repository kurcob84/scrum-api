<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Validator;
use App\Rules\UserConfirmed;
use App\Rules\UserDeleted;
use App\Rules\UserCredentials;
use Socialite;
use Exception;
use Auth;

class LoginController extends Controller
{
    protected $guard = 'admin';

    /**
     * @OAS\Post(
     *     path="auth/admin/login",
     *     tags={"Auth"},
     *     summary="Login for Admin",
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
        if(Auth::attempt(['email' => strtolower($credentials['email']), 'password' => $credentials['password']]))
        {
            $admin = Admin::where('email', strtolower($credentials['email']))->first();
            if($admin) {

                $validator = Validator::make(
                    [
                        "deleted_at"    => $admin->deleted_at
                    ], 
                    [ 
                        'deleted_at'    => new UserDeleted
                    ]
                );
        
                if($validator->fails())
                {
                    return response()->json([ 'error' => $validator->errors() ], 422);
                }
                $token = $admin->createToken('Login Admin Token')->accessToken;
                return response()->json([
                    'status' => 'ok',
                    'admin' => $admin,
                    'token' => $token
                ], 201);
            }
            else { 
                return response()->json([
                    'status' => 'ok',
                    'admin' => 'admin does not exist'
                ], 201);
            }
        }
        else {
            return response()->json([
                'status' => 'ok',
                'admin' => 'password missmatch'
            ], 201);
        }
    }
}