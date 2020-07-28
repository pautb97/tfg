<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordre extends Model
{
    protected $fillable = [
        'ID_article',
        'unitats_produir',
        'unitats_produides',
        'frequencia_produccio',
        'unitats_defectuoses'
    ];

    public function Articles(){
        return $this->belongsTo('App\Article');
    }
}
