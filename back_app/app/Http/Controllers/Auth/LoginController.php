<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class LoginController extends Controller
{
    /**
     * Authenticate user
     *
     * @param Request $request
     *
     * @return JSON
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['data' => ['error' => [
                    'message' => 'Invalid email or password',
                    'code' => 'invalid_credentials',
                    'errors' => []
                ]]], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'data' => ['error' => [
                    'message' => 'Could not create token',
                    'code' => 'could_not_create_token',
                    'errors' => []
                ]]
            ], 500);
        }

        JWTAuth::setToken($token);
        $user = JWTAuth::authenticate();

        return response()->json(['data' => compact('user', 'token')]);
    }
}
