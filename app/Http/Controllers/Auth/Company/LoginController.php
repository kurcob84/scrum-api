<?php

namespace App\Http\Controllers\Auth\Company;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Company\Company;
use Illuminate\Support\Facades\Validator;
use App\Rules\UserConfirmed;
use App\Rules\UserDeleted;
use App\Rules\UserCredentials;
use Socialite;
use Exception;
use Auth;

class LoginController extends Controller
{
    protected $guard = 'company';
    
    /**
     * @OAS\Post(
     *     path="auth/company/login",
     *     tags={"Auth"},
     *     summary="Login for Company",
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
        if(Auth::guard('company')->attempt(['email' => strtolower($credentials['email']), 'password' => $credentials['password']]))
        {
            $company = Company::where('email', strtolower($credentials['email']))->first();
            if($company) {

                $validator = Validator::make(
                    [
                        "confirmed_at"  => $company->confirmed_at,
                        "deleted_at"    => $company->deleted_at
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
                $token = $company->createToken('Login Token')->accessToken;
                return response()->json([
                    'status' => 'ok',
                    'company' => $company,
                    'token' => $token
                ], 201);
            }
            else { 
                return response()->json([
                    'status' => 'ok',
                    'company' => 'company does not exist'
                ], 201);
            }
        }
        else {
            return response()->json([
                'status' => 'ok',
                'company' => 'password missmatch'
            ], 201);
        }
    }
}