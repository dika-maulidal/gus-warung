<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }

    function formRegister()
    {
        return view('register');
    }

    function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'email wajid disi',
                'password.required' => 'password wajid disi',
            ]
        );

        $email = $request->email;
        $password = $request->password;

        // data untuk login
        $infologin = [
            'email' => $email,
            'password' => $password,
        ];

        if (Auth::attempt($infologin)) {

            // setelah login berhasil, baru ambil email dari database
            $email = Auth::user()->email;

            if (str_ends_with($email, '@admin.com')) {
                return redirect('/admin');

            } else if (str_ends_with($email, '@user.com')) {
                return redirect('/user');

            } else {
                return redirect('/driver');
            }

        } else {
            return redirect('')
                ->back()
                ->withErrors('username dan password salah')
                ->withInput();
        }

    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // REGISTER ACTION
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user,driver',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
    }
}