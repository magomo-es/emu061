@extends('_layouts.admin')

@section('pageTitle', 'Edit Usuaris | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Usuari</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\UsuariController::class, 'update'], ['theobj' => $theobj->id] ) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group row">

                <div class="col-4">
                    <div class="row">
                        <label for="xusername" class="col-3 col-form-label pr-1"><small>Username</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="xusername" name="xusername" value="{{ $theobj->username }}">
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="row">
                        <label for="xcontrasenya" class="col-3 col-form-label"><small>Contrasenya</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="xcontrasenya" name="xcontrasenya" value="{{ $theobj->contrasenya }}">
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="row">
                        <label for="xemail" class="col-3 col-form-label"><small>Email</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="xemail" name="xemail" value="{{ $theobj->email }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <div class="col-6">
                    <div class="row">
                        <label for="xnom" class="col-sm-2 col-form-label"><small>Nom</small></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="xnom" name="xnom" value="{{ $theobj->nom }}">
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <label for="xcognoms" class="col-sm-2 col-form-label"><small>Cognoms</small></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="xcognoms" name="xcognoms" value="{{ $theobj->cognoms }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <div class="col-6">
                    <div class="row">
                        <label for="xrolsid" class="col-sm-2 col-form-label"><small>Provincia</small></label>
                        <div class="col-sm-10">
                            <select class="custom-select" id="xrolsid" name="xrolsid">
                                @foreach ($rolsAry as $rol)
                                <option value="{{ $rol->id }}" {{ (($theobj->rols_id==$rol->id)?'selected':'') }}>{{ $rol->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <label for="xrecursosid" class="col-sm-2 col-form-label"><small>Recursos</small></label>
                        <div class="col-sm-10">
                            <select class="custom-select" id="xrecursosid" name="xrecursosid">
                                <option value="">Sin recurso</option>
                                @foreach ($recursosAry as $recurs)
                                <option value="{{ $recurs->id }}" {{ (($theobj->recursos_id==$recurs->id)?'selected':'') }}>{{ $recurs->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action([App\Http\Controllers\UsuariController::class, 'index']) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>



@endsection
