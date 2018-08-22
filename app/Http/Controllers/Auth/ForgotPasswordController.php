<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

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
        $user = User::where('email', '=', strtolower($request->email))->first();

        if(!$user) {
            throw new NotFoundHttpException();
        }
        if($user->confirm_code_email !== null){
            return response()->json([
                'error' => 'email confirmation required'
            ],424);
        }
        if($user->confirmed_at === null){
            return response()->json([
                'error' => 'user not confirmed'
            ],424);
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
