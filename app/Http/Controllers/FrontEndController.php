<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\Ordre;
use App\Causa;
use App\Qualitat;
use Redirect,Response,DB,Config;
use Yajra\Datatables\Datatables;

class FrontEndController extends Controller
{

    public function index(){
        //desa la referència i la quantitat.
        $ordre = new ordre;
        $ordre->ID_article = request('inputRef');
        $ordre->unitats_produir = request('inputQuantitat');
        $ordre->save();

        return $this->doEditProfile();

    }

    public function afegeixUnitatsDefectuoses()
    {
        //Afegeix la quantitat d'articles defectuosos en la taula corresponent
        if (request('inputQuantitatDefectuoses')==null){
            return back();
        }

        $unitatsDefectuoses=request('inputQuantitatDefectuoses');
        $sumaUnitatsDefectuoses= new qualitat;
        $sumaUnitatsDefectuoses->defectuoses=$unitatsDefectuoses;
        $sumaUnitatsDefectuoses->save();

        return back();
    }

    public function home()
    {
        return view('pages.home');
    }

    public function aturades()
    {
        $llistaAturades = Causa::all()->where('tipus','=',1);
        $llistaAturadesTotals = Causa::all()->where('tipus','=',2);
        return view('pages.pantallaAturades',compact('llistaAturades','llistaAturadesTotals'));
    }
}
