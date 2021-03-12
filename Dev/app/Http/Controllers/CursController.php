<?php

namespace App\Http\Controllers;

use App\Models\Curs;
use App\Models\Cicle;
use App\Classes\Utility;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $searchActive = ($request->input('srchactiu')=='actiu');
        $searchCicle = ($request->input('srchcicle')>0);

        if ( $searchActive && $searchCicle ) {

            $cursos = Curs::where('actiu','=', 1)->where('cicles_id','=', $request->input('srchcicle'))->orderBy('nom')->paginate(6)->withQueryString();

        } else if ( $searchActive && !$searchCicle ) {

            $cursos = Curs::where('actiu','=', 1)->orderBy('nom')->paginate(6)->withQueryString();

        } else if ( !$searchActive && $searchCicle ) {

            $cursos = Curs::where('cicles_id','=', $request->input('srchcicle'))->orderBy('nom')->paginate(6)->withQueryString();

        } else {

            $cursos = Curs::orderBy('nom')->paginate(5);

        }

        $cicles = Cicle::where('actiu','=', 1)->orderBy('nom')->get();

        $request->session()->flashInput($request->input());

        return view('cursos.index', compact('cursos','cicles') );
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
            'cicles'=>Cicle::where('actiu','=', 1)->orderBy('nom')->get(),
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

            $curs = new Curs;

            $curs->sigles = $request->xsigles;
            $curs->nom = $request->xnom;
            $curs->cicles_id = $request->xciclesid;
            $curs->actiu = ($request->xactiu==1);

            try {
                $curs->save();
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
     * @param  \App\Models\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function show(Curs $curs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function edit(Curs $curs)
    {
        echo '<script>console.log("edit method")</script>';

        return view('cursos.edit', [
            'curs'=>$curs,
            'cicles'=>Cicle::where('actiu','=', 1)->orderBy('nom')->get(),
            'insert'=>true
            ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curs $curs)
    {
        echo '<script>console.log("store method")</script>';

        $isOk = true;

        if ( !empty( $request->xsigles ) && !empty( $request->xnom ) ) {

            $curs->sigles = $request->xsigles;
            $curs->nom = $request->xnom;
            $curs->cicles_id = $request->xciclesid;
            $curs->actiu = ($request->xactiu==1);

            try {
                $curs->save();
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
     * @param  \App\Models\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Curs $curs)
    {
        echo '<script>console.log("destroy method => theid: '.$curs->id.'")</script>';

        try {
            $curs->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [CursController::class, 'index'] );
    }
}
