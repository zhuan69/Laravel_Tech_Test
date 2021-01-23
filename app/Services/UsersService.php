<?php

namespace App\Services;

use App\Models\User;
use Whoops\Exception\ErrorException;

class UsersService
{
    public function login($inputBody)
    {
        $email = $inputBody['email'];
        $password = $inputBody['password'];
        $userData = User::where(`email = $email AND password = $password`)->findOrFail();
        if (!$userData) {
            throw new ErrorException("wrong email or password", 400);
        }
        return $userData;
    }

    public function getRegisterPage()
    {
        return view('register');
    }

    public function register($inputBody)
    {
        $inputBody['password'] = bcrypt($inputBody['password']);
        $resultRegister = User::create(['name' => $inputBody['name'], 'email' => $inputBody['email'], 'password' => $inputBody['password']]);
        return $resultRegister;
    }
}
