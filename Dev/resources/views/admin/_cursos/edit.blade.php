@extends('_layouts.admin')

@section('pageTitle', 'Craete Cicle | CEP')

@section('pageContent')

@include('partials.mensajes')

<script>console.log("* Esta haciendo un ... {{ (($insert) ? 'Insert' : 'I dont know') }}")</script>

<div class="card">

    <div class="card-body">

        <h5>Cursos</h5>

        <form action="{{ action( [App\Http\Controllers\CursController::class, 'update'], ['curs' => $curs->id]) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="xsigles" class="col-sm-2 col-form-label">Sigles</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xsigles" name="xsigles" value="{{ (old('xsigles')) ? old('xsigles') : $curs->sigles }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="xnom" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xnom" name="xnom" value="{{ (old('xnom')) ? old('xnom') : $curs->sigles }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="xciclesid" class="col-sm-2 col-form-label">Cicle</label>
                <div class="col-sm-10">
                    <select class="custom-select" id="xciclesid" name="xciclesid">
                        @foreach ($cicles as $cicle)
                        <option value="{{ $cicle->id }}" {{ ($cicle->id==$curs->cicles_id) ? 'selected' : '' }}>{{ $cicle->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="xactiu" class="col-sm-2 col-form-label">Actiu</label>
                <div class="col-sm-10">
                    <input class="form-check-input mt-3 ml-1" type="checkbox" value="1" id="xactiu" name="xactiu" {{ (((old('xactiu')) ? old('xactiu') : $curs->actiu)==1)?'checked':'' }}>
                </div>
            </div>

            <div class="text-right">

                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Aceptar</button>
                <a class="btn btn-secondary" href="{{ action([App\Http\Controllers\CursController::class, 'index']) }}"><i class="fas fa-times"></i> Cancel.lar</a>

            </div>

        </form>

    </div>

</div>



@endsection
