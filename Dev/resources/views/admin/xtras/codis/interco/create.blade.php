@extends('_layouts.admin')

@section('pageTitle', 'Nou Codis Interco | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nou Codi Interco</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\CodisIntercoController::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">

                <div class="col-3">
                    <div class="row">
                        <label for="title" class="col-4 col-form-label"><small>Codi</small></label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="codi" name="codi" value="{{ $theobj->codi }}">
                        </div>
                    </div>
                </div>

                <div class="col-9">
                    <div class="row">
                        <label for="nom" class="col-2 col-form-label"><small>Nom</small></label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $theobj->nom }}">
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="row">
                        <label for="soundlike" class="col-2 col-form-label"><small>Soundlike</small></label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="soundlike" name="soundlike" value="{{ $theobj->soundlike }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\CodisIntercoController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>


@endsection
