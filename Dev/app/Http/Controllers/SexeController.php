<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use Illuminate\Database\QueryException;
use App\Models\Sexe;
use Illuminate\Http\Request;

class SexeController extends Controller
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
            $cursos = Sexe::where('actiu','=', 1)->where('cicles_id','=', $request->input('srchcicle'))->orderBy('nom')->paginate(6)->withQueryString();
        } else if ( $searchActive && !$searchCicle ) {
            $cursos = Sexe::where('actiu','=', 1)->orderBy('nom')->paginate(6)->withQueryString();
        } else if ( !$searchActive && $searchCicle ) {
            $cursos = Sexe::where('cicles_id','=', $request->input('srchcicle'))->orderBy('nom')->paginate(6)->withQueryString();
        } else {
            $cursos = Sexe::orderBy('nom')->paginate(5);
        }
        //$cicles = Cicle::where('actiu','=', 1)->orderBy('nom')->get();
        */

        $objectsAry = Sexe::orderBy('sexe')->paginate(10);

        $request->session()->flashInput($request->input());

        return view('admin.sexe.index', compact('objectsAry') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<script>console.log("create method")</script>';

        return view( 'admin.sexe.create', [
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

        if ( !empty( $request->xsexe ) ) {

            $theobj = new Sexe;
            $theobj->sexe = $request->xsexe;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [SexeController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [SexeController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );
            // redirecciona si no estan completos los datos
            $response = redirect()->action( [SexeController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sexe  $sexes
     * @return \Illuminate\Http\Response
     */
    public function show(Sexe $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sexe  $sexes
     * @return \Illuminate\Http\Response
     */
    public function edit(Sexe $theobj)
    {
        echo '<script>console.log("edit method")</script>';

        return view('admin.sexe.edit', [
            'theobj'=>$theobj,
            'insert'=>true
            ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sexe  $sexes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sexe $theobj)
    {
        echo '<script>console.log("store method")</script>';

        $isOk = true;

        if ( !empty( $request->xsexe ) ) {

            $theobj->sexe = $request->xsexe;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [SexeController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [SexeController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );

            $response = redirect()->action( [SexeController::class, 'edit'] )->withInput();

        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sexe  $sexes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Sexe $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [SexeController::class, 'index'] );
    }
}