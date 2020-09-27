<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Qualitat;
use App\Freque;
use App\Causa;
use App\Esdeveniment;
use App\Lloctreball;
use App\Index;
use App\Ordre;
use App\Article;
use App\Oee;
use App\Consum;
use App\Exceptions\Handler;
use Exception;

class GraficsController extends Controller
{
    public function home()
    {
        try {
            $tempsAnterior= Esdeveniment::whereDate('created_at', Carbon::today())->orderBy('id', 'DESC')->first();
            $tempsAnterior=(Carbon::now()->timestamp)-($tempsAnterior->created_at->timestamp);
            $esdeveniment = new Esdeveniment;
            $esdeveniment->ID_causa = 9;
            $esdeveniment->modul_temps = null ;
            $esdeveniment->maquina_produccio = 0;
            $esdeveniment->save();
        } catch (Exception $e) {
            $esdeveniment = new Esdeveniment;
            $esdeveniment->ID_causa = 1;
            $esdeveniment->modul_temps = 0 ;
            $esdeveniment->maquina_produccio = 0;
            $esdeveniment->save();
        }
        return view('pages.home');
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

    public function aturades()
    {
        $llistaAturades = Causa::all()->where('tipus','=',1);
        $llistaAturadesTotals = Causa::all()->where('tipus','=',2);
        return view('pages.pantallaAturades',compact('llistaAturades','llistaAturadesTotals'));
    }

    public function repren(){

        $tempsAnterior= Esdeveniment::orderBy('id', 'DESC')->first();

        if ($tempsAnterior->ID_causa == 2){ //Comprovar si l'anterior ha sigut pausa per a dinar
            $nouValorId = 3;
        }else{
            $nouValorId = 5;
        }

        $tempsAnterior=(Carbon::now()->timestamp)-($tempsAnterior->created_at->timestamp);

        $esdeveniment = new Esdeveniment;
        $esdeveniment->ID_causa = $nouValorId;
        $esdeveniment->modul_temps = null ;
        $esdeveniment->maquina_produccio = 1;
        $esdeveniment->save();

        $esdeveniment = ($esdeveniment->id)-1;
        $esdevenimentAnterior = Esdeveniment::Find($esdeveniment);
        $esdevenimentAnterior->modul_temps =$tempsAnterior;
        $esdevenimentAnterior->save();
        return redirect()->route('principal');
    }

    public function acabaAturades()
    {
        //aquesta funció agafa l'ultima fila de la taula esdeveniments, calcula el modul de temps
        //i guarda una nova linia esdeveniment amb les dades totals
        $botoAturades = request('botoAturades');
        $botoId = DB::table('causes')->where('causa', $botoAturades)->value('id');
        $tempsAnterior= Esdeveniment::orderBy('id', 'DESC')->first();
        $tempsAnterior=(Carbon::now()->timestamp)-($tempsAnterior->created_at->timestamp);
        $esdeveniment = new Esdeveniment;
        $esdeveniment->ID_causa = $botoId;
        $esdeveniment->modul_temps = null ;
        $esdeveniment->maquina_produccio = 2;
        $esdeveniment->save();
        // //Guardar temps anterior
        $esdeveniment = ($esdeveniment->id)-1;
        $esdevenimentAnterior = Esdeveniment::Find($esdeveniment);
        $esdevenimentAnterior->modul_temps =$tempsAnterior;
        $esdevenimentAnterior->save();

        if ($botoAturades == 'Fi de Lot'){
            return $this->desaOrdre();
        }elseif($botoAturades == 'Fi Jornada Laboral'){
            return $this->desaOee();
        }else{
            return redirect()->route('principal');
        }

    }



    public function desaOee(){

        //Aquesta funcio pren el resultat final del dia i el desa en una línia a la taula OEE
        $collectIndex = Index::orderBy('id', 'desc')->first();
        $collectOrdre = Ordre::orderBy('id', 'desc')->first();
        $collectDefectuoses = Qualitat::orderBy('id', 'desc')->first();
        $Oee = new Oee;
        $Oee->ID_Ordre =$collectOrdre->id;
        $Oee->index_disponibilitat =$collectIndex->Disponibilitat;
        $Oee->index_rendiment=$collectIndex->Rendiment;
        $Oee->index_qualitat=$collectIndex->Qualitat;
        $Oee->index_oee=$collectIndex->OEE;
        $Oee->unitats_defectuoses=$collectDefectuoses->defectuoses;
        $Oee->save();

        return $this->desaOrdre();
    }

    public function desaOrdre(){

        $lloctreballs = Lloctreball::all()->find(1);
        $Ordre = Ordre::orderBy('id', 'desc')->first();
        $createdAtOrdre = $Ordre->created_at;
        $dftestOrdre=Freque::where('created_at','>=',$createdAtOrdre)->get()->SUM('numero_peces_sortint');
        $defectuoses = Qualitat::where('created_at','>=',$createdAtOrdre)->get()->SUM('defectuoses'); //Exemple de com escollir per dia
        $bonesOrdre = Freque::where('created_at','>=',$createdAtOrdre)->get()->SUM('numero_peces');
        $dftestOrdre = $bonesOrdre-$dftestOrdre;
        $defectuosesOrdre = $dftestOrdre + $defectuoses;
        $comptaMitja = Freque::where('created_at','>=',$createdAtOrdre)->get()->where('idESP','==',1)->count();
        $frequenciaOrdre =($bonesOrdre)/($comptaMitja);

        $Ordre->unitats_produides = $bonesOrdre;
        $Ordre->frequencia_produccio=$frequenciaOrdre;
        $Ordre->unitats_defectuoses=$defectuosesOrdre;
        $Ordre->data_hora_final=Carbon::now();
        $Ordre->save();

        return redirect()->route('index');
    }

    public function emplenaOrdrePrimer(){

        //Aquesta funcio comprova que els paràmetres que es passen a la pantalla home són correctes.
        //En el cas de que no ho siguin retorna la mateixa pàgina i si són correctes retorna la pantalla principal

        if (request('inputQuantitat')==null){
            return back()->withError('Quantitat incorrecta')->withInput();
        }
        try {
            $REF = request('inputRef');
            $user = Article::where('referencia','=',$REF)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            return back()->withError('Article incorrecte')->withInput();
        }
        $ordre = new ordre;
        $ordre->ID_article = request('inputRef');
        $ordre->unitats_produir = request('inputQuantitat');
        $ordre->save();

        //Insertar línia inici de lot a taula esdeveniments

        $tempsAnterior= Esdeveniment::orderBy('id', 'DESC')->first();
        $modulTemps=(Carbon::now()->timestamp)-($tempsAnterior->created_at->timestamp);
        $esdevenimentInicial = new Esdeveniment;
        $esdevenimentInicial->ID_causa = 4;
        $esdevenimentInicial->modul_temps = null;
        $esdevenimentInicial->maquina_produccio = 0;
        $esdevenimentInicial->save();
        // //Guardar temps anterior
        $esdevenimentInicial = ($esdevenimentInicial->id)-1;
        $esdevenimentAnterior = Esdeveniment::Find($esdevenimentInicial);
        $esdevenimentAnterior->modul_temps =$modulTemps;
        $esdevenimentAnterior->save();

        return redirect()->route('principal');
    }

    function getAllData(){

        //Prendre l'ultim valor de consum
        $consumActual = Consum::orderBy('id', 'desc')->first();
        $consum=$consumActual->potencia;

        // Adquirir numero d'unitats a produir
        $descripcio = Ordre::orderBy('id', 'desc')->first();
        $unitatsProduir=$descripcio->unitats_produir;
        $createdAtOrdre = $descripcio->created_at;

        //futur control de temps EX: Model::whereBetween('date', [$from, $to])->get();

        //adquirir dades nom d'article i quantitat
        $desde = $descripcio->created_at;
        $finsa = Carbon::now();
        $quantitatAProduir = $descripcio->unitats_produir;
        $descripcio = Article::where('referencia','=',$descripcio->ID_article)->firstOrFail();
        $descripcio = $descripcio->descripcio;

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Automatitzar procés de reconeixement d'aturades i funcionament de la màquina.
        //Revisa si la màquina està produïnt i depèn del cas crea una línia o una altra (passa cada vegada que es refresca la pàgina)
        $llegirFreques = Freque::whereDate('created_at', Carbon::today())->orderBy('id', 'DESC')->first();
        $llegirEsdeveniments = Esdeveniment::whereDate('created_at', Carbon::today())->orderBy('id', 'DESC')->first();

        if($llegirFreques->numero_peces <= 5){
            if ($llegirEsdeveniments->maquina_produccio == 0){
                $emplenaIdCausa = $llegirEsdeveniments -> ID_causa;
                $emplenaMaquinaProduccio = 0;
            }elseif($llegirEsdeveniments->maquina_produccio == 1){
                $emplenaIdCausa = 13;
                $emplenaMaquinaProduccio = 2;
            }elseif($llegirEsdeveniments->maquina_produccio == 2){
                $emplenaIdCausa = $llegirEsdeveniments -> ID_causa;
                $emplenaMaquinaProduccio = 2;
            }
        }elseif($llegirFreques->numero_peces > 5){
            $emplenaIdCausa = 5;
            $emplenaMaquinaProduccio = 1;
        }

        $modulTemps=(Carbon::now()->timestamp)-($llegirEsdeveniments->created_at->timestamp);
        $esdevenimentInicial = new Esdeveniment;
        $esdevenimentInicial->ID_causa = $emplenaIdCausa;
        $esdevenimentInicial->modul_temps = null;
        $esdevenimentInicial->maquina_produccio = $emplenaMaquinaProduccio;
        $esdevenimentInicial->save();
        // //Guardar temps anterior
        $esdevenimentInicial = ($esdevenimentInicial->id)-1;
        $esdevenimentAnterior = Esdeveniment::Find($esdevenimentInicial);
        $esdevenimentAnterior->modul_temps =$modulTemps;
        $esdevenimentAnterior->save();
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //Carregar dades de la llista desplegable
        $causes = Causa::all()->where('mostra_grafic',1);

        //dades pieChart1
        $temps[] = ['ID','Numero'];
        $tempsTotal = Esdeveniment::whereDate('created_at', Carbon::today())->get()->where('ID_causa','!=',2)->SUM('modul_temps');
        $altres = $tempsTotal;

        foreach ($causes as $causa) {
            $tempsIndividual = Esdeveniment::whereDate('created_at', Carbon::today())->get()->where('ID_causa',$causa->id)->SUM('modul_temps');
            $temps[]=[$causa->causa,$tempsIndividual];
            $altres = $altres - $tempsIndividual;
        }
        $temps[] = ['Altres',$altres]; // suma el temps total menys el temps per a dinar
        $temps = json_encode($temps);


        // Dades PieChart2
        $dftestOrdre=Freque::where('created_at','>=',$createdAtOrdre)->get()->SUM('numero_peces_sortint');
        $defectuosesOrdre = Qualitat::where('created_at','>=',$createdAtOrdre)->get()->SUM('defectuoses'); //Exemple de com escollir per dia
        $bonesOrdre = Freque::where('created_at','>=',$createdAtOrdre)->get()->SUM('numero_peces');
        $dftestOrdre = $bonesOrdre-$dftestOrdre;
        $qualitats[] = ['Bones','Defectuoses'];
        $qualitats[] = ['Bones',$bonesOrdre];
        $qualitats[] = ['Defectuoses',$defectuosesOrdre+$dftestOrdre];
        $qualitats[] = ['Peces Restants',($unitatsProduir - $defectuosesOrdre - $dftestOrdre - $bonesOrdre)];
        $qualitats = json_encode($qualitats);

        //Càlcul indexs
        $lloctreballs = Lloctreball::all()->find(1);

       // Gestió colors gauge charts
        $objDisponibilitat = $lloctreballs->obj_Disponibilitat;
        $objRendiment = $lloctreballs->obj_Rendiment;
        $objQualitat = $lloctreballs->obj_Qualitat;
        $objOEE = $lloctreballs->obj_OEE;
        $objDisponibilitat = json_encode($objDisponibilitat);
        $objRendiment = json_encode($objRendiment);
        $objQualitat = json_encode($objQualitat);
        $objOEE = json_encode($objOEE);

        //Qualitat
        $dftest=Freque::whereDate('created_at', Carbon::today())->get()->SUM('numero_peces_sortint');
        $defectuoses = Qualitat::whereDate('created_at', Carbon::today())->get()->SUM('defectuoses'); //Exemple de com escollir per dia
        $bones = Freque::whereDate('created_at', Carbon::today())->get()->SUM('numero_peces');
        $dftest = $bones-$dftest;
        $qualitat = ((($bones)/($bones + $defectuoses + $dftest))*100);
        $qualitat = json_encode($qualitat);

        //Rendiment
        $comptaMitja = Freque::whereDate('created_at', Carbon::today())->get()->where('idESP','==',1)->count();
        $rendiment =((($bones)/($comptaMitja))/($lloctreballs->Velocitat_esperada))*100;
        $rendiment = json_encode($rendiment);

        //Disponibilitat
        $tempsProductiu = Esdeveniment::whereDate('created_at', Carbon::today())->get()->where('ID_causa','==',5)->SUM('modul_temps');
        $tempsDisponible = $tempsTotal;
        $disponibilitat =  ($tempsProductiu/$tempsDisponible)*100; //no sempre funciona com cal
        //dd($tempsProductiu,$tempsDisponible);
        $disponibilitat = json_encode($disponibilitat);

        //Taula històric
        $insertaIndexs = new index;
        $insertaIndexs->OEE = ($disponibilitat/100)*($rendiment/100)*($qualitat/100)*100;
        $insertaIndexs->Disponibilitat=$disponibilitat;
        $insertaIndexs->Rendiment=$rendiment;
        $insertaIndexs->Qualitat=$qualitat;
        $insertaIndexs->save();

        $indexs = Index::whereDate('created_at', Carbon::today())->get();
        $indexsTaula[] = ['Data','OEE','Disponibilitat','Rendiment','Qualitat'];
        foreach ($indexs as $index) {
            $indexsTaula[]=[$index->created_at->toTimeString() ,$index->OEE,$index->Disponibilitat,$index->Rendiment,$index->Qualitat];
        }
        $indexsTaula = json_encode($indexsTaula);

        $activaBoto = json_encode(Esdeveniment::orderBy('id', 'DESC')->first()->maquina_produccio);

        return view('pages.principal',
        compact('qualitats','causes','temps','rendiment','qualitat','disponibilitat','indexsTaula','descripcio','quantitatAProduir','activaBoto','consum','objDisponibilitat','objRendiment','objQualitat','objOEE'));
    }
}
