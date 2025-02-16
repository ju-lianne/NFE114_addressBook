<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnes extends Model
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
        return $this->belongsTo(Entreprises::class);
    }

    public function contact()
    {
        return $this->hasOne(Contacts::class, 'id', 'id');
    }

    public function utilisateur()
    {
        return $this->hasOne(Utilisateurs::class, 'id', 'id');
    }
}
