<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $userServices;

    public function __construct(UsersService $userServices)
    {
        $this->userServices = $userServices;
    }

    public function getLoginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        return $this->userServices->login($credentials);
    }

    public function getRegisterPage()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validate = $request->validate(['email' => 'email:filter', 'password' => 'min:6']);
        $resultRegister = $this->userServices->register($request->all());
        return $resultRegister;
    }
}
