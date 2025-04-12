<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|min:4|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'kata_sandi' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nama_pengguna' => $request->nama_pengguna,
            'nama_lengkap' => '', // bisa diisi nanti
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->kata_sandi),
            'level_id' => 1,
            'peran' => 'pengguna',
        ]);
        return redirect()->route('login')->with('register_success', true);
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah email sudah terdaftar secara manual (punya google_id null)
            $existingUser = User::where('email', $googleUser->getEmail())->whereNull('google_id')->first();

            if ($existingUser) {
                return redirect()
                    ->route('login')
                    ->withErrors([
                        'google_auth' => 'Email ini sudah terdaftar. Silakan login dengan password Anda.',
                    ]);
            }

            // Lanjutkan proses login Google jika email belum terdaftar manual
            $user = User::firstOrCreate(
                ['google_id' => $googleUser->getId()],
                [
                    'nama_pengguna' => $googleUser->getName(),
                    'nama_lengkap' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'kata_sandi' => bcrypt(Str::random(16)),
                    'google_id' => $googleUser->getId(),
                    'level_id' => 1,
                    'peran' => 'pengguna',
                    'foto' => $googleUser->getAvatar(),
                ],
            );

            Auth::login($user);

            if ($user->peran === 'admin') {
                return redirect()->route('admin.dashboard')->with('login_success', true);
            } else {
                return redirect()->route('pengguna.dashboard')->with('login_success', true);
            }
        } catch (\Exception $e) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'google_auth' => 'Gagal login dengan Google. Silakan coba lagi.',
                ]);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nama_pengguna' => 'required|string',
            'kata_sandi' => 'required|string',
        ]);

        $user = User::where('nama_pengguna', $credentials['nama_pengguna'])->first();

        if (!$user) {
            return back()->withErrors(['auth_failed' => 'Nama pengguna tidak terdaftar']);
        }

        if ($user->google_id) {
            return back()->withErrors(['google_auth' => 'Akun ini hanya bisa login via Google']);
        }

        // Cara 1: Manual check password
        if (Hash::check($credentials['kata_sandi'], $user->kata_sandi)) {
            Auth::login($user, $request->remember);
            $request->session()->regenerate();
            $request->session()->put('login_success', true);

            if ($user->peran === 'admin') {
                return redirect()->route('admin.dashboard')->with('login_success', true);
            } else {
                return redirect()->route('pengguna.dashboard')->with('login_success', true);
            }
        }

        // Cara 2: Atau jika ingin tetap menggunakan attempt()
        // if (Auth::attempt([
        //     'nama_pengguna' => $credentials['nama_pengguna'],
        //     'password' => $credentials['kata_sandi'] // Perhatikan ini menggunakan 'password'
        // ], $request->remember)) {
        //     $request->session()->regenerate();
        //     $request->session()->put('login_success', true);
        //     return back();
        // }

        return back()->withErrors(['auth_failed' => 'Nama pengguna atau kata sandi salah']);
    }

    public function dashboard()
    {
        if (auth()->user()->peran === 'admin') {
            return view('admin.dashboard'); // Pastikan view ini ada
        }

        // Kalau bukan admin, tolak akses
        abort(403, 'Akses ditolak.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('logout', 'Berhasil logout, sampai jumpa lagi!');
    }
}
