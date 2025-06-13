<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $enseignant = DB::table('enseignants')->get();
        return view('auth.register', compact('enseignant'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'enseignant_id' => 'required|exists:enseignants,id',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:'.User::class,
                // --- AJOUTEZ CETTE LIGNE ---
                'ends_with:@etu.uae.ac.ma,@uae.ac.ma' 
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Ajout de nullable et max size
        ]);

        $imageName = null; // Initialiser à null
        if ($request->hasFile('image')) { // Utiliser hasFile pour plus de sécurité
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images_profil'), $imageName); // Utiliser public_path()
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'enseignant_id' => $request->enseignant_id,
            'password' => Hash::make($request->password),
            "image" => $imageName,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
