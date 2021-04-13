@extends('_layouts.admin')

@section('pageTitle', 'Nou Video | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nou Video</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\VdsVideosController::class, 'store'] ) }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group row">

                <label for="title" class="col-1 col-form-label"><small>Titul</small></label>
                <div class="col-11">
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                </div>

            </div>

            <div class="form-group row">

                <label for="description" class="col-1 col-form-label pr-1"><small>Descripcio</small></label>
                <div class="col-11">
                    <textarea rows="6" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                </div>

            </div>

            <div class="form-group row px-3">

                <div for="description" class="col-1 col-form-label">Video</div>
                <div class="custom-file col-5 p-0">
                    <input type="text" class="form-control" value="{{ old('filename') }}" readonly>
                </div>
                <div for="description" class="col-1 col-form-label"></div>
                <div class="custom-file col-5 p-0">
                    <input type="file" class="custom-file-input" id="filename" name="filename">
                    <label class="custom-file-label" for="filename">Seleccio Arxiu de Video</label>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\VdsVideosController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>


@endsection
