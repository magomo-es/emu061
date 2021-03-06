<?php

namespace App\Http\Controllers\Api;

use App\Models\Incidencia;
use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\IncidenciaResource;
use Illuminate\Database\QueryException;

// CALL index http://localhost:8000/admin/api/incidencia
// CALL show http://localhost:8000/admin/api/incidencia/1

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = Incidencia::all();
        return IncidenciaResource::collection($objectsAry);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $theobj = new Incidencia;
        foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new IncidenciaResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencia $theobj)
    {

        $theobj = Incidencia::with('tipus_incidencia','alertant','municipi.comarca.provincia','usuari','afectats.recursos')->find($theobj->id);
        return new IncidenciaResource($theobj);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidencia  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidencia $theobj)
    {
        foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new IncidenciaResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidencia  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Incidencia $theobj)
    {
        try {
            $theobj->delete();
            $response = \response()->json(['message'=>'Registre esborrat correctament'], 200);
        } catch( QueryException $ex ) {
            $response = \response()->json(['error'=>Utility::errorMessage($ex)], 400);
        }
        return $response;
    }








    // - - - - - - - - - - -
    // - - - - - - - - - - -
    // - - - - - - - - - - - SPECIALS APIS

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fullincidencies()
    {
        $objectsAry = Incidencia::with('tipus_incidencia','alertant','municipi','usuari','incidencies_has_recursos.afectat','incidencies_has_recursos.recurs')->orderBy('data')->orderBy('hora')->get();
        return IncidenciaResource::collection($objectsAry);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function theincidencia(Incidencia $theobj)
    {
        $objectsAry = Incidencia::with('tipus_incidencia','alertant','municipi','usuari','incidencies_has_recursos.afectat','incidencies_has_recursos.recurs')->find($theobj->id);
        return (new IncidenciaResource($objectsAry))->response()->setStatusCode(200);
    }
}
