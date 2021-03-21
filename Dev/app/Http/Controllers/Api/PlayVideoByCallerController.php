<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PlayVideoByCaller;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlayVideoByCallerResource;

class PlayVideoByCallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objectsAry = PlayVideoByCaller::all();
        return PlayVideoByCallerResource::collection($objectsAry);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
/*
        $theobj = new Comarca;
        foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new ComarcaResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
*/      return \response()->json(['error'=>'Página no econtrada'], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlayVideoByCallerResource  $theobj
     * @return \Illuminate\Http\Response
     */
    public function show(PlayVideoByCaller $theobj)
    {
        // para asociar ( dependencias a objeto )
        // $theobj = Comarca::with('otratabla')->find($theobj->campoenlace);
        return new PlayVideoByCallerResource($theobj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlayVideoByCallerResource  $theobj
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlayVideoByCaller $theobj)
    {
/*
        foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new ComarcaResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
*/      return \response()->json(['error'=>'Página no econtrada'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlayVideoByCallerResource  $theobj
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlayVideoByCaller $theobj)
    {
/*
        try {
            $theobj->delete();
            $response = \response()->json(['message'=>'Registre esborrat correctament'], 200);
        } catch( QueryException $ex ) {
            $response = \response()->json(['error'=>Utility::errorMessage($ex)], 400);
        }
        return $response;
*/      return \response()->json(['error'=>'Página no econtrada'], 404);
    }
}
