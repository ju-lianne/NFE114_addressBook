<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'unsignedBigInteger';

    protected $fillable = [
        'id',
        'categorie_id',
    ];

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id', 'id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
