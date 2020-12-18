<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class solution extends Model
{
    protected $fillable = [
        'nom',
        'idCve',
        'solution',
        'prerequis',
        'description',
    ];
}
