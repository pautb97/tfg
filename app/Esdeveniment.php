<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Esdeveniment extends Model
{
    protected $fillable = [

        'ID_causa',
        'modul_temps',
        'maquina_produccio'

    ];

    public function causa(){
        return $this->belongsTo('App\Causa');
    }
}
