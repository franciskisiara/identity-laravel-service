<?php

use App\Http\Controllers\LoginController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->get('/doe', function (Request $request) {
    return response()->json([
        'data' => new UserResource($request->user())
    ]);
});
