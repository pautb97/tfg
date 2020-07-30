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

class GraficsController extends Controller
{

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
        $esdeveniment->modul_temps = $tempsAnterior ;
        $esdeveniment->maquina_produccio = 0;
        $esdeveniment->save();

        if ($botoAturades == 'Fi de Lot'){
            return view('pages.home');
        }elseif($botoAturades == 'Fi Jornada Laboral'){
            return $this->desaOee();
        }else{
            return $this->getAllData();
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

        return view('pages.home');
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
        dd($modulTemps,Carbon::now()->timestamp,$tempsAnterior->created_at->timestamp);
        $esdevenimentInicial = new Esdeveniment;
        $esdevenimentInicial->ID_causa = 4;
        $esdevenimentInicial->modul_temps = $modulTemps ;
        $esdevenimentInicial->maquina_produccio = 0;
        $esdevenimentInicial->save();
        return $this->getAllData();
    }

    function getAllData(){

        //Controlador que gestiona el funcionament de la pantalla principal.
        $descripcio = Ordre::orderBy('id', 'desc')->first();
        $unitatsProduir=$descripcio->unitats_produir;

        //futur control de temps EX: Model::whereBetween('date', [$from, $to])->get();
        $desde = $descripcio->created_at;
        $finsa = Carbon::now();
        $quantitatAProduir = $descripcio->unitats_produir;
        $descripcio = Article::where('referencia','=',$descripcio->ID_article)->firstOrFail();
        $descripcio = $descripcio->descripcio;

        //Carregar dades de la llista desplegable
        $causes = Causa::all();

        //dades pieChart1
        $temps[] = ['ID','Numero'];
        foreach ($causes as $causa) {
            $tempsIndividual = Esdeveniment::all()->where('ID_causa',$causa->id)->SUM('modul_temps');
            $temps[]=[$causa->causa,$tempsIndividual];
        }
        $temps = json_encode($temps);

        // Aquest codi opera amb les dades del model

        $dftest=Freque::whereDate('created_at', Carbon::today())->get()->SUM('numero_peces_sortint');
        $defectuoses = Qualitat::whereDate('created_at', Carbon::today())->get()->SUM('defectuoses'); //Exemple de com escollir per dia
        $bones = Freque::whereDate('created_at', Carbon::today())->get()->SUM('numero_peces');
        $dftest = $bones-$dftest;
        $qualitats[] = ['Bones','Defectuoses'];
        $qualitats[] = ['Bones',$bones];
        $qualitats[] = ['Defectuoses',$defectuoses+$dftest];
        $qualitats[] = ['Peces Restants',($unitatsProduir - $defectuoses - $dftest - $bones)];
        $qualitats = json_encode($qualitats);


        //Càlcul indexs
        $lloctreballs = Lloctreball::all()->find(1);

        //Rendiment
        $comptaMitja = Freque::whereDate('created_at', Carbon::today())->get()->where('idESP','==',1)->count();
        $rendiment =((($bones)/($comptaMitja))/($lloctreballs->Velocitat_esperada))*100;
        $rendiment = json_encode($rendiment);

        //Qualitat
        $qualitat = (($bones)/($bones + $defectuoses)*100);
        $qualitat = json_encode($qualitat);

        //Disponibilitat
        $tempsProductiu = Esdeveniment::whereDate('created_at', Carbon::today())->get()->where('maquina_produccio','==',1)->SUM('modul_temps');
        $tempsDisponible = Lloctreball::first()->Temps_Disponible;//Canviar per lloctreballs->Temps disponible
        $disponibilitat =  ($tempsProductiu/$tempsDisponible)*100;
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

        $activaBoto = Esdeveniment::orderBy('id', 'DESC')->first()->maquina_produccio;

        return view('pages.principal',
        compact('qualitats','causes','temps','rendiment','qualitat','disponibilitat','indexsTaula','descripcio','quantitatAProduir','activaBoto')); //,
    }
}
