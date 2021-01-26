<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersService
{
    public function login($inputBody)
    {
        if (Auth::attempt($inputBody)) {
            request()->session()->regenerate();
            return redirect()->intended('/product-list');
        }
        return back()->withErrors(
            ['email' => 'Email atau password salah', 'password' => 'Email atau password salah']
        );
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

    public function updateUser(int $userId, $valueUpdate)
    {
        return User::where('id', $userId)->update($valueUpdate);
    }
}
