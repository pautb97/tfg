<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freque extends Model
{
    protected $fillable = [
        'numero_peces',
        'numero_peces_sortint',
        'idESP'
    ];
}
