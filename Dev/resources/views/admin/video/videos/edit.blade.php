@extends('_layouts.admin')

@section('pageTitle', 'Edit Video | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Video</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\VdsVideosController::class, 'update'], ['theobj' => $theobj->id] ) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group row">

                <label for="title" class="col-1 col-form-label"><small>Titul</small></label>
                <div class="col-11">
                    <input type="text" class="form-control" id="title" name="title" value="{{ $theobj->title }}">
                </div>

            </div>

            <div class="form-group row">

                <label for="description" class="col-1 col-form-label pr-1"><small>Descripcio</small></label>
                <div class="col-11">
                    <textarea rows="6" class="form-control" id="description" name="description">{{ $theobj->description }}</textarea>
                </div>

            </div>

            <div class="form-group row p-3">

                <div for="description" class="col-1 col-form-label"></div>
                <div class="custom-file col-11 p-0">
                    <input type="file" class="custom-file-input" id="filename" name="filename">
                    <label class="custom-file-label" for="filename">Arxiu Video</label>
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
