@extends('_layouts.admin')

@section('pageTitle', 'Nou Codi 3 SEM | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nou Codi 3 SEM</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\CodisSEM3Controller::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">

                <div class="col-4">
                    <div class="row">
                        <label for="title" class="col-2 col-form-label"><small>Codi</small></label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="codi" name="codi" value="{{ old('codi') }}">
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="row">
                        <label for="nom" class="col-1 col-form-label"><small>Nom</small></label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\CodisSEM3Controller::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>


@endsection
