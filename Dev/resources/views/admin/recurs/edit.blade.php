@extends('_layouts.admin')

@section('pageTitle', 'Edit Recurs | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Recurs</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\RecursController::class, 'update'], ['theobj' => $theobj->id] ) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group row">

                <div class="col-4">
                    <div class="row">
                        <label for="xcodi" class="col-3 col-form-label pr-1"><small>Codi</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="xcodi" name="xcodi" value="{{ $theobj->codi }}">
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <label for="xtipusrecursosid" class="col-3 col-form-label"><small>Tipus</small></label>
                        <div class="col-9">
                            <select class="custom-select" id="xtipusrecursosid" name="xtipusrecursosid">
                                @foreach ($tipusAry as $type)
                                <option value="{{ $type->id }}" {{ (($theobj->tipus_recursos_id==$type->id)?'selected':'') }}>{{ $type->tipus }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="row">
                        <label for="xactiu" class="col-6 col-form-label align-right"><small>Actiu</small></label>
                        <div class="col-6 pl-2">
                            <input class="form-check-input ml-1" type="checkbox" value="1" id="xactiu" name="xactiu" {{ (($theobj->actiu)==1)?'checked':'' }}>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action([App\Http\Controllers\RecursController::class, 'index']) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>



@endsection
