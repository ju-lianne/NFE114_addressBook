<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Favoris extends Pivot
{
    protected $table = 'favoris';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'utilisateur_id',
        'contact_id',
    ];
}
