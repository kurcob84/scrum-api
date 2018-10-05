<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Rules\UserNotExists;
use App\Rules\UserDeleted;
use App\Rules\UserConfirmed;

class ForgotPasswordController extends Controller
{
     /**
     * @OAS\Post(
     *     path="auth/forgot",
     *     tags={"Auth"},
     *     summary="Password forgot send Mail",
     *     @OAS\Response(
     *         response=424,
     *         description="Invalid input"
     *     ),
     * )
     */  
    public function forgot(Request $request)
    {

        $validator = Validator::make($request->all(), [ 
            'email'             => ['required', 'email', new UserNotExists]
        ]);

        if($validator->fails())
        {
            return response()->json([ 'error' => $validator->errors() ], 422);
        }

        $user = User::where('email', '=', strtolower($request->email))->first();
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

        $broker          = $this->getPasswordBroker();
        $sendingResponse = $broker->sendResetLink( ['email' => strtolower($request->email)]);

        if($sendingResponse !== Password::RESET_LINK_SENT) 
        {
            throw new HttpException(500);
        }

        return response()->json([
            'status' => 'ok'
        ], 201);
    }

    private function getPasswordBroker()
    {
        return Password::broker();
    }
}
