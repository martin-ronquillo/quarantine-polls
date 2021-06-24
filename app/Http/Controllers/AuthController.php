<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\User as UserResource;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $request->validate([
            'ci' => 'required|digits:10|unique:users,ci',
            'name' => ['required', 'string', 'max:25'],
            'last_name' => 'required', 'string', 'max:25',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);

        $user = User::create([
            'ci' => $request->ci,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        // return response()->json([
        //     'access_token' => $token,
        //     'token_type' => 'Bearer',
        // ]);
        return $this->sendResponse($user, $token, 'User register successfully.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            // 'remember_me' => 'boolean'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        
        $token = $user->createToken($user->email)->plainTextToken;

        $user->api_token = $token;

        return $this->sendResponse($user, 'User login successfully.');
    }

    public function logout(Request $id)
    {
        Auth::user()->tokens()->delete();

        // $user = User::find(1);
        // $user->tokens()->delete();

        return response()->json([
            'message' => 'Tokens Revoked'
        ]);
    }
}
