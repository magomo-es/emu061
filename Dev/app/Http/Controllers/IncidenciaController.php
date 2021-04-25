<?php

namespace App\Http\Controllers;

use App\Models\Sexe;
use App\Models\Recurs;
use App\Models\Usuari;
use App\Models\Afectat;
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
use App\Models\TipusIncidencia;
use Illuminate\Support\Facades\DB;
use App\Models\IncidenciesHasRecursos;
use Illuminate\Database\QueryException;
use App\Models\HlpValoracioHasSimptomes;

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

            $objectsAry = Incidencia::with('tipus_incidencia','alertant','municipi.','usuari','incidencies_has_recursos.afectat','incidencies_has_recursos.recurs')->when( $searchIncidente, function ($query, $searchIncidente) { return $query->where( 'num_incident','=', $searchIncidente ); })
                ->when( $searchTipus, function ($query, $searchTipus) { return $query->where( 'tipus_incidencies_id','=', $searchTipus ); })
                ->when( $searchUsuari, function ($query, $searchUsuari) { return $query->where( 'usuaris_id','=', $searchUsuari ); })
                ->when( $searchMunicipi, function ($query, $searchMunicipi) { return $query->where( 'municipis_id','=', $searchMunicipi ); })
                ->orderBy('data')->orderBy('hora')->paginate(10)->withQueryString();

        } else {

            echo '<script>console.log("index method -> NO srchData")</script>';
            $objectsAry = Incidencia::with('tipus_incidencia','alertant','municipi','usuari','incidencies_has_recursos.afectat','incidencies_has_recursos.recurs')->orderBy('data')->orderBy('hora')->paginate(10);

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
        $destinsAry = Alertant::where('tipus_alertants_id','=','1')->orderBy('cognoms')->orderBy('nom')->get();

        $usuarisAry = Usuari::orderBy('username')->get();

        $tipusalertantAry = TipusAlertant::orderBy('tipus')->get();
        $tipusrecursosAry = TipusRecurs::orderBy('tipus')->get();

        $municipisAry = Municipi::with('comarca','provincia')->orderBy('nom')->get();

        $usuarisAry = Usuari::orderBy('username')->get();

        $recursosAry = Recurs::with('tipus_recurso')->orderBy('codi')->get();

        $sexesAry = Sexe::orderBy('sexe')->get();

        $codisgravetatAry = CodisGravetat::orderBy('codi')->get();
        $codisvaloracionsAry = CodisValoracio::orderBy('codi')->get();

        $vdsvideosAry = VdsVideos::orderBy('title')->get();
        $vdseventsAry = VdsEvents::orderBy('title')->get();
        $vdsplayAry = VdsPlay::orderBy('title')->get();

        $hlpvaloracionsAry = HlpValoracio::orderBy('codi_valoracio')->get();
        $hlpsimptomesAry = HlpSimptomes::orderBy('pregunta')->get();
        $hlpvaloraciohassimptomesAry = HlpValoracioHasSimptomes::orderBy('codi_valoracio')->get();

        return view( 'admin.incidencia.create', compact('tipusAry','alertantsAry','destinsAry','usuarisAry','tipusalertantAry','tipusrecursosAry','municipisAry','usuarisAry','recursosAry','sexesAry','codisgravetatAry','codisvaloracionsAry','vdsvideosAry','vdseventsAry','vdsplayAry','hlpvaloracionsAry','hlpsimptomesAry','hlpvaloraciohassimptomesAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function operator()
    {

        $vdsvideosAry = VdsVideos::orderBy('title')->get();
        $vdseventsAry = VdsEvents::orderBy('title')->get();

        return view( 'operator.index', compact('vdsvideosAry','vdseventsAry') );

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

            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - Almacenar =>

            $saveError = false;

            // - - - - - - - - - - - - - - - - - - - - - alertants
            $objAlertant = new Alertant;
            $objAlertant->id = 0;
            // $objAlertant->id = $request->alertantid;
            $objAlertant->telefon = $request->telefonalertant;
            $objAlertant->nom = $request->alertant_nom;
            $objAlertant->cognoms = $request->alertant_cognoms;
            $objAlertant->adreca = $request->alertant_adreca;
            $objAlertant->municipis_id = $request->alertant_municipisid;
            $objAlertant->tipus_alertants_id = $request->alertant_tipusalertantsid;

            try {

                //if ( !empty($objAlertant->nom) && !empty($objAlertant->cognoms) ) { $objAlertant->save(); }
                $objAlertant->save();

                // - - - - - - - - - - - - - - - - - - - - - incidencies
                $objIncidencia = new Incidencia;
                $objIncidencia->id = 0;
                // $objIncidencia->id = $request->incidenciaid;
                $objIncidencia->num_incident = $request->numincident;
                $objIncidencia->data = $request->data;
                $objIncidencia->hora = $request->hora;
                $objIncidencia->telefon_alertant = $request->telefonalertant;
                $objIncidencia->adreca = $request->adreca;
                $objIncidencia->adreca_complement = $request->adrecacomplement;
                $objIncidencia->descripcio = $request->descripcio;
                $objIncidencia->nom_metge = $request->nommetge;
                $objIncidencia->tipus_incidencies_id = $request->tipusincidenciesid;
                $objIncidencia->alertants_id = $objAlertant->id;
                $objIncidencia->municipis_id = $request->municipisid;
                $objIncidencia->usuaris_id = $request->usuarisid;

                try {

                    $objIncidencia->save();

                    if (!empty($request->afectat)) {

                        for ( $i=0; $i< count($request->afectat); $i++ ) {

                            // - - - - - - - - - - - - - - - - - - - - - afectats
                            $objAfectat = new Afectat;
                            $objAfectat->id = 0;
                            // $objAfectat->id = $request->afectat[$i]['id'];
                            $objAfectat->telefon = $request->afectat[$i]['telefon'];
                            $objAfectat->cip = $request->afectat[$i]['cip'];
                            $objAfectat->nom = $request->afectat[$i]['nom'];
                            $objAfectat->cognoms = $request->afectat[$i]['cognoms'];
                            $objAfectat->edat = $request->afectat[$i]['edat'];
                            // $objAfectat->te_cip = $request->afectat[$i]['te_cip'];
                            $objAfectat->sexes_id = $request->afectat[$i]['sexes_id'];
                            $objAfectat->descripcio = $request->afectat[$i]['descripcio'];
                            // $objAfectat->tipus_recursos_id = $request->afectat[$i]['tipus_rrecursos_id'];
                            $objAfectat->codi_gravetat = $request->afectat[$i]['codi_gravetat'];
                            $objAfectat->codi_valoracio = $request->afectat[$i]['codi_valoracio'];

                            try {

                                $objAfectat->save();

                                // - - - - - - - - - - - - - - - - - - - - - incidencies_has_recursos
                                $objHasRecursos = new IncidenciesHasRecursos;
                                $objHasRecursos->incidencies_id = $objIncidencia->id;
                                $objHasRecursos->recursos_id = $request->afectat[$i]['recursos_id'];
                                $objHasRecursos->afectats_id = $objAfectat->id;
                                $objHasRecursos->hora_activacio = null;
                                $objHasRecursos->hora_mobilitzacio = null;
                                $objHasRecursos->hora_assistencia = null;
                                $objHasRecursos->hora_transport = null;
                                $objHasRecursos->hora_arribada_hospital = null;
                                $objHasRecursos->hora_transferencia = null;
                                $objHasRecursos->hora_finalitzacio = null;
                                $objHasRecursos->prioritat = $request->afectat[$i]['prioritat'];
                                $objHasRecursos->desti = $request->afectat[$i]['desti'];
                                $objHasRecursos->desti_alertant_id = $request->afectat[$i]['desti_alertant_id'];

                                try {

                                    $objHasRecursos->save();

                                } catch( QueryException $ex ) {

                                    $saveError = true;

                                }

                            } catch( QueryException $ex ) {

                                $saveError = true;

                            }

                        }
                    }

                } catch( QueryException $ex ) {

                    $saveError = true;

                }

            } catch( QueryException $ex ) {

                $saveError = true;

            }

            if (!$saveError) {

                DB::commit();

                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [IncidenciaController::class, 'index'] );

            } else {

                DB::rollBack();

                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [IncidenciaController::class, 'create'] )->withInput();

            }

            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - Almacenar //

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

        $objectsAry = Incidencia::with('tipus_incidencia','alertant','municipi','usuari','incidencies_has_recursos.afectat','incidencies_has_recursos.recurs')->orderBy('data')->orderBy('hora')->get($theobj->id);

        $tipusAry = TipusIncidencia::orderBy('tipus')->get();
        $alertantsAry = Alertant::orderBy('cognoms')->orderBy('nom')->get();
        $destinsAry = Alertant::where('tipus_alertants_id','=','1')->orderBy('cognoms')->orderBy('nom')->get();

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

        return view('admin.incidencia.edit', compact('tipusAry','alertantsAry','destinsAry','usuarisAry','tipusalertantAry','tipusrecursosAry','municipisAry','usuarisAry','recursosAry','sexesAry','codisgravetatAry','codisvaloracionsAry','vdsvideosAry','vdseventsAry','vdsplayAry','hlpvaloracionsAry','hlpsimptomesAry','hlpvaloraciohassimptomesAry') );

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
