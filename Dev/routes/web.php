<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CicleController;
use App\Http\Controllers\CursController;


Route::get('/', function () { return view('index'); });

Route::resource('cicles', CicleController::class);

Route::resource('cursos', CursController::class)->parameters(['cursos' => 'curs']);;

Route::resource('modules', ModulController::class)->parameters(['modules' => 'modul']);;
