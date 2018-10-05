<?php

namespace App\Http\Controllers\Auth\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Applicant\Applicant;
use Illuminate\Support\Facades\Validator;
use App\Rules\UserConfirmed;
use App\Rules\UserDeleted;
use App\Rules\UserCredentials;
use Socialite;
use Exception;
use Auth;

class LoginController extends Controller
{
    protected $guard = 'applicant';

    /**
     * @OAS\Post(
     *     path="auth/appicant/login",
     *     tags={"Auth"},
     *     summary="Login for Applicant",
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
        if(Auth::guard('applicant')->attempt(['email' => strtolower($credentials['email']), 'password' => $credentials['password']]))
        {
            $applicant = Applicant::where('email', strtolower($credentials['email']))->first();
            if($applicant) {

                $validator = Validator::make(
                    [
                        "confirmed_at"  => $applicant->confirmed_at,
                        "deleted_at"    => $applicant->deleted_at
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
                $token = $applicant->createToken('Login Token')->accessToken;
                return response()->json([
                    'status' => 'ok',
                    'applicant' => $applicant,
                    'token' => $token
                ], 201);
            }
            else { 
                return response()->json([
                    'status' => 'ok',
                    'applicant' => 'applicant does not exist'
                ], 201);
            }
        }
        else {
            return response()->json([
                'status' => 'ok',
                'applicant' => 'password missmatch'
            ], 201);
        }
    }
}