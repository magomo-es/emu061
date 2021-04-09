<?php

namespace App\Http\Controllers\Api;

use App\Models\Recurs;
use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecursResource;
use Illuminate\Database\QueryException;

// CALL index http://localhost:8000/admin/api/recurs
// CALL show http://localhost:8000/admin/api/recurs/1

class RecursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = Recurs::all();
        return RecursResource::collection($objectsAry);
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
        $theobj = new Recurs;
        foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new RecursResource($theobj))->response()->setStatusCode(201);
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
     * @param  \App\Models\Recurs  $recursos
     * @return \Illuminate\Http\Response
     */
    public function show(Recurs $theobj)
    {

        $theobj = Recurs::with(['tipus_recurso','usuaris','incidencies'])->find($theobj->id);
        return new RecursResource($theobj);

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
/*
        foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new RecursResource($theobj))->response()->setStatusCode(201);
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
     * @param  \App\Models\Recurs  $recursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Recurs $theobj)
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
