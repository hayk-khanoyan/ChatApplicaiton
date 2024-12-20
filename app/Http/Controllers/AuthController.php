<?php

declare(strict_types=1);

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

        /** @var User $user */
        $user = User::query()
            ->create($validated);

        return SuccessResource::make([
            'message' => 'User Created Successfully',
            'token' => $user->createToken('API_TOKEN')->plainTextToken,
        ]);
    }

    public function login(UserLoginRequest $request): SuccessResource|ErrorResource
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return ErrorResource::make([
                'message' => 'Credentials does not match with our record.',
            ]);
        }
        /** @var User $user */
        $user = User::query()
            ->where('username', $validated['username'])
            ->firstOrFail();

        return SuccessResource::make([
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken('API_TOKEN')->plainTextToken,
        ]);
    }
}
