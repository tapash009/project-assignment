<?php

namespace App\Http\Controllers\API\V1\Auth;

use Config;
use App\Models\Auth\User;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Auth\SignUpRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SignUpController extends Controller
{
    public function signUp(SignUpRequest $request, JWTAuth $JWTAuth)
    {
        $user = new User($request->all());
        if(!$user->save()) {
            throw new HttpException(500);
        }

        if(!Config::get('api-validations.sign_up.release_token')) {
            return response()->json([
                'status' => 'ok'
            ], 201);
        }

        $token = $JWTAuth->fromUser($user);
        return response()->json([
            'status' => 'ok',
            'token' => $token,
            'token_type' => 'bearer',
        ], 201);
    }
}
