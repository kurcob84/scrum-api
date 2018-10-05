<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Socialite;
use Exception;
use Auth;

class XingController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('xing')->stateless()->redirect();
    }

    public function handleCallback($provider)
    {
    }
}