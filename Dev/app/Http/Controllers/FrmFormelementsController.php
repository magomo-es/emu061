<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use App\Models\FormElements;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class FrmFormelementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = FrmFormelements::orderBy('tagid')->paginate(10);
        $request->session()->flashInput($request->input());
        return view('admin.formelements.index', compact('objectsAry') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<script>console.log("create method")</script>';
        return view( 'admin.formelements.create', ['insert'=>true] );
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

        if ( !empty( $request->tagid ) ) {

            $theobj = new FrmFormelements();

            foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [FrmFormelementsController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [FrmFormelementsController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Nom inexistent' );
            // redirecciona si no estan completos los datos
            $response = redirect()->action( [FrmFormelementsController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FrmFormelements  $recursos
     * @return \Illuminate\Http\Response
     */
    public function show(FrmFormelements $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FrmFormelements  $recursos
     * @return \Illuminate\Http\Response
     */
    public function edit(FrmFormelements $theobj)
    {
        echo '<script>console.log("edit method")</script>';
        return view('admin.formelements.edit', [ 'theobj'=>$theobj, 'insert'=>true ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FrmFormelements  $recursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FrmFormelements $theobj)
    {
        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->tagid ) ) {

            foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [FrmFormelementsController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [FrmFormelementsController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Nom inexistent' );
            $response = redirect()->action( [FrmFormelementsController::class, 'edit'] )->withInput();

        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FrmFormelements  $recursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, FrmFormelements $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [FrmFormelementsController::class, 'index'] );
    }
}
