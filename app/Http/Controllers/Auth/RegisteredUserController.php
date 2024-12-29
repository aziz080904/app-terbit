<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    // Validasi input registrasi
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required', 
            'string', 
            'email', 
            'max:255', 
            'unique:users',
            'regex:/@(student\.)?nurulfikri\.ac\.id$/', // Validasi domain email
        ],
    ], [
        'email.regex' => 'Email harus menggunakan akun kampus nurul fikri.',
    ]);

    // Logika menentukan role berdasarkan email
    if (str_contains($request->email, '@student.nurulfikri.ac.id')) {
        $role = 'mahasiswa';
    } else {
        $role = 'dosen';
    }

    // Membuat user baru dengan role yang sesuai
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $role,
    ]);

    // Login otomatis setelah registrasi
    auth()->login($user);

    // Redirect ke halaman dashboard atau yang sesuai
    return redirect('/dashboard');
}
}
