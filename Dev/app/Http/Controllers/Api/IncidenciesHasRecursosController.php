<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IncidenciesHasRecursos;
use App\Http\Resources\IncidenciesHasRecursosResource;

// CALL index http://localhost:8000/api/admin/incidencieshasrecursos
// CALL show http://localhost:8000/api/admin/incidencieshasrecursos/1

class IncidenciesHasRecursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = IncidenciesHasRecursos::all();
        return IncidenciesHasRecursosResource ::collection($objectsAry);
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
     * @param  \App\Models\IncidenciaHasController  $theobj
     * @return \Illuminate\Http\Response
     */
    public function show(IncidenciesHasRecursos $theobj)
    {
        // para asociar ( dependencias a objeto )
        // $theobj = Comarca::with('otratabla')->find($theobj->campoenlace);
        return new IncidenciesHasRecursosResource($theobj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IncidenciaHasController  $theobj
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncidenciesHasRecursos $theobj)
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
     * @param  \App\Models\IncidenciaHasController  $theobj
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncidenciesHasRecursos $theobj)
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











        // - - - - - - - - - - -
    // - - - - - - - - - - -
    // - - - - - - - - - - - SPECIALS APIS

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fullhasrecursos()
    {
        $objectsAry = IncidenciesHasRecursos::orderBy('nom')->get();
        return IncidenciesHasRecursosResource::collection($objectsAry);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function thehasrecurso(IncidenciesHasRecursos $theobj)
    {
        $objectsAry = IncidenciesHasRecursos::find($theobj->id);
        return (new IncidenciesHasRecursosResource($objectsAry))->response()->setStatusCode(200);
    }
}
