<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = 'utilisateurs';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'unsignedBigInteger';

    protected $fillable = [
        'id',
        'dateNaiss',
        'role_id',
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
