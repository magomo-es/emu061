<?php

namespace App\Http\Controllers;

use App\Models\Recurs;
use App\Classes\Utility;
use App\Models\TipusRecurs;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RecursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // - - - - - search block =>
        $searchType = ( $request->input('srchtype') > 0 );
        $searchCode = ( strlen( $request->input('srchcode') ) > 0 );
        if ( $searchType && $searchCode ) {
            echo '<script>console.log(" search by searchType && searchCode")</script>';
            $objectsAry = Recurs::where( 'tipus_recursos_id','=', $request->input('srchtype') )
                ->where( 'codi', 'like', '%'.$request->input('srchcode').'%' )
                ->orderBy('codi')
                ->paginate(10)
                ->withQueryString();
        } else if ( $searchType && !$searchCode ) {
            echo '<script>console.log(" search by searchType")</script>';
            $objectsAry = Recurs::where( 'tipus_recursos_id','=', $request->input('srchtype') )
                ->orderBy('codi')
                ->paginate(10)
                ->withQueryString();
        } else if ( !$searchType && $searchCode ) {
            echo '<script>console.log(" search by searchCode")</script>';
            $objectsAry = Recurs::where('codi', 'like', '%'.$request->input('srchcode').'%')
                ->orderBy('codi')
                ->paginate(10)
                ->withQueryString();
        } else {
            echo '<script>console.log(" No search !")</script>';
            $objectsAry = Recurs::orderBy('codi')
                ->paginate(10);
        }
        // - - - - - search block //


        $tipusAry = TipusRecurs::orderBy('tipus')->get();

        $request->session()->flashInput($request->input());

        return view('admin.recurs.index', compact('objectsAry','tipusAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        echo '<script>console.log("create method")</script>';
        $tipusAry = TipusRecurs::orderBy('tipus')->get();
        return view( 'admin.recurs.create', compact('tipusAry') );

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

        if ( !empty( $request->xcodi ) ) {

            $theobj = new Recurs;

            $theobj->codi = $request->xcodi;
            $theobj->actiu = ($request->xactiu==1);
            $theobj->tipus_recursos_id = $request->xtipusrecursosid;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [RecursController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [RecursController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Codi inexistent' );
            $response = redirect()->action( [RecursController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recurs  $recursos
     * @return \Illuminate\Http\Response
     */
    public function show(Recurs $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recurs  $recursos
     * @return \Illuminate\Http\Response
     */
    public function edit(Recurs $theobj)
    {

        echo '<script>console.log("edit method")</script>';
        $tipusAry = TipusRecurs::orderBy('tipus')->get();
        return view('admin.recurs.edit', compact( 'theobj','tipusAry' ) );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recurs  $recursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recurs $theobj)
    {

        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->xcodi ) ) {

            $theobj->codi = $request->xcodi;
            $theobj->actiu = ($request->xactiu==1);
            $theobj->tipus_recursos_id = $request->xtipusrecursosid;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [RecursController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [RecursController::class, 'edit'], [ 'theobj' => $theobj ] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Codi inexistent' );
            $response = redirect()->action( [RecursController::class, 'edit'], [ 'theobj' => $theobj ] )->withInput();

        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recurs  $recursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Recurs $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [RecursController::class, 'index'] );
    }
}
