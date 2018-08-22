<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    public function register(Request $request) {
        $request->email = strtolower($request->email);
        $user = new User($request->all());
        $user->confirm_code_email = $this->getConfirm_code();
        $user->password = Hash::make($request->password);
        if(!$user->save()) 
        {
            throw new HttpException(500);
        }

        $user_role = Role::whereName('USER')->first();
        $user->roles()->save($user_role);
        
        return response()->json([
            'status' => 'ok'
        ], 201);
    }
    
    /**
     * calculates a random string
     * 
     * @return type
     */
    protected function getConfirm_code()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }
}
