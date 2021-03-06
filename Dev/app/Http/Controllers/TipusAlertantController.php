<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use Illuminate\Database\QueryException;
use App\Models\TipusAlertant;
use Illuminate\Http\Request;

class TipusAlertantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $objectsAry = TipusAlertant::orderBy('tipus')->paginate(10);
        $request->session()->flashInput($request->input());
        return view('admin.tipus.tipusalertant.index', compact('objectsAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        echo '<script>console.log("create method")</script>';
        return view( 'admin.tipus.tipusalertant.create' );

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

        if ( !empty( $request->xtipus ) ) {

            $theobj = new TipusAlertant;

            $theobj->tipus = $request->xtipus;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [TipusAlertantController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [TipusAlertantController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Tipus inexistent' );
            $response = redirect()->action( [TipusAlertantController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipusAlertant $tipus_alertants
     * @return \Illuminate\Http\Response
     */
    public function show(TipusAlertant $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipusAlertant $tipus_alertants
     * @return \Illuminate\Http\Response
     */
    public function edit(TipusAlertant $theobj)
    {

        echo '<script>console.log("edit method")</script>';
        return view('admin.tipus.tipusalertant.edit', ['theobj'=>$theobj] );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipusAlertant $tipus_alertants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipusAlertant $theobj)
    {

        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->xtipus ) ) {

            $theobj->tipus = $request->xtipus;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [TipusAlertantController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [TipusAlertantController::class, 'edit'], [ 'theobj' => $theobj ] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Tipus inexistent' );
            $response = redirect()->action( [TipusAlertantController::class, 'edit'], [ 'theobj' => $theobj ] )->withInput();

        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipusAlertant $tipus_alertants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TipusAlertant $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [TipusAlertantController::class, 'index'] );
    }
}
