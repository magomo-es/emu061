<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('admin/incidencies', IncidenciaController::class)->parameters(['incidencies' => 'theobj']);

Route::apiResource('admin/afectats', AfectatController::class)->parameters(['afectats' => 'theobj']);
Route::apiResource('admin/alertants', AlertantController::class)->parameters(['alertants' => 'theobj']);
Route::apiResource('admin/recursos', RecursController::class)->parameters(['recursos' => 'theobj']);
Route::apiResource('admin/usuaris', UsuariController::class)->parameters(['usuaris' => 'theobj']);

Route::apiResource('admin/tipus_alertants', TipusAlertantController::class)->parameters(['tipus_alertants' => 'theobj']);
Route::apiResource('admin/tipus_incidencies', TipusIncidenciaController::class)->parameters(['tipus_incidencies' => 'theobj']);
Route::apiResource('admin/tipus_recursos', TipusRecursController::class)->parameters(['tipus_recursos' => 'theobj']);

Route::apiResource('admin/rols', RolController::class)->parameters(['rols' => 'theobj']);
Route::apiResource('admin/municipis', MunicipiController::class)->parameters(['municipis' => 'theobj']);
Route::apiResource('admin/comarques', ComarcaController::class)->parameters(['comarques' => 'theobj']);
Route::apiResource('admin/provincies', ProvinciaController::class)->parameters(['provincies' => 'theobj']);
Route::apiResource('admin/sexes', SexeController::class)->parameters(['sexes' => 'theobj']);
