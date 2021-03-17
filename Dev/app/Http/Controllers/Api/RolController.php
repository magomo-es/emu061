<?php

namespace App\Http\Controllers\Api;

use App\Models\Rol;
use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RolResource;
use Illuminate\Database\QueryException;

// CALL index http://localhost:8000/admin/api/rol
// CALL show http://localhost:8000/admin/api/rol/1

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = Rol::all();
        return RolResource::collection($objectsAry);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $theobj = new Rol;
        foreach( $request as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new RolResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rol  $rols
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $theobj)
    {
        // para asociar ( dependencias a objeto )
        // $theobj = Rol::with('otratabla')->find($theobj->campoenlace);
        return new RolResource($theobj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rol  $rols
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol $theobj)
    {
        foreach( $request as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new RolResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rol  $rols
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Rol $theobj)
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
