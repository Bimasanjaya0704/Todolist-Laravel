<?php

namespace App\Services\Impl;

use App\Models\User;
use App\Services\UserServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserServicesImpl implements UserServices
{
    public function login(string $email, string $password): bool
    {
        return Auth::attempt([
            "email" => $email,
            "password" => $password,
        ]);
    }

    public function register(string $name, string $email, string $password): bool
    {
        // Create new user
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);

        // Save user to database
        return $user->save();
    }
}
