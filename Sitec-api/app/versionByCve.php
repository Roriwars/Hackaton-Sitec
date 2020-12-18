<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class versionByCve extends Model
{
    protected $fillable = [
        'idCve',
        'idVersion',
    ];
}
