<?php

namespace App\Http\Controllers\Api;

use App\Models\CodisValoracio;
use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CodisValoracioResource;
use Illuminate\Database\QueryException;


class CodisValoracioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return \response()->json(['error'=>'Página no econtrada'], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return \response()->json(['error'=>'Página no econtrada'], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CodisValoracio  $CodisValoracios
     * @return \Illuminate\Http\Response
     */
    public function show(CodisValoracio $theobj)
    {
        return \response()->json(['error'=>'Página no econtrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CodisValoracio  $CodisValoracios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CodisValoracio $theobj)
    {
        return \response()->json(['error'=>'Página no econtrada'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CodisValoracio  $CodisValoracios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CodisValoracio $theobj)
    {
        return \response()->json(['error'=>'Página no econtrada'], 404);
    }










    // - - - - - - - - - - -
    // - - - - - - - - - - -
    // - - - - - - - - - - - SPECIALS APIS

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fullvaloracions()
    {
        $objectsAry = CodisValoracio::orderBy('nom')->get();
        return CodisValoracioResource::collection($objectsAry);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function thevaloracio(CodisValoracio $theobj)
    {
        $objectsAry = CodisValoracio::find($theobj->codi);
        return (new CodisValoracioResource($objectsAry))->response()->setStatusCode(200);
    }
}
