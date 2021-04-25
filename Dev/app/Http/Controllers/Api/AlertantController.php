<?php

namespace App\Http\Controllers\Api;

use App\Models\Alertant;
use App\Classes\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AlertantResource;
use Illuminate\Database\QueryException;

// CALL index http://localhost:8000/admin/api/alertant
// CALL show http://localhost:8000/admin/api/alertant/1

class AlertantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectsAry = Alertant::all();
        return AlertantResource::collection($objectsAry);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $theobj = new Alertant;
        foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new AlertantResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alertant  $alertants
     * @return \Illuminate\Http\Response
     */
    public function show(Alertant $theobj)
    {

        $theobj = Alertant::with(['municipi','incidencies'])->find($theobj->id);
        return new AlertantResource($theobj);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alertant  $alertants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alertant $theobj)
    {
        foreach( $request->all() as $tmpkey => $tmpdata) { $theobj->{$tmpkey} = $tmpdata; }
        try {
            $theobj->save();
            $response = (new AlertantResource($theobj))->response()->setStatusCode(201);
        } catch( QueryException $ex ) {
            $mensaje = Utility::errorMessage($ex);
            $response = \response()->json(['error'=>$mensaje], 400);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alertant  $alertants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Alertant $theobj)
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
    public function centressanitaris()
    {
        $objectsAry = Alertant::where('tipus_alertants_id','=', 1)->orderBy('nom')->get();
        return AlertantResource::collection($objectsAry);
    }









    // - - - - - - - - - - -
    // - - - - - - - - - - -
    // - - - - - - - - - - - SPECIALS APIS

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fullalertants()
    {
        $objectsAry = Alertant::with('tipus_alertant','municipi','incidencies')->orderBy('nom')->get();
        return AlertantResource::collection($objectsAry);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function thealertant(Alertant $theobj)
    {
        $objectsAry = Alertant::with('tipus_alertant','municipi','incidencies')->find($theobj->id);
        return (new AlertantResource($objectsAry))->response()->setStatusCode(200);
    }
}
