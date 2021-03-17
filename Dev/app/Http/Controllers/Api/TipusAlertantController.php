<?php

namespace App\Http\Controllers\Api;

use App\Models\TipusAlertant;
use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TipusAlertantResource;
use Illuminate\Database\QueryException;

// CALL index http://localhost:8000/admin/api/tipusalertant
// CALL show http://localhost:8000/admin/api/tipusalertant/1

class TipusAlertantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = TipusAlertant::all();
        return TipusAlertantResource::collection($objectsAry);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $theobj = new TipusAlertant;
        foreach( $request as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new TipusAlertantResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipusAlertant $tipus_alertants
     * @return \Illuminate\Http\Response
     */
    public function show(TipusAlertant $theobj)
    {
        // para asociar ( dependencias a objeto )
        // $theobj = TipusAlertant::with('otratabla')->find($theobj->campoenlace);
        return new TipusAlertantResource($theobj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipusAlertant $tipus_alertants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipusAlertant $theobj)
    {
        foreach( $request as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new TipusAlertantResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipusAlertant $tipus_alertants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TipusAlertant $theobj)
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
