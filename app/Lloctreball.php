<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lloctreball extends Model
{
    protected $fillable = [

        'Temps_Disponible',
        'Descripcio',
        'Velocitat_esperada',
        'Temps_lectura',
        'obj_OEE',
        'obj_Disponibilitat',
        'obj_Rendiment',
        'obj_Qualitat'


    ];
}
