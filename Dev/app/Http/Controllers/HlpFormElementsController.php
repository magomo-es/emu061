<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Models\HlpFormElements;
use Illuminate\Database\QueryException;

class HlpFormElementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $objectsAry = HlpFormElements::orderBy('title')->paginate(10);
        $request->session()->flashInput($request->input());
        return view('admin.help.formelements.index', compact('objectsAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        echo '<script>console.log("create method")</script>';
        return view( 'admin.help.formelements.create' );

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

        if ( !empty( $request->title ) && !empty( $request->description ) && !empty( $request->tagid ) ) {

            $theobj = new HlpFormElements();

            $theobj->title = $request->title;
            $theobj->description = $request->description;
            $theobj->tagid = $request->tagid;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [HlpFormElementsController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [HlpFormElementsController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Titul, Descripcio i/o Etiquetes inexistent' );
            $response = redirect()->action( [HlpFormElementsController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HlpFormElements  $recursos
     * @return \Illuminate\Http\Response
     */
    public function show(HlpFormElements $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HlpFormElements  $recursos
     * @return \Illuminate\Http\Response
     */
    public function edit(HlpFormElements $theobj)
    {

        echo '<script>console.log("edit method")</script>';
        return view('admin.help.formelements.edit', compact('theobj') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HlpFormElements  $recursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HlpFormElements $theobj)
    {
        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->title ) && !empty( $request->description ) && !empty( $request->tagid ) ) {

            foreach( $request->all() as $tmpkey => $tmpdata) { if ($theobj->{$tmpkey}) { $theobj->{$tmpkey} = $tmpdata; } }

            $theobj->title = $request->title;
            $theobj->description = $request->description;
            $theobj->tagid = $request->tagid;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [HlpFormElementsController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [HlpFormElementsController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Titul, Descripcio i/o Etiquetes inexistent' );
            $response = redirect()->action( [HlpFormElementsController::class, 'edit'] )->withInput();

        }

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HlpFormElements  $recursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, HlpFormElements $theobj)
    {

        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [HlpFormElementsController::class, 'index'] );

    }
}
