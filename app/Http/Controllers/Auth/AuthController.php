<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login SPK Kredit Celana'
        ];
        return view('auth.login', $data);
    }

    public function auth_login(Request $request)
    {
        // dd($request->email);

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->with('error', 'Email atau Kata sandi salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/auth')->with('success', 'Anda Berhasil Logout');
    }
}
