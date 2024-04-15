<?php

namespace App\Services\Impl;
use App\Services\UserServices;
use Illuminate\Support\Facades\Auth;

class UserServicesImpl implements UserServices
{
    
    public function login(string $email, string $password): bool
    {
        return Auth::attempt([
            "email" => $email,
            "password"=> $password,
        ]);
    }
}