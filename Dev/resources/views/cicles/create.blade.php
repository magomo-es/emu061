@extends('layouts.main')

@section('pageTitle', 'Craete Cicle | CEP')

@section('pageContent')

@include('partials.mensajes')

<div class="card">

    <div class="card-header">Cicle</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\CicleController::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">
                <label for="xsigles" class="col-sm-2 col-form-label">Sigles</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xsigles" name="xsigles" value="{{ old('xsigles') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="xnom" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xnom" name="xnom" value="{{ old('xnom') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="xdescripcio" class="col-sm-2 col-form-label">Descripcio</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="xdescripcio" name="xdescripcio" rows="5">{{ old('xdescripcio') }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="xactiu" class="col-sm-2 col-form-label">Actiu</label>
                <div class="col-sm-10 pl-2">
                    <input class="form-check-input ml-1" type="checkbox" value="1" id="xactiu" name="xactiu" {{ ((old('xactiu'))?'checked':'') }}>
                </div>
            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="/cicles">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>


@endsection
