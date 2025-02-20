<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateur extends Authenticatable
{
    use HasFactory;

    protected $table = 'utilisateurs';
    protected $with = ['personne'];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'unsignedBigInteger';

    protected $fillable = [
        'id',
        'dateNaiss',
        'role_id',
        'password',
        'rememberToken',
    ];

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
