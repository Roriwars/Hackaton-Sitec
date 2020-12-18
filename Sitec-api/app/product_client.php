<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_client extends Model
{
    protected $fillable = [
        'idClient',
        'idVersion',
    ];
}
