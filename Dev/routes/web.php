<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SexeController;
use App\Http\Controllers\RecursController;
use App\Http\Controllers\UsuariController;
use App\Http\Controllers\AfectatController;
use App\Http\Controllers\ComarcaController;
use App\Http\Controllers\VdsPlayController;
use App\Http\Controllers\AlertantController;
use App\Http\Controllers\MunicipiController;
use App\Http\Controllers\CodisSEM3Controller;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\VdsEventsController;
use App\Http\Controllers\VdsVideosController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\TipusRecursController;
use App\Http\Controllers\CodisIntercoController;
use App\Http\Controllers\HlpSimptomesController;
use App\Http\Controllers\HlpValoracioController;
use App\Http\Controllers\CodisGravetatController;
use App\Http\Controllers\TipusAlertantController;
use App\Http\Controllers\CodisValoracioController;
use App\Http\Controllers\HlpFormElementsController;
use App\Http\Controllers\TipusIncidenciaController;
use App\Http\Controllers\IncidenciesHasRecursosController;

Route::get('/login', [UsuariController::class, 'showLogin'])->name('login');
Route::post('/login', [UsuariController::class, 'login'] );
Route::get('/logout', [UsuariController::class, 'logout'])->name('logout');

Route::get('/', function () {

    if (Auth::check()) {

        //echo '<script>console.log("RedirectIfAuthenticated.php -> handle -> redirect")</script>';

        switch(Auth::user()->rols_id) {
            case 1: // Admin
                return redirect()->route('admin');
                break;
            case 2: // CECOS
                return redirect()->route('operator');
                break;
            case 3: // Recurs
                return redirect()->route('mobile');
                break;
            default: // to login
                return redirect()->route('login');
        }

    } else {

        return redirect()->route('login');

    }

});

//Route::middleware(['auth'])->group( function() {
Route::group(['middleware' => ['web']], function () {

    Route::get('/home', function () { return view('home'); });

    Route::view('/admin', 'admin.index')->name('admin');
    //get('/admin', function () { return view('/admin','admin', [Auth::user()]); })->name('admin');


    Route::resource('admin/incidencies', IncidenciaController::class)->parameters(['incidencies' => 'theobj']);

    Route::resource('admin/afectats', AfectatController::class)->parameters(['afectats' => 'theobj']);
    Route::resource('admin/alertants', AlertantController::class)->parameters(['alertants' => 'theobj']);
    Route::resource('admin/recursos', RecursController::class)->parameters(['recursos' => 'theobj']);
    Route::resource('admin/usuaris', UsuariController::class)->parameters(['usuaris' => 'theobj']);

    Route::resource('admin/tipus/tipus_alertants', TipusAlertantController::class)->parameters(['tipus_alertants' => 'theobj']);
    Route::resource('admin/tipus/tipus_incidencies', TipusIncidenciaController::class)->parameters(['tipus_incidencies' => 'theobj']);
    Route::resource('admin/tipus/tipus_recursos', TipusRecursController::class)->parameters(['tipus_recursos' => 'theobj']);

    Route::resource('admin/xtras/rols', RolController::class)->parameters(['rols' => 'theobj']);
    Route::resource('admin/xtras/municipis', MunicipiController::class)->parameters(['municipis' => 'theobj']);
    Route::resource('admin/xtras/comarques', ComarcaController::class)->parameters(['comarques' => 'theobj']);
    Route::resource('admin/xtras/provincies', ProvinciaController::class)->parameters(['provincies' => 'theobj']);
    Route::resource('admin/xtras/sexes', SexeController::class)->parameters(['sexes' => 'theobj']);

    Route::resource('admin/xtras/codis/interco', CodisIntercoController::class)->parameters(['interco' => 'theobj']);
    Route::resource('admin/xtras/codis/sem3', CodisSEM3Controller::class)->parameters(['sem3' => 'theobj']);
    Route::resource('admin/xtras/codis/gravetat', CodisGravetatController::class)->parameters(['gravetat' => 'theobj']);
    Route::resource('admin/xtras/codis/valoracio', CodisValoracioController::class)->parameters(['valoracio' => 'theobj']);

    Route::resource('admin/video/videos', VdsVideosController::class)->parameters(['videos' => 'theobj']);
    Route::resource('admin/video/play', VdsPlayController::class)->parameters(['play' => 'theobj']);
    Route::resource('admin/video/events', VdsEventsController::class)->parameters(['events' => 'theobj']);

    Route::resource('admin/help/valoracio', HlpValoracioController::class)->parameters(['valoracio' => 'theobj']);
    Route::resource('admin/help/simptomes', HlpSimptomesController::class)->parameters(['simptomes' => 'theobj']);
    Route::resource('admin/help/formelements', HlpFormElementsController::class)->parameters(['formelements' => 'theobj']);


    Route::get('operator', [IncidenciaController::class, 'operator'])->name('operator');
    //Route::get('operator', function () { return view('operator.index'); })->name('operator');


    Route::get('mobile', function () { return view('mobile.index'); })->name('mobile');


});

Route::get('/clearcache', function() {

    $notice = '';

    $notice.= ' / APPLICATION';
    // Laravel Clear APPLICATION Cache On Shared Hosting
    $exitCode = Artisan::call('cache:clear');

    $notice.= ' / VIEW';
    // Laravel Clear VIEW Cache On Shared Hosting
    $exitCode = Artisan::call('view:clear');

    // $notice.= ' / ROUTE';
    // Laravel Clear ROUTE Cache On Shared Hosting
    // $exitCode = Artisan::call('route:cache');

    $notice.= ' / CONFIG';
    // Laravel Clear CONFIG Cache On Shared Hosting
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('config:cache');


    $notice.= ' cleared';

    return $notice;

});



