<?php

namespace App\Http\Controllers\Api;

use App\Models\Municipi;
use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MunicipiResource;
use Illuminate\Database\QueryException;

// CALL index http://localhost:8000/admin/api/municipi
// CALL show http://localhost:8000/admin/api/municipi/1

class MunicipiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = Municipi::all();
        return MunicipiResource::collection($objectsAry);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
/*        $theobj = new Municipi;
        foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new MunicipiResource($theobj))->response()->setStatusCode(201);
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
     * @param  \App\Models\Municipi  $municipis
     * @return \Illuminate\Http\Response
     */
    public function show(Municipi $theobj)
    {

        $theobj = Municipi::with(['comarca','provincia'])->find($theobj->id);
        return new MunicipiResource($theobj);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Municipi  $municipis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipi $theobj)
    {
/*
        foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new MunicipiResource($theobj))->response()->setStatusCode(201);
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
     * @param  \App\Models\Municipi  $municipis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Municipi $theobj)
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
    public function fullmunicipis()
    {
        $objectsAry = Municipi::with('comarca','provincia')->orderBy('nom')->get();
        return MunicipiResource::collection($objectsAry);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function themunicipi(Municipi $theobj)
    {
        $objectsAry = Municipi::with('comarca','provincia')->find($theobj->id);
        return (new MunicipiResource($objectsAry))->response()->setStatusCode(200);
    }

}
