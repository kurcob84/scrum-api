<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ResetPasswordController extends Controller
{
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
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->user = $user;
                $this->resetPassword($user, $password);
            }
        );
        
        if($response !== Password::PASSWORD_RESET) {
            throw new HttpException(500);
        }
        else {
            $beautymail = app()->make(Snowfire\Beautymail\Beautymail::class);
            $user = User::where('email', '=', strtolower('roggepatrick@googlemail.com'))->first();
            App::setLocale('en');
            $beautymail->send('mail.password_change', ["user" => $user], function($message)
            {
                $message
                    ->from(env('MAIL_MASTER'))
                    ->to($user->email, $user->firstname . $user->surname)
                    ->subject(__('mail.password_change_subject'));
            });

            return response()->json([
                'status' => 'ok',
                'token' => $JWTAuth->fromUser($user)
            ]);
        }
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