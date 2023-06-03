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
        return view('auth.login');
    }
    public function registrasi()
    {
        return view('auth.registrasi');
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
    public function auth_regist(Request $request)
    {
        // dd($request->all());
        $validasi = $request->validate(
            [
                'name' => 'required|max:255',
                'username' => 'required|max:255|unique:users',
                'password' => 'required_with:password1|min:6|max:255|same:confirm_password',
                'confirm_password' => 'min:6|same:password',


            ],
            [
                'username.unique' => 'Username, gunakan username lain!',
                'username.required' => 'Harap Masukkan Username!',
                'name.required' => 'Harap Masukkan Nama!',
                'password.required' => 'Harap Masukkan Password!',
                'password.min' => 'Kata Sandi Minimal 6 Karakter!',
                'password.same' => 'Kata Sandi Tidak Sama!',
                'confirm_password.same' => 'Kata Sandi Tidak Sama!',
                'confirm_password.min' => 'Kata Sandi Minimal 6 Karakter!',
            ]
        );

        $validasi['password'] = bcrypt($validasi['password']);
        $password1 =  $validasi['confirm_password'] = bcrypt($validasi['confirm_password']);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $password1,


        ]);
        return redirect('/auth')->with('success', 'Berhasil Mendaftar Silahkan Login');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/auth')->with('success', 'Anda Berhasil Logout');
    }
}
