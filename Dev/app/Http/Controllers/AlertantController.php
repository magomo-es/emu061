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

        echo '<script>console.log("index method ('.$request->input('srchfilter1').' / '.$request->input('srchfilter2').')")</script>';
        // - - - - - search block =>
        $searchActive = ($request->input('srchactiu')=='actiu');
        $searchFilter1 = ($request->input('srchfilter1')>0);
        $searchFilter2 = ($request->input('srchfilter2')>0);
        if ( $searchFilter1 && $searchFilter2 ) {
            $objectsAry = Alertant::where('tipus_alertants_id','=', $request->input('srchfilter1'))
                ->where('municipis_id','=', $request->input('srchfilter2'))
                ->orderBy('nom')
                ->paginate(10)
                ->withQueryString();
        } else if ( $searchFilter1 && !$searchFilter2 ) {
            $objectsAry = Alertant::where('tipus_alertants_id','=', $request->input('srchfilter1'))
                ->orderBy('nom')
                ->paginate(10)
                ->withQueryString();
        } else if ( !$searchFilter1 && $searchFilter2 ) {
            $objectsAry = Alertant::where('municipis_id','=', $request->input('srchfilter2'))
                ->orderBy('nom')
                ->paginate(10)
                ->withQueryString();
        } else {
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

        return view( 'admin.alertant.create', [
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

            $theobj = new Alertant;

            $theobj->sigles = $request->xsigles;
            $theobj->nom = $request->xnom;
            $theobj->cicles_id = $request->xciclesid;
            $theobj->actiu = ($request->xactiu==1);

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [CursController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [CursController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );
            // redirecciona si no estan completos los datos
            $response = redirect()->action( [CursController::class, 'create'] )->withInput();

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

        return view('admin.alertant.edit', [
            'theobj'=>$theobj,
            //'cicles'=>Cicle::where('actiu','=', 1)->orderBy('nom')->get(),
            'insert'=>true
            ] );
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

        $isOk = true;

        if ( !empty( $request->xsigles ) && !empty( $request->xnom ) ) {

            $theobj->sigles = $request->xsigles;
            $theobj->nom = $request->xnom;
            $theobj->cicles_id = $request->xciclesid;
            $theobj->actiu = ($request->xactiu==1);

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [CursController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [CursController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );

            $response = redirect()->action( [CursController::class, 'edit'] )->withInput();

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

        return redirect()->action( [CursController::class, 'index'] );
    }
}
