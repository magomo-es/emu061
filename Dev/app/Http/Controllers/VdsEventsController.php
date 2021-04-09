<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use App\Models\VdsEvents;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class VdsEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = VdsEvents::orderBy('tagid')->paginate(10);
        $request->session()->flashInput($request->input());
        return view('admin.video.events', compact('objectsAry') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<script>console.log("create method")</script>';
        return view( 'admin.video.events_create', ['insert'=>true] );
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

            $theobj = new VdsEvents();

            foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [VdsEventsController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [VdsEventsController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );
            // redirecciona si no estan completos los datos
            $response = redirect()->action( [VdsEventsController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VdsEvents  $recursos
     * @return \Illuminate\Http\Response
     */
    public function show(VdsEvents $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VdsEvents  $recursos
     * @return \Illuminate\Http\Response
     */
    public function edit(VdsEvents $theobj)
    {
        echo '<script>console.log("edit method")</script>';
        return view('admin.video.events_edit', [ 'theobj'=>$theobj, 'insert'=>true ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VdsEvents  $recursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VdsEvents $theobj)
    {
        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->tagid ) ) {

            foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [VdsEventsController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [VdsEventsController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );
            $response = redirect()->action( [VdsEventsController::class, 'edit'] )->withInput();

        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VdsEvents  $recursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, VdsEvents $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [VdsEventsController::class, 'index'] );
    }
}
