<?php

namespace App\Http\Controllers;

use App\Models\Sexe;
use App\Models\Recurs;
use App\Models\Usuari;
use App\Models\VdsPlay;
use App\Classes\Utility;
use App\Models\Alertant;
use App\Models\Municipi;
use App\Models\VdsEvents;
use App\Models\VdsVideos;
use App\Models\Incidencia;
use App\Models\TipusRecurs;
use App\Models\HlpSimptomes;
use App\Models\HlpValoracio;
use Illuminate\Http\Request;
use App\Models\CodisGravetat;
use App\Models\TipusAlertant;
use App\Models\CodisValoracio;
use App\Models\HlpValoracioHasSimptomes;
use App\Models\TipusIncidencia;
use Illuminate\Database\QueryException;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        echo '<script>console.log("index method ( srchnumincident: '.$request->input('srchnumincident').
        ' / srchtipusincidencia: '.$request->input('srchtipusincidencia').
        ' / srchusuari: '.$request->input('srchusuari').
        ' / srchmunicipi: '.$request->input('srchmunicipi').')")</script>';

        // - - - - - search block =>
        $searchIncidente = $request->input('srchnumincident');
        $searchTipus = ( $request->input('srchtipusincidencia') );
        $searchUsuari = $request->input('srchusuari');
        $searchMunicipi = $request->input('srchmunicipi');

        if ( $searchIncidente || $searchTipus || $searchUsuari || $searchMunicipi ) {

            echo '<script>console.log("index method -> with srchData")</script>';

            $objectsAry = Incidencia::with('tipus_incidencia','alertant','municipi.','usuari','afectats.recursos')->when( $searchIncidente, function ($query, $searchIncidente) { return $query->where( 'num_incident','=', $searchIncidente ); })
                ->when( $searchTipus, function ($query, $searchTipus) { return $query->where( 'tipus_incidencies_id','=', $searchTipus ); })
                ->when( $searchUsuari, function ($query, $searchUsuari) { return $query->where( 'usuaris_id','=', $searchUsuari ); })
                ->when( $searchMunicipi, function ($query, $searchMunicipi) { return $query->where( 'municipis_id','=', $searchMunicipi ); })
                ->orderBy('data')->orderBy('hora')->paginate(10)->withQueryString();

        } else {

            echo '<script>console.log("index method -> NO srchData")</script>';
            $objectsAry = Incidencia::with(['tipus_incidencia','alertant','municipi','usuari','afectats.recursos'])->orderBy('data')->orderBy('hora')->paginate(10);

        }

        $request->session()->flashInput($request->input());

        $tipusAry = TipusIncidencia::orderBy('tipus')->get();
        $alertantsAry = Alertant::orderBy('cognoms')->orderBy('nom')->get();
        $municipisAry = Municipi::orderBy('nom')->get();
        $usuarisAry = Usuari::orderBy('username')->get();

        return view('admin.incidencia.index', compact('objectsAry','tipusAry','alertantsAry','municipisAry','usuarisAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        echo '<script>console.log("create method")</script>';
        $tipusAry = TipusIncidencia::orderBy('tipus')->get();
        $alertantsAry = Alertant::orderBy('cognoms')->orderBy('nom')->get();

        $usuarisAry = Usuari::orderBy('username')->get();

        $tipusalertantAry = TipusAlertant::orderBy('tipus')->get();
        $tipusrecursosAry = TipusRecurs::orderBy('tipus')->get();

        $municipisAry = Municipi::with('comarca','provincia')->orderBy('nom')->get();

        $usuarisAry = Usuari::orderBy('username')->get();

        $recursosAry = Recurs::orderBy('codi')->get();

        $sexesAry = Sexe::orderBy('sexe')->get();

        $codisgravetatAry = CodisGravetat::orderBy('codi')->get();
        $codisvaloracionsAry = CodisValoracio::orderBy('codi')->get();

        $vdsvideosAry = VdsVideos::orderBy('title')->get();
        $vdseventsAry = VdsEvents::orderBy('title')->get();
        $vdsplayAry = VdsPlay::orderBy('title')->get();

        $hlpvaloracionsAry = HlpValoracio::orderBy('codi_valoracio')->get();
        $hlpsimptomesAry = HlpSimptomes::orderBy('pregunta')->get();
        $hlpvaloraciohassimptomesAry = HlpValoracioHasSimptomes::orderBy('codi_valoracio')->get();

        return view( 'admin.incidencia.create', compact('tipusAry','alertantsAry','usuarisAry','tipusalertantAry','tipusrecursosAry','municipisAry','usuarisAry','recursosAry','sexesAry','codisgravetatAry','codisvaloracionsAry','vdsvideosAry','vdseventsAry','vdsplayAry','hlpvaloracionsAry','hlpsimptomesAry','hlpvaloraciohassimptomesAry') );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->numincident )
            && !empty( $request->data )
            && !empty( $request->hora )
            && !empty( $request->telefonalertant )
            && !empty( $request->descripcio ) ) {

            $theobj = new Incidencia;

            $theobj->num_incident = $request->numincident;
            $theobj->data = $request->data;
            $theobj->hora = $request->hora;
            $theobj->telefon_alertant = $request->telefonalertant;
            $theobj->adreca = $request->adreca;
            $theobj->adreca_complement = $request->adrecacomplement;
            $theobj->descripcio = $request->descripcio;
            $theobj->nom_metge = $request->nommetge;
            $theobj->tipus_incidencies_id = $request->tipusincidenciesid;
            $theobj->alertants_id = $request->alertantsid;
            $theobj->municipis_id = $request->municipisid;
            $theobj->usuaris_id = $request->usuarisid;




/*
numincident=2&

data=2021-04-14&

hora=06%3A20&

telefonalertant=&

adreca=Rosario+del+Ramirro+1%2C+2%2C+3&

adrecacomplement=Bariio&

municipisid=93&

descripcio=Esta+descripcio+en+medio+tata&

nommetge=Gomezrius&

tipusincidenciesid=4&usuarisid=5&

afectat%5B0%5D%5Bid%5D=&
afectat%5B0%5D%5Bnom%5D=&
afectat%5B0%5D%5Bcognoms%5D=&
afectat%5B0%5D%5Bcip%5D=&
afectat%5B0%5D%5Btelefon%5D=&
afectat%5B0%5D%5Bedat%5D=&
afectat%5B0%5D%5Bsexe%5D=&
afectat%5B0%5D%5Bdescripcio%5D=&
afectat%5B0%5D%5Btipus_recursos_id%5D=&
afectat%5B0%5D%5Bcodi_gravetat%5D=&
afectat%5B0%5D%5Bcodi_valoracio%5D=&

afectat%5B1%5D%5Bid%5D=&
afectat%5B1%5D%5Bnom%5D=&
afectat%5B1%5D%5Bcognoms%5D=&
afectat%5B1%5D%5Bcip%5D=&
afectat%5B1%5D%5Btelefon%5D=&
afectat%5B1%5D%5Bedat%5D=&
afectat%5B1%5D%5Bsexe%5D=&
afectat%5B1%5D%5Bdescripcio%5D=&
afectat%5B1%5D%5Btipus_recursos_id%5D=&
afectat%5B1%5D%5Bcodi_gravetat%5D=&
afectat%5B1%5D%5Bcodi_valoracio%5D=&

alertant_nom=Marcelo+E&
alertant_cognoms=Goncales&
alertant_adreca=Pinciruci&
alertant_municipisid=91&
alertant_tipusalertantsid=3
*/













            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [IncidenciaController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [IncidenciaController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'incidente, Data, Hora, Telefon Alertant i/o Descripció inexistent' );
            $response = redirect()->action( [IncidenciaController::class, 'create'] )->withInput();

        }

        return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencia $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function edit(Incidencia $theobj)
    {

        echo '<script>console.log("edit method")</script>';

        $objectsAry = Incidencia::with(['tipus_incidencia','alertant','municipi','usuari','afectats.recursos'])->orderBy('data')->orderBy('hora')->get($theobj->id);

        $tipusAry = TipusIncidencia::orderBy('tipus')->get();
        $alertantsAry = Alertant::orderBy('cognoms')->orderBy('nom')->get();

        $usuarisAry = Usuari::orderBy('username')->get();

        $tipusalertantAry = TipusAlertant::orderBy('tipus')->get();
        $tipusrecursosAry = TipusRecurs::orderBy('tipus')->get();

        $municipisAry = Municipi::with('comarca','provincia')->orderBy('nom')->get();

        $usuarisAry = Usuari::orderBy('username')->get();

        $recursosAry = Recurs::orderBy('codi')->get();

        $sexesAry = Sexe::orderBy('sexe')->get();

        $codisgravetatAry = CodisGravetat::orderBy('codi')->get();
        $codisvaloracionsAry = CodisValoracio::orderBy('codi')->get();

        $vdsvideosAry = VdsVideos::orderBy('title')->get();
        $vdseventsAry = VdsEvents::orderBy('title')->get();
        $vdsplayAry = VdsPlay::orderBy('title')->get();

        $hlpvaloracionsAry = HlpValoracio::orderBy('codi_valoracio')->get();
        $hlpsimptomesAry = HlpSimptomes::orderBy('pregunta')->get();
        $hlpvaloraciohassimptomesAry = HlpValoracioHasSimptomes::orderBy('codi_valoracio')->get();

        return view('admin.incidencia.edit', compact('tipusAry','alertantsAry','usuarisAry','tipusalertantAry','tipusrecursosAry','municipisAry','usuarisAry','recursosAry','sexesAry','codisgravetatAry','codisvaloracionsAry','vdsvideosAry','vdseventsAry','vdsplayAry','hlpvaloracionsAry','hlpsimptomesAry','hlpvaloraciohassimptomesAry') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidencia  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidencia $theobj)
    {

        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->xnumincident )
            && !empty( $request->xdata )
            && !empty( $request->xhora )
            && !empty( $request->xtelefonalertant )
            && !empty( $request->xdescripcio ) ) {

            $theobj->num_incident = $request->xnumincident;
            $theobj->data = $request->xdata;
            $theobj->hora = $request->xhora;
            $theobj->telefon_alertant = $request->xtelefonalertant;
            $theobj->adreca = $request->xadreca;
            $theobj->adreca_complement = $request->xadrecacomplement;
            $theobj->descripcio = $request->xdescripcio;
            $theobj->nom_metge = $request->xnommetge;
            $theobj->tipus_incidencies_id = $request->xtipusincidenciesid;
            $theobj->alertants_id = $request->xalertantsid;
            $theobj->municipis_id = $request->xmunicipisid;
            $theobj->usuaris_id = $request->xusuarisid;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [IncidenciaController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $tipusAry = TipusIncidencia::orderBy('tipus')->get();
                $alertantsAry = Alertant::orderBy('cognoms')->orderBy('nom')->get();
                $municipisAry = Municipi::orderBy('nom')->get();
                $usuarisAry = Usuari::orderBy('username')->get();
                $response = redirect()->action( [IncidenciaController::class, 'edit'], compact('theobj','tipusAry','alertantsAry','municipisAry','usuarisAry') )->withInput();
            }

        } else {

            $request->session()->flash('error', 'incidente, Data, Hora, Telefon Alertant i/o Descripció inexistent' );
            $tipusAry = TipusIncidencia::orderBy('tipus')->get();
            $alertantsAry = Alertant::orderBy('cognoms')->orderBy('nom')->get();
            $municipisAry = Municipi::orderBy('nom')->get();
            $usuarisAry = Usuari::orderBy('username')->get();
            $response = redirect()->action( [IncidenciaController::class, 'edit'], compact('theobj','tipusAry','alertantsAry','municipisAry','usuarisAry') )->withInput();

        }

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidencia  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Incidencia $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [IncidenciaController::class, 'index'] );

    }
}
