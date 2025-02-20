<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Personne;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom'     => 'required|string|max:255',
            'prenom'     => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'required|string|min:6|confirmed',
            'birthdate' => 'required|date',
        ]);

        $personne = Personne::where('courriel', $request->email)->first();

        if (!$personne) {
            $personne = Personne::create([
                'nom'      => $request->nom,
                'prenom'   => $request->prenom,
                'courriel' => $request->email,
            ]);
        }

        $existingUser = Utilisateur::where('id', $personne->id)->first();
        if ($existingUser) {
            return redirect()->back()->withErrors(['email' => 'Un compte utilisateur existe déjà avec cet email.']);
        }

        $user = Utilisateur::create([
            'id' => $personne->id,
            'password' => Hash::make($request->password),
            'dateNaiss' => $request->birthdate,
            'role_id' => 2,
        ]);

        $existingContact = Contact::where('id', $personne->id)->first();
        if (!$existingContact) {
            Contact::create([
                'id' => $personne->id,
                'categorie_id' => 1,
            ]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }
}
