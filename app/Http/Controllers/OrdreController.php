<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\Ordre;
use App\Causa;
use App\Qualitat;
use Redirect,Response,DB,Config;
use Yajra\Datatables\Datatables;

class OrdreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historic = Ordre::all();
        return view('pages.historic',compact('historic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordre $ordre)
    {
        //Funció que controla el botó edit de l'historial
        dd("hola");
        $this->validate($request,[
            'unitats_produir' => 'required',
            'unitats_produides' => 'required',
            'unitats_defectuoses' => 'required',
        ]);

        $ordre->unitats_produir = $request->input('unitats_produir');
        $ordre->unitats_produides = $request->input('unitats_produides');
        $ordre->unitats_defectuoses = $request->input('unitats_defectuoses');
        $ordre->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordre $ordre)
    {
        //Funció que elimina un registre de l'historial
        $ordre->delete();

        return back();
    }
}
