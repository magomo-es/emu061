@extends('_layouts.main')

@section('pageTitle', 'Inicio | emu061 - Emulador de Sistema de Emergencias 061')

@section('pageContent')

<div class="offset-lg-3 col-lg-6 mt-5">

    @include('_partials.mensajes')

    <div class="card">

        <div class="card-header bg-secondary text-light">Login</div>

        <div class="card-body">

            <form action="{{ action([App\Http\Controllers\UsuariController::class, 'login']) }}" method="POST">

                @csrf

                <div class="form-group row">

                    <label for="correu" class="col-sm-2 col-form-label">Correu</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="correu" name="correu" autofocus value="{{ old('correu') }}">
                    </div>

                </div>

                <div class="form-group row">

                    <label for="contrasenya" class="col-sm-2 col-form-label">Contrasenya</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="contrasenya" name="contrasenya" value="{{ old('contrasenya') }}">
                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-12">

                        <a href="{{ url('/') }}" class="btn btn-secondary float-right ml-1"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>

                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-check" aria-hidden="true"></i> Aceptar</button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection




