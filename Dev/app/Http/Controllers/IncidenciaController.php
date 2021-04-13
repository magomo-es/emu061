<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use App\Classes\Utility;
use App\Models\Alertant;
use App\Models\Municipi;
use App\Models\Incidencia;
use Illuminate\Http\Request;
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
        $municipisAry = Municipi::orderBy('nom')->get();
        $usuarisAry = Usuari::orderBy('username')->get();
        return view( 'admin.incidencia.create', compact('tipusAry','alertantsAry','municipisAry','usuarisAry') );

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

        if ( !empty( $request->xnumincident )
            && !empty( $request->xdata )
            && !empty( $request->xhora )
            && !empty( $request->xtelefonalertant )
            && !empty( $request->xdescripcio ) ) {

            $theobj = new Incidencia;

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
        $tipusAry = TipusIncidencia::orderBy('tipus')->get();
        $alertantsAry = Alertant::orderBy('cognoms')->orderBy('nom')->get();
        $municipisAry = Municipi::with(['comarca'])->with(['provincia'])->orderBy('nom')->get();
        $usuarisAry = Usuari::orderBy('username')->get();






        //echo '<script>console.log("edit method -> $theobj->tipus_incidencia()->tipus: '.json_encode($theobj,true).'")</script>';
        //$alertantsAry = Alertant::with(['tipus_alertants'])->orderBy('cognoms')->orderBy('nom')->get();





        return view('admin.incidencia.edit', compact('theobj','tipusAry','alertantsAry','municipisAry','usuarisAry') );

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
