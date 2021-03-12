<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use App\Models\Cicle;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ( $request->input('srchactiu')=='actiu' ) {

            //$cicles = Cicle::where('actiu','=', 1)->get();
            $cicles = Cicle::where('actiu','=', 1)->paginate(5)->withQueryString();

        } else {

            // $cicles = Cicle::all();
            $cicles = Cicle::paginate(5);

        }

        $request->session()->flashInput($request->input());

        return view('cicles.index', compact('cicles') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<script>console.log("create method")</script>';

        return view( 'cicles.create' );

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

            $cicle = new Cicle;

            $cicle->sigles = $request->xsigles;
            $cicle->nom = $request->xnom;
            $cicle->descripcio = $request->xdescripcio;
            $cicle->actiu = ($request->xactiu==1);

            try {
                $cicle->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [CicleController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [CicleController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );

            $response = redirect()->action( [CicleController::class, 'create'] )->withInput();

        }

        return $response;

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cicles  $cicles
     * @return \Illuminate\Http\Response
     */
    public function show(Cicle $cicles)
    {


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cicle  $cicles
     * @return \Illuminate\Http\Response
     */
    public function edit(Cicle $cicle)
    {

        echo '<script>console.log("edit method")</script>';

        return view('cicles.edit', ['cicle'=>$cicle] );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cicles  $cicles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cicle $cicle)
    {
        echo '<script>console.log("store method")</script>';

        $isOk = true;

        if ( !empty( $request->xsigles ) && !empty( $request->xnom ) ) {

            $cicle->sigles = $request->xsigles;
            $cicle->nom = $request->xnom;
            $cicle->descripcio = $request->xdescripcio;
            $cicle->actiu = ($request->xactiu==1);

            try {
                $cicle->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [CicleController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [CicleController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );

            $response = redirect()->action( [CicleController::class, 'edit'] )->withInput();

        }

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cicles  $cicles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cicle $cicle)
    {

        echo '<script>console.log("destroy method => theid: '.$cicle->id.'")</script>';

        try {
            $cicle->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        // Tornar a guardar l’array de cicles a la sessió.
        //return view('cicles.index');
        return redirect()->action( [CicleController::class, 'index'] );

    }

}
