<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use Illuminate\Database\QueryException;
use App\Models\CodisValoracio;
use Illuminate\Http\Request;

class CodisValoracioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $objectsAry = CodisValoracio::orderBy('codi')->paginate(20);

        $request->session()->flashInput($request->input());

        return view('admin.xtras.codis.valoracio.index', compact('objectsAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<script>console.log("create method")</script>';

        return view( 'admin.xtras.codis.valoracio.create' );

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

        if ( !empty( $request->codi ) &&  !empty( $request->nom ) ) {

            $theobj = new CodisValoracio;

            $theobj->codi = $request->codi;
            $theobj->nom = $request->nom;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [CodisValoracioController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [CodisValoracioController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Codi i/o Nom inexistent' );
            $response = redirect()->action( [CodisValoracioController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CodisValoracio  $theobj
     * @return \Illuminate\Http\Response
     */
    public function show(CodisValoracio $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CodisValoracio  $theobj
     * @return \Illuminate\Http\Response
     */
    public function edit(CodisValoracio $theobj)
    {
        echo '<script>console.log("edit method")</script>';

        return view('admin.xtras.codis.valoracio.edit', compact('theobj') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CodisValoracio  $theobj
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CodisValoracio $theobj)
    {
        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->codi ) &&  !empty( $request->nom ) ) {

            $theobj = new CodisValoracio;

            $theobj->codi = $request->codi;
            $theobj->nom = $request->nom;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [CodisValoracioController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [CodisValoracioController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Codi i/o Nom inexistent' );
            $response = redirect()->action( [CodisValoracioController::class, 'edit'] )->withInput();

        }

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CodisValoracio  $theobj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CodisValoracio $theobj)
    {

        echo '<script>console.log("destroy method => theid: '.$theobj->codi.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [CodisValoracioController::class, 'index'] );

    }

}
