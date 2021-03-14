<?php

namespace App\Http\Controllers;

use App\Models\Comarca;
use App\Classes\Utility;
use App\Models\Municipi;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MunicipiController extends Controller
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
        $searchFilter1 = ($request->input('srchfilter1')>0);
        if ( $searchFilter1 ) {
            $objectsAry = Municipi::where('comarques_id','=', $request->input('srchfilter1'))
                ->orderBy('nom')
                ->paginate(10)
                ->withQueryString();
        } else {
            $objectsAry = Municipi::orderBy('nom')->paginate(10);
        }

        $comarquesAry = Comarca::orderBy('nom')->get();

        $provinciesAry = Provincia::get();

        $request->session()->flashInput($request->input());

        return view('admin.municipi.index', compact('objectsAry','comarquesAry','provinciesAry') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<script>console.log("create method")</script>';

        return view( 'admin.municipi.create', [
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

            $theobj = new Municipi;

            $theobj->sigles = $request->xsigles;
            $theobj->nom = $request->xnom;
            $theobj->cicles_id = $request->xciclesid;
            $theobj->actiu = ($request->xactiu==1);

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [MunicipiController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [MunicipiController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );
            // redirecciona si no estan completos los datos
            $response = redirect()->action( [MunicipiController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Municipi  $municipis
     * @return \Illuminate\Http\Response
     */
    public function show(Municipi $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Municipi  $municipis
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipi $theobj)
    {
        echo '<script>console.log("edit method")</script>';

        return view('admin.municipi.edit', [
            'theobj'=>$theobj,
            //'cicles'=>Cicle::where('actiu','=', 1)->orderBy('nom')->get(),
            'insert'=>true
            ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Municipi  $municipis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipi $theobj)
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
                $response = redirect()->action( [MunicipiController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [MunicipiController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );

            $response = redirect()->action( [MunicipiController::class, 'edit'] )->withInput();

        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Municipi  $municipis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Municipi $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [MunicipiController::class, 'index'] );
    }
}
