@extends('_layouts.admin')

@section('pageTitle', 'Edit Codi Gravetat | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Codi Gravetat</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\CodisGravetatController::class, 'update'], ['theobj' => $theobj->codi] ) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group row">

                <div class="col-4">
                    <div class="row">
                        <label for="title" class="col-2 col-form-label"><small>Codi</small></label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="codi" name="codi" value="{{ $theobj->codi }}">
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="row">
                        <label for="nom" class="col-1 col-form-label"><small>Nom</small></label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="nom" name="nom" value="{{$theobj->nom }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\CodisGravetatController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>



@endsection
