<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->load('roles', 'reservations', 'reservations.tickets');
        return response()->json($user);
    }

    public function roles(): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        return response()->json($user->roles);
    }

    public function reservations(): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        return response()->json($user->reservations);
    }

    public function reservation($reservation): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        return response()->json($user->reservations()->with('tickets')->findOrFail($reservation));
    }
}
