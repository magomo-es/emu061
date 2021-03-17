<?php

namespace App\Http\Controllers\Api;

use App\Models\Sexe;
use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SexeResource;
use Illuminate\Database\QueryException;

// CALL index http://localhost:8000/admin/api/sexe
// CALL show http://localhost:8000/admin/api/sexe/1

class SexeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = Sexe::all();
        return SexeResource::collection($objectsAry);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $theobj = new Sexe;
        foreach( $request as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new SexeResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sexe  $sexes
     * @return \Illuminate\Http\Response
     */
    public function show(Sexe $theobj)
    {
        // para asociar ( dependencias a objeto )
        // $theobj = Sexe::with('otratabla')->find($theobj->campoenlace);
        return new SexeResource($theobj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sexe  $sexes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sexe $theobj)
    {
        foreach( $request as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new SexeResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sexe  $sexes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Sexe $theobj)
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
