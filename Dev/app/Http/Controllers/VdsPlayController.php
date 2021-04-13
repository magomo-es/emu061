<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use App\Models\CodisValoracio;
use Illuminate\Http\Request;
use App\Models\VdsPlay;
use App\Models\VdsVideos;
use Illuminate\Database\QueryException;

class VdsPlayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $objectsAry = VdsPlay::with('video','valoracio')->orderBy('title')->paginate(20);

        $videosAry = VdsVideos::orderby('title')->get();

        $valoracionsAry = CodisValoracio::orderby('nom')->get();

        return view('admin.video.play.index', compact('objectsAry','videosAry','valoracionsAry') );

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

        $valoracionsAry = CodisValoracio::orderby('nom')->get();

        return view( 'admin.video.play.create', compact('videosAry','valoracionsAry') );

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

        if ( !empty( $request->title ) ) {

            $theobj = new VdsPlay();

            $theobj->title = $request->title;
            $theobj->id_caller = $request->id_caller;
            $theobj->id_video = $request->id_video;
            $theobj->start = $request->start;
            $theobj->ends = $request->ends;
            $theobj->playevent = $request->playevent;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [VdsPlayController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [VdsPlayController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Titul inexistent' );
            $response = redirect()->action( [VdsPlayController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VdsPlay  $recursos
     * @return \Illuminate\Http\Response
     */
    public function show(VdsPlay $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VdsPlay  $recursos
     * @return \Illuminate\Http\Response
     */
    public function edit(VdsPlay $theobj)
    {

        echo '<script>console.log("edit method")</script>';

        $videosAry = VdsVideos::orderby('title')->get();

        $valoracionsAry = CodisValoracio::orderby('nom')->get();

        $theobj = VdsPlay::with('video','valoracio')->find($theobj->id_video);

        return view('admin.video.play.edit', compact('theobj','videosAry','valoracionsAry') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VdsPlay  $recursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VdsPlay $theobj)
    {

        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->title ) ) {

            $theobj->title = $request->title;
            $theobj->id_caller = $request->id_caller;
            $theobj->id_video = $request->id_video;
            $theobj->start = $request->start;
            $theobj->ends = $request->ends;
            $theobj->playevent = $request->playevent;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [VdsPlayController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [VdsPlayController::class, 'edit'], [ 'theobj' => $theobj ] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Titul inexistent' );
            $response = redirect()->action( [VdsPlayController::class, 'edit'], [ 'theobj' => $theobj ] )->withInput();

        }

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VdsPlay  $recursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, VdsPlay $theobj)
    {

        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [VdsPlayController::class, 'index'] );

    }
}
