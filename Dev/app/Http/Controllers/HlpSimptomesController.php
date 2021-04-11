<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Models\HlpSimptomes;
use Illuminate\Database\QueryException;

class HlpSimptomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $objectsAry = HlpSimptomes::orderBy('pregunta')->paginate(10);
        $request->session()->flashInput($request->input());
        return view('admin.help.simptomes.index', compact('objectsAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        echo '<script>console.log("create method")</script>';
        return view( 'admin.help.simptomes.create' );

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

        if ( !empty( $request->pregunta ) && !empty( $request->translation ) ) {

            $theobj = new HlpSimptomes();

            $theobj->pregunta = $request->pregunta;
            $theobj->translation = $request->translation;
            $theobj->soundlike = $request->soundlike;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [HlpSimptomesController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [HlpSimptomesController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Pregunta i/o Traduccio inexistent' );
            $response = redirect()->action( [HlpSimptomesController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HlpSimptomes  $recursos
     * @return \Illuminate\Http\Response
     */
    public function show(HlpSimptomes $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HlpSimptomes  $recursos
     * @return \Illuminate\Http\Response
     */
    public function edit(HlpSimptomes $theobj)
    {

        echo '<script>console.log("edit method")</script>';
        return view('admin.help.simptomes.edit', compact('theobj') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HlpSimptomes  $recursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HlpSimptomes $theobj)
    {
        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->pregunta ) && !empty( $request->translation ) ) {

            $theobj->pregunta = $request->pregunta;
            $theobj->translation = $request->translation;
            $theobj->soundlike = $request->soundlike;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [HlpSimptomesController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [HlpSimptomesController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Pregunta i/o Traduccio inexistent' );
            $response = redirect()->action( [HlpSimptomesController::class, 'edit'] )->withInput();

        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HlpSimptomes  $recursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, HlpSimptomes $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [HlpSimptomesController::class, 'index'] );
    }
}
