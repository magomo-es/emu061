<?php

namespace App\Http\Controllers;

use App\Models\Sexe;
use App\Models\Afectat;
use App\Classes\Utility;
use App\Models\TipusRecurs;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class AfectatController extends Controller
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
            ' / srchcip: '.$request->input('srchcip').')")</script>';

            // - - - - - search block =>
        $searchTelefon = $request->input('srchtelefon');
        $searchNom = ( $request->input('srchnom') );
        $searchCIP = $request->input('srchcip');

        if ( $searchTelefon || $searchNom || $searchCIP ) {

            echo '<script>console.log("index method -> with srchData")</script>';

            $objectsAry = Afectat::when( $searchTelefon, function ($query, $searchTelefon) { return $query->where( 'telefon','=', $searchTelefon ); })
                ->when( $searchNom, function ($query, $searchNom) { return $query->where( 'nom','like', '%'.$searchNom.'%' )->orwhere( 'cognom','like', '%'.$searchNom.'%' ); })
                ->when( $searchCIP, function ($query, $searchCIP) { return $query->where( 'municipis_id','=', $searchCIP ); })
                ->orderBy('nom')->paginate(10)->withQueryString();

        } else {

            echo '<script>console.log("index method -> NO srchData")</script>';
            $objectsAry = Afectat::orderBy('nom')->paginate(10);

        }

        $request->session()->flashInput($request->input());

        $sexesAry = Sexe::orderBy('sexe')->get();
        $tipusrecursosAry = TipusRecurs::orderBy('tipus')->get();

        return view('admin.afectat.index', compact('objectsAry','sexesAry','tipusrecursosAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<script>console.log("create method")</script>';
        $sexesAry = Sexe::orderBy('sexe')->get();
        $tipusrecursosAry = TipusRecurs::orderBy('tipus')->get();
        return view( 'admin.afectat.create', compact('sexesAry','tipusrecursosAry') );

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

        $theobj = new Afectat;

        $theobj->telefon = $request->xtelefon;
        $theobj->cip = $request->xcip;
        $theobj->nom = $request->xnom;
        $theobj->cognoms = $request->xcognoms;
        $theobj->edat = $request->xedat;
        $theobj->te_cip = $request->xtecip;
        $theobj->sexes_id = $request->xsexesid;
        $theobj->descripcio = $request->xdescripcio;
        $theobj->tipus_recursos_id = $request->xtipusrecursosid;

        try {
            $theobj->save();
            $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
            $response = redirect()->action( [AfectatController::class, 'index'] );
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $request->session()->flash('error', $mensaje );
            $response = redirect()->action( [AfectatController::class, 'create'] )->withInput();
        }

        return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Afectat  $afectats
     * @return \Illuminate\Http\Response
     */
    public function show(Afectat $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Afectat  $afectats
     * @return \Illuminate\Http\Response
     */
    public function edit(Afectat $theobj)
    {

        echo '<script>console.log("edit method")</script>';
        $sexesAry = Sexe::orderBy('sexe')->get();
        $tipusrecursosAry = TipusRecurs::orderBy('tipus')->get();
        return view('admin.afectat.edit', compact('theobj','sexesAry','tipusrecursosAry') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Afectat  $afectats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Afectat $theobj)
    {

        echo '<script>console.log("store method")</script>';

        $theobj->telefon = $request->xtelefon;
        $theobj->cip = $request->xcip;
        $theobj->nom = $request->xnom;
        $theobj->cognoms = $request->xcognoms;
        $theobj->edat = $request->xedat;
        $theobj->te_cip = $request->xtecip;
        $theobj->sexes_id = $request->xsexesid;
        $theobj->descripcio = $request->xdescripcio;
        $theobj->tipus_recursos_id = $request->xtipusrecursosid;

        try {
            $theobj->save();
            $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
            $response = redirect()->action( [AfectatController::class, 'index'] );
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $request->session()->flash('error', $mensaje );
            $sexesAry = Sexe::orderBy('sexe')->get();
            $tipusrecursosAry = TipusRecurs::orderBy('tipus')->get();
            $response = redirect()->action( [AfectatController::class, 'edit'], compact('theobj','sexesAry','tipusrecursosAry') )->withInput();
        }

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Afectat  $afectats
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Afectat $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [AfectatController::class, 'index'] );
    }
}
