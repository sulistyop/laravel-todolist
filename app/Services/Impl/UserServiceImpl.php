<?php

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Support\Facades\Session;

class UserServiceImpl implements UserService
{
    private array $users = [
      "sulis" => "rahasia"
    ];
    function login(string $user, string $password): bool
    {
       if(!isset($this->users[$user])){
           return false;
       }
       $correctPassword = $this->users[$user];
       return $password == $correctPassword;
    }
}
