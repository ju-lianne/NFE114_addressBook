<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
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
        return $this->belongsTo(Personnes::class, 'id', 'id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categories::class);
    }
}
