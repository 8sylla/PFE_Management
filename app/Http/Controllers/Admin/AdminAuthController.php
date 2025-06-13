<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        // Applique le middleware 'guest' pour l'admin, sauf pour la déconnexion
        $this->middleware('guest:admin')->except('destroy');
    }
    
    // Affiche le formulaire de connexion
    public function create()
    {
        return view('auth.admin_login');
    }

    // Gère la tentative de connexion
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Les informations de connexion ne correspondent pas.',
        ])->onlyInput('email');
    }

    // Gère la déconnexion
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}