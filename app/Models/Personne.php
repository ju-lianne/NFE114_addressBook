<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;

    protected $table = 'personnes';

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'courriel',
        'entreprise_id',
    ];

    public function entreprise()
    {
        // Une personne peut (optionnellement) appartenir à une entreprise
        return $this->belongsTo(Entreprise::class);
    }

    public function contact()
    {
        return $this->hasOne(Contact::class, 'id', 'id');
    }

    public function utilisateur()
    {
        return $this->hasOne(Utilisateur::class, 'id', 'id');
    }
}
