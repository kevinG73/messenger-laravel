<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login()
    {
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $resultat = auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
        ]);

        if ($resultat) {
            return redirect('/');
        }

        return back()->withInput()->withErrors([
            'invalid' => 'Vos identifiants sont incorrects.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
