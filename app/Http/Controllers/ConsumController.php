<?php


namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use App\Consum;
use App\Causa;
use App\Qualitat;
use Redirect,Response,DB,Config;
use Yajra\Datatables\Datatables;

class ConsumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historic = Consum::all();
        $consums = Consum::whereDate('created_at', Carbon::today())->get();
        $consumsTaula[] = ['Data','IR(A)','IS(A)','IT(A)','Potència(W)'];
        foreach ($consums as $consum) {
            $consumsTaula[]=[$consum->created_at->toTimeString() ,$consum->intensitat_R,$consum->intensitat_S,$consum->intensitat_T,$consum->potencia];
        }
        $consumsTaula = json_encode($consumsTaula);
        //dd($consumsTaula);
        return view('pages.historicConsum',compact('historic','consumsTaula'));
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
    public function update(Request $request, Consum $Consum)
    {
        //Funció que controla el botó edit de l'historial
        dd("hola");
        $this->validate($request,[
            'unitats_produir' => 'required',
            'unitats_produides' => 'required',
            'unitats_defectuoses' => 'required',
        ]);

        $Consum->unitats_produir = $request->input('unitats_produir');
        $Consum->unitats_produides = $request->input('unitats_produides');
        $Consum->unitats_defectuoses = $request->input('unitats_defectuoses');
        $Consum->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consum $Consum)
    {
        //Funció que elimina un registre de l'historial
        $Consum->delete();

        return back();
    }
}
