<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Qualitat extends Model
{
    protected $fillable = [
        'defectuoses'
    ];


    // public static function getQualitatsData(){
    //     $value=DB::table('qualitats')->orderBy('id', 'asc')->get();
    //     return $value;
    //   }
}
