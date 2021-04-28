<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\SexeController;
use App\Http\Controllers\Api\RecursController;
use App\Http\Controllers\Api\UsuariController;
use App\Http\Controllers\Api\VideosController;
use App\Http\Controllers\Api\AfectatController;
use App\Http\Controllers\Api\ComarcaController;
use App\Http\Controllers\Api\AlertantController;
use App\Http\Controllers\Api\MunicipiController;
use App\Http\Controllers\Api\ProvinciaController;
use App\Http\Controllers\Api\IncidenciaController;
use App\Http\Controllers\Api\TipusRecursController;
use App\Http\Controllers\Api\VideoEventsController;
use App\Http\Controllers\Api\FormElementsController;
use App\Http\Controllers\Api\CodisGravetatController;
use App\Http\Controllers\Api\TipusAlertantController;
use App\Http\Controllers\Api\CodisValoracioController;
use App\Http\Controllers\Api\TipusIncidenciaController;
use App\Http\Controllers\Api\PlayVideoByCallerController;
use App\Http\Controllers\Api\IncidenciesHasRecursosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) { return $request->user(); });

//Route::middleware(['auth'])->group( function() {

    //Route::apiResource('admin/incidencies', IncidenciaController::class)->parameters(['incidencies' => 'theobj']);

    Route::get('incidencies', [IncidenciaController::class, 'fullincidencies']);
    Route::get('incidencia/{theobj}', [IncidenciaController::class, 'theincidencia']);

    Route::get('afectats', [AfectatController::class, 'fullafectats']);
    Route::get('afectat/{theobj}', [AfectatController::class, 'theafectat']);

    Route::get('alertants', [AlertantController::class, 'fullalertants']);
    Route::get('alertant/{theobj}', [AlertantController::class, 'thealertant']);

    Route::get('recursos', [RecursController::class, 'fullrecursos']);
    Route::get('recurso/{theobj}', [RecursController::class, 'therecurso']);

    Route::get('usuaris', [UsuariController::class, 'fullusuaris']);
    Route::get('usuari/{theobj}', [UsuariController::class, 'theusuari']);

    Route::get('formelements', [FormElementsController::class, 'fullformelements']);
    Route::get('formelements/{theobj}', [FormElementsController::class, 'theformelement']);

    Route::get('videos', [VideosController::class, 'fullvideos']);
    Route::get('video/{theobj}', [VideosController::class, 'thevideo']);

    Route::get('playvideobycallers', [PlayVideoByCallerController::class, 'fullplayvideobycallers']);
    Route::get('playvideobycaller/{theobj}', [PlayVideoByCallerController::class, 'theplayvideobycaller']);

    Route::get('videoevents', [VideoEventsController::class, 'fullvideoevents']);
    Route::get('videoevents/{theobj}', [VideoEventsController::class, 'thevideoevent']);

    Route::get('tipus_alertants', [TipusAlertantController::class, 'fulltipusalertants']);
    Route::get('tipus_alertant/{theobj}', [TipusAlertantController::class, 'thetipusalertant']);

    Route::get('tipus_incidencies', [TipusIncidenciaController::class, 'fulltipusincidencies']);
    Route::get('tipus_incidencia/{theobj}', [TipusIncidenciaController::class, 'thetipusincidencia']);

    Route::get('tipus_recursos', [TipusRecursController::class, 'fulltipusrecursos']);
    Route::get('tipus_recurso/{theobj}', [TipusRecursController::class, 'thetipusrecurso']);

    Route::get('rols', [RolController::class, 'fullrols']);
    Route::get('rol/{theobj}', [RolController::class, 'therol']);

    Route::get('comarques', [ComarcaController::class, 'fullcomarques']);
    Route::get('comarca/{theobj}', [ComarcaController::class, 'thecomarca']);

    Route::get('provincies', [ProvinciaController::class, 'fullprovincies']);
    Route::get('provincia/{theobj}', [ProvinciaController::class, 'theprovincia']);

    Route::get('sexes', [SexeController::class, 'fullsexes']);
    Route::get('sexe/{theobj}', [SexeController::class, 'thesexe']);

    Route::get( 'municipis', [MunicipiController::class, 'fullmunicipis'] );
    Route::get( 'municipi/{theobj}', [MunicipiController::class, 'themunicipi'] );

    Route::get( 'centressanitaris', [AlertantController::class, 'centressanitaris'] );

    Route::post( 'usuari/config/{theobj}', [UsuariController::class, 'updateconfig'] );
    Route::get( 'usuari/{theobj}', [UsuariController::class, 'getuserdata'] );
    Route::get( 'usuaris', [UsuariController::class, 'getalluserdata'] );

    Route::get('valoracions', [CodisValoracioController::class, 'fullvaloracions']);
    Route::get('valoracio/{theobj}', [CodisValoracioController::class, 'thevaloracio']);

    Route::get('gravetats', [CodisGravetatController::class, 'fullgravetats']);
    Route::get('gravetat/{theobj}', [CodisGravetatController::class, 'thegravetat']);



//});
