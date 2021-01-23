<?php

namespace App\Services;

use App\Models\User;

class UsersService
{
    public function login($inputBody)
    {
        $email = $inputBody['email'];
        $password = $inputBody['password'];
        $userData = User::where(`email = $email AND password = $password`)->findOrFail(1);
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
