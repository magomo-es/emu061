<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use Illuminate\Database\QueryException;
use App\Models\Alertant;
use App\Models\Municipi;
use App\Models\TipusAlertant;
use Illuminate\Http\Request;

class AlertantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        echo '<script>console.log("index method ( srchnom: '.$request->input('srchnom').
            ' / srchtelefon: '.$request->input('srchtelefon').
            ' / srchmunicipis: '.$request->input('srchmunicipis').
            ' / srchtipus: '.$request->input('srchtipus').')")</script>';

            // - - - - - search block =>
        $searchTelefon = $request->input('srchtelefon');
        $searchNom = ( $request->input('srchnom') );
        $searchMunicipi = $request->input('srchmunicipis');
        $searchTipus = $request->input('srchtipus');

        if ( $searchTelefon || $searchNom || $searchMunicipi || $searchTipus ) {

            echo '<script>console.log("index method -> with srchData")</script>';

            $objectsAry = Alertant::when( $searchTelefon, function ($query, $searchTelefon) { return $query->where( 'telefon','=', $searchTelefon ); })
                ->when( $searchNom, function ($query, $searchNom) { return $query->where( 'nom','like', '%'.$searchNom.'%' ); })
                ->when( $searchMunicipi, function ($query, $searchMunicipi) { return $query->where( 'municipis_id','=', $searchMunicipi ); })
                ->when( $searchTipus, function ($query, $searchTipus) { return $query->where( 'tipus_alertants_id','=', $searchTipus ); })
                ->orderBy('nom')->paginate(10)->withQueryString();

        } else {

            echo '<script>console.log("index method -> NO srchData")</script>';

            $objectsAry = Alertant::orderBy('nom')->paginate(10);

        }

        $municipisAry = Municipi::orderBy('nom')->get();
        $tipusAry = TipusAlertant::orderBy('tipus')->get();

        $request->session()->flashInput($request->input());

        return view('admin.alertant.index', compact('objectsAry','municipisAry','tipusAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        echo '<script>console.log("create method")</script>';
        $municipisAry = Municipi::orderBy('nom')->get();
        $tipusAry = TipusAlertant::orderBy('tipus')->get();
        return view( 'admin.alertant.create', compact('municipisAry','tipusAry') );

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

        if ( !empty( $request->xtelefon ) && !empty( $request->xadreca ) ) {

            $theobj = new Alertant;

            $theobj->telefon = $request->xtelefon;
            $theobj->nom = $request->xnom;
            $theobj->cognoms = $request->xcognoms;
            $theobj->adreca = $request->xadreca;
            $theobj->municipis_id = $request->xmunicipisid;
            $theobj->tipus_alertants_id = $request->xtipusalertantsid;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [AlertantController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [AlertantController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Telefon i/o Adreça inexistent' );
            $response = redirect()->action( [AlertantController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alertant  $alertants
     * @return \Illuminate\Http\Response
     */
    public function show(Alertant $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alertant  $alertants
     * @return \Illuminate\Http\Response
     */
    public function edit(Alertant $theobj)
    {

        echo '<script>console.log("edit method")</script>';
        $municipisAry = Municipi::orderBy('nom')->get();
        $tipusAry = TipusAlertant::orderBy('tipus')->get();
        return view( 'admin.alertant.edit', compact('theobj','municipisAry','tipusAry') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alertant  $alertants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alertant $theobj)
    {

        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->xtelefon ) && !empty( $request->xadreca ) ) {

            $theobj->telefon = $request->xtelefon;
            $theobj->nom = $request->xnom;
            $theobj->cognoms = $request->xcognoms;
            $theobj->adreca = $request->xadreca;
            $theobj->municipis_id = $request->xmunicipisid;
            $theobj->tipus_alertants_id = $request->xtipusalertantsid;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [AlertantController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $municipisAry = Municipi::orderBy('nom')->get();
                $tipusAry = TipusAlertant::orderBy('tipus')->get();
                $response = redirect()->action( [AlertantController::class, 'edit'], compact('theobj','municipisAry','tipusAry') )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Telefon i/o Adreça inexistent' );
            $municipisAry = Municipi::orderBy('nom')->get();
            $tipusAry = TipusAlertant::orderBy('tipus')->get();
            $response = redirect()->action( [AlertantController::class, 'edit'], compact('theobj','municipisAry','tipusAry') )->withInput();

        }

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alertant  $alertants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Alertant $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [AlertantController::class, 'index'] );
    }
}
