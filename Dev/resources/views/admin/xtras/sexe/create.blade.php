@extends('_layouts.admin')

@section('pageTitle', 'Nou Sexe | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nou Sexe</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\SexeController::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">
                <label for="xsexe" class="col-sm-2 col-form-label">Sexe</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xsexe" name="xsexe" value="{{ old('xsexe') }}">
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
