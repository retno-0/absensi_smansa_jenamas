<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = DB::table('users')
            ->where('username', $request->username)
            ->first();

        if (!$user || $request->password !== $user->password) {
            return back()
                ->withErrors([
                    'username' => 'Username atau password salah.'
                ])
                ->onlyInput('username');
        }

        Auth::loginUsingId($user->id);

        $request->session()->regenerate();

        if ($user->role === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        if ($user->role === 'guru') {
            return redirect()->route('guru.absensi');
        }

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        Auth::logout();

        return redirect()->route('login')
            ->withErrors([
                'username' => 'Role akun tidak dikenali.'
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
