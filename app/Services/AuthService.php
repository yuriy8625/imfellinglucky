<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class AuthService
{
    public function getOrCreateUser($userName, $phoneNumber): User
    {
        $user = User::query()->firstOrCreate([
            'username' => $userName,
            'phone_number' => $phoneNumber
        ]);

        return $this->refreshToken($user);
    }


    public function refreshToken(User $user): User
    {
        $user->fill([
            'token' => Str::uuid()->toString(),
            'token_expires_at' => now()->addDays(User::DEFAULT_TOKEN_EXPIRES_AT)
        ]);
        $user->save();

        return $user;
    }

    public function deactivateToken(User $user): User
    {
        $user->fill(['token' => null, 'token_expires_at' => null]);
        $user->save();

        return $user;
    }
}
