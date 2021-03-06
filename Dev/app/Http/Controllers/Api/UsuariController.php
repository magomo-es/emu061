<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuari;
use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsuariResource;
use Illuminate\Database\QueryException;

// CALL index http://localhost:8000/admin/api/usuari
// CALL show http://localhost:8000/admin/api/usuari/1

class UsuariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = Usuari::all();
        return UsuariResource::collection($objectsAry);
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
        $theobj = new Usuari;
        foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new UsuariResource($theobj))->response()->setStatusCode(201);
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
     * @param  \App\Models\Usuari  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function show(Usuari $theobj)
    {
        // para asociar ( dependencias a objeto )
        // $theobj = Usuari::with('otratabla')->find($theobj->campoenlace);
        return new UsuariResource($theobj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuari  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuari $theobj)
    {
/*
        foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new UsuariResource($theobj))->response()->setStatusCode(201);
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
     * @param  \App\Models\Usuari  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Usuari $theobj)
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
    public function getalluserdata()
    {
        $objectsAry = Usuari::with('rol')->orderBy('username')->get();
        return UsuariResource::collection($objectsAry);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getuserdata(Usuari $theobj)
    {
        $objectsAry = Usuari::with('rol')->find($theobj->id);
        return (new UsuariResource($objectsAry))->response()->setStatusCode(200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateconfig(Request $request, Usuari $theobj) {

        $theobj->configjson = $request->configjson;

        try {

            $theobj->save();
            $response = (new UsuariResource($theobj))->response()->setStatusCode(201);

        } catch( QueryException $ex ) {

            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);

        }
        return $response;

    }
}
