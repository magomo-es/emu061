@extends('_layouts.admin')

@section('pageTitle', 'Nou Provincia | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nou Help FormElements</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\HlpFormElementsController::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">

                <div class="col-6">
                    <div class="row">
                        <label for="title" class="col-2 col-form-label"><small>Titul</small></label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <label for="tagid" class="col-2 col-form-label"><small>Id Etiqueta</small></label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="tagid" name="tagid" value="{{ old('tagid') }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <div class="col">
                    <div class="row">
                        <label for="description" class="col-1 col-form-label pr-1"><small>Descripcio</small></label>
                        <div class="col-11">
                            <textarea rows="6" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\HlpFormElementsController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>


@endsection
