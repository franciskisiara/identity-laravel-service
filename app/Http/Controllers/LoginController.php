<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Login the user
     */
    public function login (LoginRequest $request)
    {
        $token = DB::transaction(function () use($request) {
            $user = User::where('email', $request->email)->first();

            $user->tokens()->where('name', $request->device_name)->delete();

            return $user->createToken($request->device_name)->plainTextToken;
        });

        return response()->json([
            'token' => $token,
        ]);
    }
}
