<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;


class ApiAuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        /** @var \App\Models\User $user */ // this prevents the error of $user->createToken() below
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token', ['*'], now()->addDays(7))->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => now()->addDays(7)->toDateTimeString()
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            /** @var \App\Models\User $user */ // this prevents the error of $user->createToken() below
            $user = Auth::user();

            $token = $user->createToken('auth_token', ['*'], now()->addSeconds(7))->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => now()->addDays(7)->toDateTimeString()
            ]);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function refresh(Request $request)
    {
        $user = $request->user();

        // Revoke the user's current token
        $user->currentAccessToken()->delete();

        // Issue a new token
        $token = $user->createToken('auth_token', ['*'], now()->addDays(7))->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => now()->addDays(7)->toDateTimeString()
        ]);
    }
}
