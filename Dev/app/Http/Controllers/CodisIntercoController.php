<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use App\Models\CodisInterco;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CodisIntercoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $objectsAry = CodisInterco::orderBy('codi')->get();

        return view('admin.xtras.codis.interco.index', compact('objectsAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<script>console.log("create method")</script>';

        return view( 'admin.xtras.codis.interco.create' );

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

        if ( !empty( $request->codi ) && !empty( $request->nom ) ) {

            $theobj = new CodisInterco;

            $theobj->codi = $request->codi;
            $theobj->nom = $request->nom;
            $theobj->soundlike = $request->soundlike;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [CodisIntercoController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [CodisIntercoController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Codi i/o Nom inexistent' );
            $response = redirect()->action( [CodisIntercoController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CodisInterco  $theobj
     * @return \Illuminate\Http\Response
     */
    public function show(CodisInterco $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CodisInterco  $theobj
     * @return \Illuminate\Http\Response
     */
    public function edit(CodisInterco $theobj)
    {

        echo '<script>console.log("edit method")</script>';

        return view('admin.xtras.codis.interco.edit', compact('theobj') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CodisInterco  $theobj
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CodisInterco $theobj)
    {
        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->codi ) && !empty( $request->nom ) ) {

            $theobj->codi = $request->codi;
            $theobj->nom = $request->nom;
            $theobj->soundlike = $request->soundlike;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [CodisIntercoController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [CodisIntercoController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Codi i/o Nom inexistent' );
            $response = redirect()->action( [CodisIntercoController::class, 'edit'] )->withInput();

        }

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CodisInterco  $theobj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CodisInterco $theobj)
    {

        echo '<script>console.log("destroy method => theid: '.$theobj->codi.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [CodisIntercoController::class, 'index'] );

    }

}
