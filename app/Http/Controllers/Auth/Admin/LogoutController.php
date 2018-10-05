<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{

    /**
     * @OAS\Post(
     *     path="auth/logout",
     *     tags={"Auth"},
     *     summary="Logout a user",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok"
     *     ),
     *     @OAS\Parameter(
     *         name="Authorization",
     *         in="query",
     *         description="JWT access token.",
     *         required=true,
     *         @OAS\Schema(
     *             type="header",
     *         )
     *     ),
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'ok'
        ], 201);
    }
}