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

    public function showLoginForm()
    {
        return view('auth.login');
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
                'telephone' => $request->phone,
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

        return redirect()->route('dashboard');
    }

    public function login(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $personne = Personne::where('courriel', $request->email)->first();

        if($personne) {
            $existingUser = Utilisateur::where('id', $personne->id)->first();
            if ($existingUser && Hash::check($request->password, $existingUser->password)) {
                Auth::login($existingUser);
                dd(Auth::check(), Auth::user());
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('login')->withErrors(['password' => 'Mot de passe incorrect.']);;
            }
        } else {
            return redirect()->route('register')->withErrors("Cet email n'existe pas. Veuillez vous inscrire.");
        }
        return redirect()->route('dashboard');
    }
}
