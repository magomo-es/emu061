<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use Illuminate\Database\QueryException;
use App\Models\TipusIncidencia;
use Illuminate\Http\Request;

class TipusIncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // - - - - - search block =>
        /*$searchActive = ($request->input('srchactiu')=='actiu');
        $searchCicle = ($request->input('srchcicle')>0);
        if ( $searchActive && $searchCicle ) {
            $cursos = TipusIncidencia::where('actiu','=', 1)->where('cicles_id','=', $request->input('srchcicle'))->orderBy('nom')->paginate(6)->withQueryString();
        } else if ( $searchActive && !$searchCicle ) {
            $cursos = TipusIncidencia::where('actiu','=', 1)->orderBy('nom')->paginate(6)->withQueryString();
        } else if ( !$searchActive && $searchCicle ) {
            $cursos = TipusIncidencia::where('cicles_id','=', $request->input('srchcicle'))->orderBy('nom')->paginate(6)->withQueryString();
        } else {
            $cursos = TipusIncidencia::orderBy('nom')->paginate(5);
        }
        //$cicles = Cicle::where('actiu','=', 1)->orderBy('nom')->get();
        */

        $objectsAry = TipusIncidencia::orderBy('tipus')->paginate(10);

        $request->session()->flashInput($request->input());

        return view('admin.tipusincidencia.index', compact('objectsAry') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<script>console.log("create method")</script>';

        return view( 'admin.tipusincidencia.create', [
            //'cicles'=>Cicle::where('actiu','=', 1)->orderBy('nom')->get(),
            'insert'=>true
            ] );

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

        $isOk = true;

        if ( !empty( $request->xsigles ) && !empty( $request->xnom ) ) {

            $theobj = new TipusIncidencia;

            $theobj->sigles = $request->xsigles;
            $theobj->nom = $request->xnom;
            $theobj->cicles_id = $request->xciclesid;
            $theobj->actiu = ($request->xactiu==1);

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [TipusIncidenciaController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [TipusIncidenciaController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );
            // redirecciona si no estan completos los datos
            $response = redirect()->action( [TipusIncidenciaController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipusIncidencia  $tipus_incidencies
     * @return \Illuminate\Http\Response
     */
    public function show(TipusIncidencia $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipusIncidencia  $tipus_incidencies
     * @return \Illuminate\Http\Response
     */
    public function edit(TipusIncidencia $theobj)
    {
        echo '<script>console.log("edit method")</script>';

        return view('admin.tipusincidencia.edit', [
            'theobj'=>$theobj,
            //'cicles'=>Cicle::where('actiu','=', 1)->orderBy('nom')->get(),
            'insert'=>true
            ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipusIncidencia  $tipus_incidencies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipusIncidencia $theobj)
    {
        echo '<script>console.log("store method")</script>';

        $isOk = true;

        if ( !empty( $request->xsigles ) && !empty( $request->xnom ) ) {

            $theobj->sigles = $request->xsigles;
            $theobj->nom = $request->xnom;
            $theobj->cicles_id = $request->xciclesid;
            $theobj->actiu = ($request->xactiu==1);

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [TipusIncidenciaController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [TipusIncidenciaController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );

            $response = redirect()->action( [TipusIncidenciaController::class, 'edit'] )->withInput();

        }

        return $response;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipusIncidencia  $tipus_incidencies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TipusIncidencia $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [TipusIncidenciaController::class, 'index'] );
    }
}
