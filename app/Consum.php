<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consum extends Model
{
    protected $fillable = [
        'intensitat_R',
        'intensitat_S',
        'intensitat_T',
        'potencia',
        'id_ESP'
    ];
}
