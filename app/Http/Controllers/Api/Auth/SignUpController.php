<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Requests\SignUpRequest;
use App\Http\Controllers\Controller;

class SignUpController extends Controller
{
    public function post(SignUpRequest $request, JWTAuth $JWTAuth)
    {
        $user = new User($request->all());
        if (!$user->save()) {
            throw new HttpException(500);
        }

        $token = $JWTAuth->fromUser($user);
        return response()->json([
            'status' => 'ok',
            'token' => $token
        ], 201);
    }

    public function get()
    {
        return 'ok';
    }
}
