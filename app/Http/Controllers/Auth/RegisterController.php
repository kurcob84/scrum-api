<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{ 
    /**
     * @OAS\Post(
     *     path="auth/register",
     *     tags={"Auth"},
     *     summary="Register form for Users",
     *     @OAS\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     * )
     */  
    public function register(SignUpRequest $request) {
        $request->email = strtolower($request->email);
        $user = new User($request->all());
        $user->confirm_code_email = $this->getConfirm_code();
        $user->password = Hash::make($request->password);
        if(!$user->save()) 
        {
            throw new HttpException(500);
        }

        $user_role = Role::whereName('USER')->first();
        $user->attachRole($user_role);
        
        return response()->json([
            'status' => 'ok'
        ], 201);
    }
}
