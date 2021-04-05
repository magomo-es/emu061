<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use Illuminate\Database\QueryException;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $objectsAry = Rol::orderBy('nom')->paginate(10);

        $request->session()->flashInput($request->input());

        return view('admin.rol.index', compact('objectsAry') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<script>console.log("create method")</script>';

        return view( 'admin.rol.create', ['insert'=>true] );

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

        $isOk = true;

        if ( !empty( $request->xnom ) ) {

            $theobj = new Rol;

            $theobj->nom = $request->xnom;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [RolController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [RolController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Sigles i/o Nom inexistent' );
            // redirecciona si no estan completos los datos
            $response = redirect()->action( [RolController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rol  $rols
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rol  $rols
     * @return \Illuminate\Http\Response
     */
    public function edit(Rol $theobj)
    {
        echo '<script>console.log("edit method")</script>';

        return view('admin.rol.edit', ['theobj'=>$theobj,'insert'=>false] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rol  $rols
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol $theobj)
    {
        echo '<script>console.log("store method")</script>';

        $isOk = true;

        if ( !empty( $request->xnom ) ) {

            $theobj->nom = $request->xnom;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [RolController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [RolController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Nom inexistent' );
            $response = redirect()->action( [RolController::class, 'edit'] )->withInput();

        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rol  $rols
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Rol $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [RolController::class, 'index'] );
    }
}
