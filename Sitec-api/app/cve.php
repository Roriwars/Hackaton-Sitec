<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cve extends Model
{
    protected $fillable = [
        'id',
        'description',
        'idVersion',
    ];
}
