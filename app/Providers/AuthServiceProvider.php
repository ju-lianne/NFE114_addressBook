<?php

namespace App\Providers;
use App\Models\Utilisateur;
use App\Models\Personne;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;


class AuthServiceProvider
{
    public function registerUser(array $data)
    {
        $personne = Personne::where('courriel', $data['email'])->first();

        if (!$personne) {
            $personne = Personne::create([
                'nom'       => $data['nom'],
                'prenom'    => $data['prenom'],
                'courriel'  => $data['email'],
                'telephone' => $data['phone'] ?? null,
            ]);
        }

        if (Utilisateur::where('id', $personne->id)->exists()) {
            return null; // L'utilisateur existe déjà
        }

        $user = Utilisateur::create([
            'id'       => $personne->id,
            'password' => Hash::make($data['password']),
            'dateNaiss' => $data['birthdate'],
            'role_id'  => 2,
        ]);

        if (!Contact::where('id', $personne->id)->exists()) {
            Contact::create([
                'id'          => $personne->id,
                'categorie_id' => 1,
            ]);
        }

        return $user;
    }
}
