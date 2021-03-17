<?php

namespace App\Http\Controllers\Api;

use App\Models\TipusIncidencia;
use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TipusIncidenciaResource;
use Illuminate\Database\QueryException;

// CALL index http://localhost:8000/api/tipusincidencia
// CALL show http://localhost:8000/api/tipusincidencia/1

class TipusIncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = TipusIncidencia::all();
        return TipusIncidenciaResource::collection($objectsAry);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $theobj = new TipusIncidencia;
        foreach( $request as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new TipusIncidenciaResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipusIncidencia  $tipus_incidencies
     * @return \Illuminate\Http\Response
     */
    public function show(TipusIncidencia $theobj)
    {
        // para asociar ( dependencias a objeto )
        // $theobj = TipusIncidencia::with('otratabla')->find($theobj->campoenlace);
        return new TipusIncidenciaResource($theobj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipusIncidencia  $tipus_incidencies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipusIncidencia $theobj)
    {
        foreach( $request as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new TipusIncidenciaResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipusIncidencia  $tipus_incidencies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TipusIncidencia $theobj)
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
