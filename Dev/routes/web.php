<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SexeController;
use App\Http\Controllers\RecursController;
use App\Http\Controllers\UsuariController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\AfectatController;
use App\Http\Controllers\ComarcaController;
use App\Http\Controllers\AlertantController;
use App\Http\Controllers\MunicipiController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\TipusRecursController;
use App\Http\Controllers\VideoEventsController;
use App\Http\Controllers\FormElementsController;
use App\Http\Controllers\TipusAlertantController;
use App\Http\Controllers\TipusIncidenciaController;
use App\Http\Controllers\PlayVideoByCallerController;
use App\Http\Controllers\IncidenciesHasRecursosController;

Route::get('/', function () { return view('index'); });

Route::get('/admin', function () { return view('admin.index'); });

Route::resource('admin/incidencies', IncidenciaController::class)->parameters(['incidencies' => 'theobj']);

Route::resource('admin/incidencies_has_recursos', IncidenciesHasRecursosController::class)->parameters(['incidencies_has_recursos' => 'theobj']);

Route::resource('admin/afectats', AfectatController::class)->parameters(['afectats' => 'theobj']);
Route::resource('admin/alertants', AlertantController::class)->parameters(['alertants' => 'theobj']);
Route::resource('admin/recursos', RecursController::class)->parameters(['recursos' => 'theobj']);
Route::resource('admin/usuaris', UsuariController::class)->parameters(['usuaris' => 'theobj']);

Route::resource('admin/tipus_alertants', TipusAlertantController::class)->parameters(['tipus_alertants' => 'theobj']);
Route::resource('admin/tipus_incidencies', TipusIncidenciaController::class)->parameters(['tipus_incidencies' => 'theobj']);
Route::resource('admin/tipus_recursos', TipusRecursController::class)->parameters(['tipus_recursos' => 'theobj']);

Route::resource('admin/rols', RolController::class)->parameters(['rols' => 'theobj']);
Route::resource('admin/municipis', MunicipiController::class)->parameters(['municipis' => 'theobj']);
Route::resource('admin/comarques', ComarcaController::class)->parameters(['comarques' => 'theobj']);
Route::resource('admin/provincies', ProvinciaController::class)->parameters(['provincies' => 'theobj']);
Route::resource('admin/sexes', SexeController::class)->parameters(['sexes' => 'theobj']);

Route::resource('admin/formelements', FormElementsController::class)->parameters(['formelements' => 'theobj']);
Route::resource('admin/videos', VideosController::class)->parameters(['videos' => 'theobj']);
Route::resource('admin/playvideobycaller', PlayVideoByCallerController::class)->parameters(['playvideobycaller' => 'theobj']);
Route::resource('admin/videoevents', VideoEventsController::class)->parameters(['videoevents' => 'theobj']);

Route::get('/operator', function () { return view('operator.index'); });

Route::get('/mobile', function () { return view('mobile.index'); });
