<?php

namespace App\Http\Controllers\Auth\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Snowfire\Beautymail\Beautymail;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    private $user;

    /**
    * @OAS\Post(
    *     path="auth/reset",
    *     tags={"Auth"},
    *     summary="Reset Password",
    *     @OAS\Response(
    *         response=424,
    *         description="Invalid input"
    *     ),
    * )
    */ 
    public function reset(Request $request)
    {

        $validator = Validator::make($request->all(), [ 
            'password'              => 'required',
            'password_confirmation' => 'required|same:password',
            'token'                 => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([ 'error' => $validator->errors() ], 422);
        } 

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->user = $user;
                $this->resetPassword($user, $password);
            }
        );

        if($response === Password::INVALID_PASSWORD) {
            return response()->json([ 'error' =>  ["password" => "Das Password ist zu kurz"]], 422);
        } 

        if($response === Password::INVALID_USER) {
            return response()->json([ 'error' =>  ["password" => "Der Benutzer konnte nicht gefunden werden"]], 422);
        }            

        if($response !== Password::PASSWORD_RESET) {
            return response()->json([ 'error' =>  ["password" => "Fehler beim Passwort ändern."]], 422);
        }
        
        $beautymail = app()->make(Beautymail::class);
        $user = $this->user;
        $beautymail->send('mail.password_change', ["user" => $user], function($message) use ($user)
        {
            $message
                ->from(env('MAIL_MASTER'))
                ->to($user->email, $user->firstname . $user->surname)
                ->subject(__('mail.password_change_subject'));
        });

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {   
        $request->email = strtolower($request->email);
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
    }
}