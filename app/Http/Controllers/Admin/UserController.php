<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('enseignant')->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        // Charger toutes les relations pour une vue détaillée
        $user->load('enseignant', 'fiches', 'soutenance', 'documents');
        return view('admin.users.show', compact('user'));
    }
}