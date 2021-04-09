@extends('_layouts.admin')

@section('pageTitle', 'Nou Afectat | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nou Afectat</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\AfectatController::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">

                <div class="col-4">
                    <div class="row">
                        <label for="xtelefon" class="col-3 col-form-label pr-1"><small>Telefon</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="xtelefon" name="xtelefon" value="{{ old('xtelefon') }}">
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="row">
                        <label for="xnom" class="col-3 col-form-label pr-1"><small>Nom</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="xnom" name="xnom" value="{{ old('xnom') }}">
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="row">
                        <label for="xcognoms" class="col-3 col-form-label pr-1"><small>Congnoms</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="xcognoms" name="xcognoms" value="{{ old('xcognoms') }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <div class="col-3">
                    <div class="row">
                        <label for="xcip" class="col-4 col-form-label pr-1"><small>CIP</small></label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="xcip" name="xcip" value="{{ old('xcip') }}">
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="row">
                        <label for="xedat" class="col-3 col-form-label pr-1"><small>Edat</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="xedat" name="xedat" value="{{ old('xedat') }}">
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="xsexesid" class="col-2 col-form-label"><small>Sexe</small></label>
                        <div class="col-10">
                            <select class="custom-select" id="xsexesid" name="xsexesid">
                                @foreach ($sexesAry as $sexe)
                                <option value="{{ $sexe->id }}" {{ ((old('xsexesid')==$sexe->id)?'selected':'') }}>{{ $sexe->sexe }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="row">
                        <label for="xtipusrecursosid" class="col-3 col-form-label"><small>Tipus Recurso</small></label>
                        <div class="col-9">
                            <select class="custom-select" id="xtipusrecursosid" name="xtipusrecursosid">
                                <option value="0">...seleccioneu tipus recuro</option>
                                @foreach ($tipusrecursosAry as $tipusrecursos)
                                <option value="{{ $tipusrecursos->id }}" {{ ((old('xtipusrecursosid')==$tipusrecursos->id)?'selected':'') }}>{{ $tipusrecursos->tipus }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <div class="col">
                    <div class="row">
                        <label for="xdescripcio" class="col-1 col-form-label pr-1"><small>Descripcio</small></label>
                        <div class="col-11">
                            <textarea rows="6" class="form-control" id="xdescripcio" name="xdescripcio">{{ old('xdescripcio') }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action([App\Http\Controllers\AfectatController::class, 'index']) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>


@endsection
