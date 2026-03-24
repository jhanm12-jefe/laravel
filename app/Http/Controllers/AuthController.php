<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 🔥 REGISTRO
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Auto login
        Auth::login($user);

        return redirect('/clientes')->with('success', 'Registro exitoso');
    }

    // 🔐 LOGIN
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/clientes')->with('success', 'Inicio de sesión exitoso');
        }

        return back()->withErrors([
            'login' => 'Correo o contraseña incorrectos'
        ])->withInput();
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Sesión cerrada');
    }
}
