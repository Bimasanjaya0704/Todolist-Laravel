<?php

namespace App\Services\Impl;
use App\Services\UserServices;

class UserServicesImpl implements UserServices
{
    private array $users = [
        "bimas"=> "rahasia",
    ];
   public function login(string $username, string $password): bool
    {
        if(!isset($this->users[$username])){
            return false;
        }

        $correctPassword = $this->users[$username];
        // if($password == $correctPassword){
        //     return true;
        // } else{
        //     return false;
        // }
        return $password == $correctPassword;
    }
}