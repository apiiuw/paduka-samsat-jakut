<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function showSignInForm()
    {
        return view('auth.pages.index'); // sesuaikan dengan lokasi file login
    }

    public function signIn(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Redirect sesuai role
            if ($user->role === 'admin') {
                return redirect('/jr/statistik-laporan')->with('success', 'Berhasil masuk sebagai Admin Jasa Raharja.');
            } elseif ($user->role === 'unit laka') {
                return redirect('/unit-laka/statistik-kendaraan')->with('success', 'Berhasil masuk sebagai Unit Laka.');
            } elseif ($user->role === 'surveyor') {
                return redirect('/surveyor/data-survei')->with('success', 'Berhasil masuk sebagai Surveyor.');
            }
        }

        return redirect()->back()->with('error', 'Email atau password salah.');
    }

    public function signOut()
    {
        Auth::logout();
        return redirect()->route('signIn')->with('success', 'Anda keluar dari akun.');
    }
}