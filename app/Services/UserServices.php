<?php

namespace App\Services;

interface UserServices{
    function login(string $email, string $password): bool;

    function register(string $name, string $email, string $password): bool;
}