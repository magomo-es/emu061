@extends('_layouts.admin')

@section('pageTitle', 'Edit Tipus Incidencies | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Tipus Incidencies</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\TipusIncidenciaController::class, 'update'], ['theobj' => $theobj->id] ) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="xtipus" class="col-sm-2 col-form-label">Tipus</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xtipus" name="xtipus" value="{{ $theobj->tipus }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="xvideo" class="col-sm-2 col-form-label">Video</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xvideo" name="xvideo" value="{{ $theobj->video }}">
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
