<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [ // On utilise la vue universelle
            'user' => Auth::guard('admin')->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email,' . $user->id],
        ]);

        $user->fill($validated)->save();

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::guard('admin')->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password:admin'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user->update(['password' => Hash::make($validated['password'])]);

        return back()->with('success', 'Mot de passe mis à jour avec succès.');
    }
}