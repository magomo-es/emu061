<?php

namespace App\Http\Controllers\Api;

use App\Models\TipusRecurs;
use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TipusRecursResource;
use Illuminate\Database\QueryException;

// CALL index http://localhost:8000/admin/api/tipusrecurs
// CALL show http://localhost:8000/admin/api/tipusrecurs/1

class TipusRecursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = TipusRecurs::all();
        return TipusRecursResource::collection($objectsAry);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $theobj = new TipusRecurs;
        foreach( $request as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new TipusRecursResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipusRecurs  $tipus_recursos
     * @return \Illuminate\Http\Response
     */
    public function show(TipusRecurs $theobj)
    {
        // para asociar ( dependencias a objeto )
        // $theobj = TipusRecurs::with('otratabla')->find($theobj->campoenlace);
        return new TipusRecursResource($theobj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipusRecurs  $tipus_recursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipusRecurs $theobj)
    {
        foreach( $request as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new TipusRecursResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipusRecurs  $tipus_recursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TipusRecurs $theobj)
    {
        try {
            $theobj->delete();
            $response = \response()->json(['message'=>'Registre esborrat correctament'], 200);
        } catch( QueryException $ex ) {
            $response = \response()->json(['error'=>Utility::errorMessage($ex)], 400);
        }
        return $response;
    }
}
