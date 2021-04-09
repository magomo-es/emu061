@extends('_layouts.admin')

@section('pageTitle', 'Edit Sexe | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Sexe</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\SexeController::class, 'update'], ['theobj' => $theobj->id] ) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="xsexe" class="col-sm-2 col-form-label">Sexe</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xsexe" name="xsexe" value="{{ $theobj->sexe }}">
                </div>
            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\SexeController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>



@endsection
