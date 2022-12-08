<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request): SuccessResource
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return SuccessResource::make([
            'message' => 'User Created Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ]);
    }

    public function login(UserLoginRequest $request): SuccessResource|ErrorResource
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return ErrorResource::make([
                'message' => 'Email & Password does not match with our record.',
            ]);
        }

        $user = User::where('email', $request->email)->first();

        return SuccessResource::make([
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ]);
    }
}
