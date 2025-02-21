<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;
use App\Models\Personne;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceProvider $authService)
    {
        $this->authService = $authService;
    }

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
        $validatedData = $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'email'     => 'required|email',
            'password'  => 'required|string|min:6|confirmed',
            'birthdate' => 'required|date',
        ]);

        $user = $this->authService->registerUser($validatedData);

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Un compte existe déjà avec cet email.']);
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
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('login')->withErrors(['password' => 'Mot de passe incorrect.']);;
            }
        } else {
            return redirect()->route('register')->withErrors("Cet email n'existe pas. Veuillez vous inscrire.");
        }
        return redirect()->route('dashboard');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('status', 'Déconnexion réussie.');
    }
}
