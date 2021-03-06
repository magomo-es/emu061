@extends('_layouts.admin')

@section('pageTitle', 'Nou Provincia | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nou Provincia</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\ProvinciaController::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">
                <label for="xnom" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xnom" name="xnom" value="{{ old('xnom') }}">
                </div>
            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\ProvinciaController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>


@endsection
