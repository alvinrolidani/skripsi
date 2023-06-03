<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Dashboard',
            'user' => auth()->user()
        ];
        return view('admin.dashboard.index', $data);
    }
    public function profil()
    {

        $data = [
            'title' => 'Profil'
        ];
        $user = User::where('username', auth()->user()->username)->first();
        // dd($user);
        return view('admin.profil.index', compact('user'), $data);
    }
    public function update(Request $request)
    {

        // dd($request->all());
        // return  $request->file('gambar')->store('user');

        $validasi = $request->validate(
            [
                'username' => 'required|max:255|unique:users,username,' . auth()->user()->id,
                'name' => 'required|max:255',
                'image' => 'image|file|max:2048',


            ],
            [
                'username.unique' => 'Username Sudah Digunakan, gunakan username lain!',
                'username.required' => 'Harap Masukkan Username!',
                'name.required' => 'Harap Masukkan Nama!',
                'image.image' => 'Harap masukkan gambar yang valid',
                'image.max' => 'Gambar maksimal 2MB'

            ]
        );
        // dd($request->file('gambar'));
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validasi['image'] = $request->file('image')->store('profil');
        }

        // dd($validasi['gambar']);
        User::where('id', auth()->user()->id)->update($validasi);
        return redirect()->back()->with('toast_success', 'Profil berhasil diubah');
    }
}
