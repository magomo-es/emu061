@extends('_layouts.main')

@section('pageTitle', 'Inicio | emu061 - Emulador de Sistema de Emergencias 061')

@section('pageContent')

<div id="app"></div>

<div class="offset-lg-3 col-lg-6 mt-5">

    @include('_partials.mensajes')

    <div class="card">

        <div class="card-header bg-secondary text-light">Login</div>

        <div class="card-body">

            <form action="{{ action([App\Http\Controllers\UsuariController::class, 'login']) }}" method="POST">

                @csrf

                <div class="form-group row">

                    <input type="text" class="form-control" id="username" name="username" autofocus value="{{ old('username') }}" placeholder="Usuari" />

                </div>

                <div class="form-group row">

                    <input type="password" class="form-control" id="contrasenya" name="contrasenya" value="{{ old('contrasenya') }}" placeholder="Contrasenya" />

                </div>

                <div class="form-group row">

                    <div class="col-sm-12">

                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-check" aria-hidden="true"></i> Enviar</button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection




