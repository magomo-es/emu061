@extends('_layouts.admin')

@section('pageTitle', 'Nou Tipus Incidencies | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nou Tipus Incidencies</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\TipusIncidenciaController::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">
                <label for="xtipus" class="col-sm-2 col-form-label">Tipus</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xtipus" name="xtipus" value="{{ old('xtipus') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="xvideo" class="col-sm-2 col-form-label">Video</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xvideo" name="xvideo" value="{{ old('xvideo') }}">
                </div>
            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\TipusIncidenciaController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>


@endsection
