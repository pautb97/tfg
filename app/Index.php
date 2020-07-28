<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    protected $table = 'indexs';
    protected $fillable = [
        'created_at',
        'OEE',
        'Disponibilitat',
        'Rendiment',
        'Qualitat'
    ];
}
