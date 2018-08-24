<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Snowfire\Beautymail\Beautymail;
use Carbon\Carbon;

class RegisterController extends Controller
{ 

    private $user;
    
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

        $validator = Validator::make($request->all(), [ 
            'email'             => 'required|email',
            'password'          => 'required',
            'password_confirm'  => 'required|same:password'
        ]);

        if($validator->fails())
        {
            return response()->json([ 'error' => $validator->errors() ], 422);
        }  

        $request->email = strtolower($request->email);
        if (User::where('email', '=', $request->email)->exists()) {
            return response()->json([
                'status' => 'Benutzer existiert bereits'
            ], 201);
        }
       
        $user = new User($request->all());
        $user->confirm_code = $this->getConfirm_code();
        $user->password = Hash::make($request->password);
        if(!$user->save()) 
        {
            throw new HttpException(500);
        }

        $user_role = Role::whereName('USER')->first();
        $user->roles()->save($user_role);

        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('mail.register', ["user" => $user], function($message) use ($user)
        {
            $message
                ->from(env('MAIL_MASTER'))
                ->to($user->email, "DoNotReply")
                ->subject(__('mail.register_subject'));
        });
        
        return response()->json([
            'status' => 'ok'
        ], 201);
    }

    /**
     * @OAS\Post(
     *     path="auth/register_confirmed",
     *     tags={"Auth"},
     *     summary="Register form for Users",
     *     @OAS\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     * )
     */  
    public function register_confirmed(Request $request) {

        $validator = Validator::make($request->all(), [ 
            'confirm_code'          => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([ 'error' => $validator->errors() ], 422);
        }   

        $user = User::whereConfirmCode($request->confirm_code)->first();
        $user->confirm_code = null;        
        $user->confirmed_at = Carbon::now();
        $user->save();
       
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('mail.register_confirmed', ["user" => $user], function($message) use ($user)
        {
            $message
                ->from(env('MAIL_MASTER'))
                ->to($user->email, "DoNotReply")
                ->subject(__('mail.register_confirmed_subject'));
        });
        
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
