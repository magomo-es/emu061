<?php

namespace App\Http\Controllers\Api;

use App\Models\CodisGravetat;
use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CodisGravetatResource;
use Illuminate\Database\QueryException;


class CodisGravetatController extends Controller
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
     * @param  \App\Models\CodisGravetat  $CodisGravetats
     * @return \Illuminate\Http\Response
     */
    public function show(CodisGravetat $theobj)
    {
        return \response()->json(['error'=>'Página no econtrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CodisGravetat  $CodisGravetats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CodisGravetat $theobj)
    {
        return \response()->json(['error'=>'Página no econtrada'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CodisGravetat  $CodisGravetats
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CodisGravetat $theobj)
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
    public function fullgravetats()
    {
        $objectsAry = CodisGravetat::orderBy('nom')->get();
        return CodisGravetatResource::collection($objectsAry);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function thegravetat(CodisGravetat $theobj)
    {
        $objectsAry = CodisGravetat::find($theobj->codi);
        return (new CodisGravetatResource($objectsAry))->response()->setStatusCode(200);
    }
}
