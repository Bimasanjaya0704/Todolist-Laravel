<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserServices $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function showRegistrationForm(): Response
    {
        return response()->view('user.register', [
            'title' => 'Register',
        ]);
    }

    public function register(Request $request): Response|RedirectResponse
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        // validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($this->userServices->register($name, $email, $password)) {
            return redirect('/login')->with('success', 'Registration successful! You can now login.');
        }

        return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again.');
    }

    public function login(): Response
    {
        return response()->view('user.login', [
            'title' => 'Login',
        ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // validate input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($this->userServices->login($email, $password)) {
            $request->session()->put('user', $email);
            return redirect('/');
        }

        return redirect()->back()->withInput()->with('error', 'Email and Password is wrong');
    }

    public function doLogout(Request $request): RedirectResponse
    {
        $request->session()->forget('user');
        return redirect('/');
    }
}
