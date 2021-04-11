@extends('_layouts.admin')

@section('pageTitle', 'Edit Simptoma (anglés) | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Simptoma (anglés)</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\HlpSimptomesController::class, 'update'], ['theobj' => $theobj->id] ) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group row">

                <label for="pregunta" class="col-1 col-form-label"><small>Pregunta</small></label>
                <div class="col-11">
                    <input type="text" class="form-control" id="pregunta" name="pregunta" value="{{ $theobj->pregunta }}">
                </div>

            </div>
            <div class="form-group row">

                <label for="translation" class="col-1 col-form-label"><small>Traduccio</small></label>
                <div class="col-11">
                    <input type="text" class="form-control" id="translation" name="translation" value="{{ $theobj->translation }}">
                </div>

            </div>
            <div class="form-group row">

                <label for="soundlike" class="col-1 col-form-label"><small>Soundlike</small></label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="soundlike" name="soundlike" value="{{ $theobj->soundlike }}">
                    </div>
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
