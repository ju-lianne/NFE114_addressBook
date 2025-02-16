<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateurs extends Model
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
        return $this->belongsTo(Personnes::class, 'id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Roles::class);
    }
}
