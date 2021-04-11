<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use Illuminate\Database\QueryException;
use App\Models\Comarca;
use App\Models\Provincia;
use Illuminate\Http\Request;

class ComarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        echo '<script>console.log("index method ('.$request->input('srchfilter1').' / '.$request->input('srchfilter2').')")</script>';

        // - - - - - search block =>
        $searchFilter1 = ($request->input('srchfilter1')>0);
        if ( $searchFilter1 ) {

            $objectsAry = Comarca::where('provincies_id','=', $request->input('srchfilter1'))
                ->orderBy('nom')
                ->paginate(10)
                ->withQueryString();

        } else {

            $objectsAry = Comarca::orderBy('nom')->paginate(10);

        }
        // - - - - - search block //

        $provinciesAry = Provincia::orderBy('nom')->get();

        $request->session()->flashInput($request->input());

        return view('admin.xtras.comarca.index', compact('objectsAry','provinciesAry') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<script>console.log("create method")</script>';
        $provinciesAry = Provincia::orderBy('nom')->get();
        return view( 'admin.xtras.comarca.create', compact('provinciesAry') );

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

            $theobj = new Comarca;

            $theobj->nom = $request->xnom;
            $theobj->provincies_id = $request->xprovinciesid;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [ComarcaController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [ComarcaController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Nom inexistent' );
            $response = redirect()->action( [ComarcaController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comarca  $comarques
     * @return \Illuminate\Http\Response
     */
    public function show(Comarca $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comarca  $comarques
     * @return \Illuminate\Http\Response
     */
    public function edit(Comarca $theobj)
    {
        echo '<script>console.log("edit method")</script>';
        $provinciesAry = Provincia::orderBy('nom')->get();
        return view( 'admin.xtras.comarca.edit', compact('theobj','provinciesAry') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comarca  $comarques
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comarca $theobj)
    {
        echo '<script>console.log("store method")</script>';

        $isOk = true;

        if ( !empty( $request->xnom ) ) {

            $theobj->nom = $request->xnom;
            $theobj->provincies_id = $request->xprovinciesid;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [ComarcaController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [ComarcaController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Nom inexistent' );
            $response = redirect()->action( [ComarcaController::class, 'edit'] )->withInput();

        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comarca  $comarques
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comarca $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [ComarcaController::class, 'index'] );
    }
}
