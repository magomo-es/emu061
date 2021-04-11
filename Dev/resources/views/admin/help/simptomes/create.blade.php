@extends('_layouts.admin')

@section('pageTitle', 'Nou Simptoma (anglés) | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nou Simptoma (anglés)</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\HlpSimptomesController::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">

                <label for="pregunta" class="col-1 col-form-label"><small>Pregunta</small></label>
                <div class="col-11">
                    <input type="text" class="form-control" id="pregunta" name="pregunta" value="{{ old('pregunta') }}">
                </div>

            </div>
            <div class="form-group row">

                <label for="translation" class="col-1 col-form-label"><small>Traduccio</small></label>
                <div class="col-11">
                    <input type="text" class="form-control" id="translation" name="translation" value="{{ old('translation') }}">
                </div>

            </div>
            <div class="form-group row">

                <label for="soundlike" class="col-1 col-form-label"><small>Soundlike</small></label>
                <div class="col-11">
                    <input type="text" class="form-control" id="soundlike" name="soundlike" value="{{ old('soundlike') }}">
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\HlpSimptomesController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>


@endsection
