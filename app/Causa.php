<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Causa extends Model


{
    protected $table = 'causes';
    protected $fillable = [
        'causa',
        'tipus',
        'mostra_grafic'
    ];

    public function Esdeveniments(){
        return $this->hasMany('App\Esdeveniment');
    }
}
