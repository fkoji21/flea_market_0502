<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => '認証に失敗しました',
        ]);

    }

    public function showRegisterForm()
    {
        // 商品一覧ページ表示
        return view('register');
    }

    public function register()
    {
        return view('register');
    }

    public function showLoginForm()
    {
        return view('login', compact('login'));
    }
}
