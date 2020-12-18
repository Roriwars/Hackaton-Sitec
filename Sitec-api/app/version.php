<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class version extends Model
{
    protected $fillable = [
        'idProduct',
        'version',
    ];
}
