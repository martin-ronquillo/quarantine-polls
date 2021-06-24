<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8',
        // ]);

        // $user = User::create([
        //     'name' => $validatedData['name'],
        //     'email' => $validatedData['email'],
        //     'password' => Hash::make($validatedData['password']),
        // ]);

        // $token = $user->createToken('auth_token')->plainTextToken;

        // return response()->json([
        //     'access_token' => $token,
        //     'token_type' => 'Bearer',
        // ]);

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

        // $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Successfully created user!',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(Request $request)
    {
        // if (!Auth::attempt($request->only('email', 'password'))) {
        //     return response()->json([
        //         'message' => 'Invalid login details'
        //     ], 401);
        // }

        // $user = User::where('email', $request['email'])->firstOrFail();

        // $token = $user->createToken('auth_token')->plainTextToken;

        // return response()->json([
        //         'access_token' => $token,
        //         'token_type' => 'Bearer',
        // ]);

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401
        );
        
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();
        
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function me(Request $request)
    {
        return $request->user();
    }
}
