<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oee extends Model
{
    protected $table = 'oees';
    protected $fillable = [
        'ID_ordre',
        'index_disponibilitat',
        'index_rendiment',
        'index_qualitat',
        'index_oee',
        'unitats_defectuoses'
    ];
}

