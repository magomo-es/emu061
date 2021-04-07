@extends('_layouts.admin')

@section('pageTitle', 'Craete Cicle | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nou Alertant</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\AlertantController::class, 'store'] ) }}" method="POST">

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

                <div class="col">
                    <div class="row">
                        <label for="xadreca" class="col-1 col-form-label pr-1"><small>Adreça</small></label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="xadreca" name="xadreca" value="{{ old('xadreca') }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <div class="col-6">
                    <div class="row">
                        <label for="xmunicipisid" class="col-2 col-form-label"><small>Municipi</small></label>
                        <div class="col-10">
                            <select class="custom-select" id="xmunicipisid" name="xmunicipisid">
                                @foreach ($municipisAry as $municipi)
                                <option value="{{ $municipi->id }}" {{ ((old('xmunicipisid')==$municipi->id)?'selected':'') }}>{{ $municipi->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <label for="xtipusalertantsid" class="col-2 col-form-label"><small>Tipus</small></label>
                        <div class="col-10">
                            <select class="custom-select" id="xtipusalertantsid" name="xtipusalertantsid">
                                @foreach ($tipusAry as $type)
                                <option value="{{ $type->id }}" {{ ((old('xtipusalertantsid')==$type->id)?'selected':'') }}>{{ $type->tipus }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action([App\Http\Controllers\AlertantController::class, 'index']) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>


@endsection
