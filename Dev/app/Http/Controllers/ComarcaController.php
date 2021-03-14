<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use Illuminate\Database\QueryException;
use App\Models\Comarca;
use Illuminate\Http\Request;

class ComarcaController extends Controller
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
            $cursos = Comarca::where('actiu','=', 1)->where('cicles_id','=', $request->input('srchcicle'))->orderBy('nom')->paginate(6)->withQueryString();
        } else if ( $searchActive && !$searchCicle ) {
            $cursos = Comarca::where('actiu','=', 1)->orderBy('nom')->paginate(6)->withQueryString();
        } else if ( !$searchActive && $searchCicle ) {
            $cursos = Comarca::where('cicles_id','=', $request->input('srchcicle'))->orderBy('nom')->paginate(6)->withQueryString();
        } else {
            $cursos = Comarca::orderBy('nom')->paginate(5);
        }
        //$cicles = Cicle::where('actiu','=', 1)->orderBy('nom')->get();
        */

        $objetcsAry = Comarca::orderBy('nom')->paginate(5);

        $request->session()->flashInput($request->input());

        return view('admin.provincia.index', compact('objetcsAry') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<script>console.log("create method")</script>';

        return view( 'cursos.create', [
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

            $theobj = new Comarca;

            $theobj->sigles = $request->xsigles;
            $theobj->nom = $request->xnom;
            $theobj->cicles_id = $request->xciclesid;
            $theobj->actiu = ($request->xactiu==1);

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [ComarcaController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [ComarcaController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );
            // redirecciona si no estan completos los datos
            $response = redirect()->action( [ComarcaController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comarca  $comarques
     * @return \Illuminate\Http\Response
     */
    public function show(Comarca $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comarca  $comarques
     * @return \Illuminate\Http\Response
     */
    public function edit(Comarca $theobj)
    {
        echo '<script>console.log("edit method")</script>';

        return view('cursos.edit', [
            'curs'=>$theobj,
            //'cicles'=>Cicle::where('actiu','=', 1)->orderBy('nom')->get(),
            'insert'=>true
            ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comarca  $comarques
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comarca $theobj)
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
                $response = redirect()->action( [ComarcaController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [ComarcaController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );

            $response = redirect()->action( [ComarcaController::class, 'edit'] )->withInput();

        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comarca  $comarques
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comarca $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [ComarcaController::class, 'index'] );
    }
}
