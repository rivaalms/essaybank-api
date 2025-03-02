<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthR;
use App\Http\Resources\UserRes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthC extends Controller
{
    public function login(AuthR $request)
    {
        $payload = $request->validated();
        $user = User::where('email', $payload['email'])->firstOrFail();
        if (!Hash::check($payload['password'], $user->password)) {
            throw new \Exception('Invalid credentials', 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->response([
            'user' => new UserRes($user),
            'token' => $token
        ], 'Login success');
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        return $this->response($user->currentAccessToken()->delete(), 'Logout success');
    }

    public function me(Request $request)
    {
        return $this->response(new UserRes($request->user()));
    }
}
