<?php

namespace App\Http\Controllers\Api\Auth;

use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{

    public function login(LoginRequest $request, JWTAuth $JWTAuth)
    {
        $credentials = $request->only(['email', 'password']);

        try {
            $token = Auth::guard()->attempt($credentials);

            if (!$token) {            
                throw new AccessDeniedHttpException();
            }

        } catch (JWTException $e) {
            throw new HttpException(500);
        }

        return response()->json([
            'status' => 'ok',
            'token' => $token,
            // 'expires_in' => Auth::guard()->factory()->getTTL() * 60,
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => Auth::guard()->user()
        ]);
    }

    public function register(RegisterRequest $request, JWTAuth $JWTAuth)
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
