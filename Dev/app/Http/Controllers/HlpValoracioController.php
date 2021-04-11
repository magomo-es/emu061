<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use App\Models\HlpSimptomes;
use App\Models\HlpValoracio;
use Illuminate\Http\Request;
use App\Models\CodisValoracio;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class HlpValoracioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = HlpValoracio::with('valoracio','simptomes')->orderBy('codi_valoracio')->paginate(20);

        return view('admin.help.valoracio.index', compact('objectsAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        echo '<script>console.log("create method")</script>';

        $simptomesAry = HlpSimptomes::orderBy('pregunta')->get();

        return view( 'admin.help.valoracio.reate', compact('simptomesAry') );

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

        if ( !empty( $request->xtranslation ) && !empty( $request->xjsontags ) ) {

            $theobj = new HlpValoracio();

            $theobj->translation = $request->translation;
            $theobj->soundlike = $request->soundlike;
            $theobj->jsontags = $request->jsontags;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [HlpValoracioController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [HlpValoracioController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Traduccio i/o Simptomes inexistent' );
            $response = redirect()->action( [HlpValoracioController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HlpValoracio  $recursos
     * @return \Illuminate\Http\Response
     */
    public function show(HlpValoracio $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HlpValoracio  $recursos
     * @return \Illuminate\Http\Response
     */
    public function edit(HlpValoracio $theobj)
    {

        echo '<script>console.log("edit method")</script>';

        $simptomesAry = HlpSimptomes::orderBy('pregunta')->get();

        $theobj = HlpValoracio::with('valoracio','simptomes')->find($theobj->codi_valoracio);

        return view('admin.help.valoracio.edit', compact('theobj','simptomesAry') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HlpValoracio  $recursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HlpValoracio $theobj)
    {

        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->translation ) && !empty( $request->jsontags ) ) {

            $theobj->translation = $request->translation;
            $theobj->soundlike = $request->soundlike;
            $theobj->jsontags = $request->jsontags;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [HlpValoracioController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [HlpValoracioController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Traduccio i/o Simptomes inexistent' );
            $response = redirect()->action( [HlpValoracioController::class, 'edit'] )->withInput();

        }

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HlpValoracio  $recursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, HlpValoracio $theobj)
    {

        echo '<script>console.log("destroy method => theid: '.$theobj->codi_valoracio.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [HlpValoracioController::class, 'index'] );

    }
}
