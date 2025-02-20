<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Auth;

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

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = $this->authService->authenticateUser($validatedData);

        if (!$user) {
            return redirect()->route('login')->withErrors(['password' => 'Identifiants incorrects.']);
        }

        Auth::login($user);
        return redirect()->route('dashboard');
    }
}
