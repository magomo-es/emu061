<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use App\Models\VdsEvents;
use App\Models\VdsVideos;
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

        $objectsAry = VdsEvents::with('video')->orderBy('id_video')->paginate(20);

        $typeAry = ['No def','Explicació','Joc'];

        return view('admin.video.events.index', compact('objectsAry','typeAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        echo '<script>console.log("create method")</script>';

        $videosAry = VdsVideos::orderby('title')->get();

        $typeAry = ['No def','Explicació','Joc'];

        return view( 'admin.video.events.create', compact('videosAry','typeAry') );

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

        if ( !empty( $request->ontime ) && !empty( $request->title ) && !empty( $request->jsondata ) ) {

            $theobj = new VdsEvents();

            $theobj->title = $request->title;
            $theobj->id_video = $request->id_video;
            $theobj->ontime = $request->ontime;
            $theobj->timeout = $request->timeout;
            $theobj->type = $request->type;
            $theobj->jsondata = $request->jsondata;

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

            $request->session()->flash('error', 'Segons d\'inici i/o Accions inexistent' );
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

        $videosAry = VdsVideos::orderby('title')->get();

        $typeAry = ['No def','Explicació','Joc'];

        $theobj = VdsEvents::with('video')->find($theobj->id_video);

        return view('admin.video.events.edit', compact('theobj','videosAry','typeAry') );

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

        if ( !empty( $request->ontime ) && !empty( $request->title ) && !empty( $request->jsondata ) ) {

            $theobj->title = $request->title;
            $theobj->id_video = $request->id_video;
            $theobj->ontime = $request->ontime;
            $theobj->timeout = $request->timeout;
            $theobj->type = $request->type;
            $theobj->jsondata = $request->jsondata;

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

            $request->session()->flash('error', 'Segons d\'inici i/o Accions inexistent' );
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
