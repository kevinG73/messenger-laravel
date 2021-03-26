<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response([
                'data' => '',
                'success' => false,
                'message' => 'Invalid Credentials'
            ]);
        }

        return response([
            'data' => auth()->user(),
            'success' => true,
            'message' => 'user successful authentified'
        ]);
    }
}
