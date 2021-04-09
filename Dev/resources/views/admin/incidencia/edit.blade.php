@extends('_layouts.admin')

@section('pageTitle', 'Edit Incidencia | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Incident</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\IncidenciaController::class, 'update'], ['theobj' => $theobj->id] ) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group row">

                <div class="col-4">
                    <div class="row">
                        <label for="xnumincident" class="col-3 col-form-label"><small>Incident</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="xnumincident" name="xnumincident" value="{{ $theobj->num_incident }}">
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="row">
                        <label for="xdata" class="col-4 col-form-label"><small>Data</small></label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="xdata" name="xdata" value="{{ $theobj->data }}">
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="row">
                        <label for="xhora" class="col-4 col-form-label"><small>Hora</small></label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="xhora" name="xhora" value="{{ $theobj->hora }}">
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="row">
                        <label for="xtelefonalertant" class="col-3 col-form-label"><small>Tel.Alertant</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="xtelefonalertant" name="xtelefonalertant" value="{{ $theobj->telefon_alertant }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <label for="xadreca" class="col-1 col-form-label"><small>Adreça</small></label>
                <div class="col-11">
                    <input type="text" class="form-control" id="xadreca" name="xadreca" value="{{ $theobj->adreca }}">
                </div>

            </div>

            <div class="form-group row">

                <div class="col-6">
                    <div class="row">
                        <label for="xadrecacomplement" class="col-2 col-form-label"><small>Adreça comp</small></label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="xadrecacomplement" name="xadrecacomplement" value="{{ $theobj->adreca_complement }}">
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <label for="xmunicipisid" class="col-2 col-form-label"><small>Municipi</small></label>
                        <div class="col-10">
                            <select class="custom-select" id="xmunicipisid" name="xmunicipisid">
                                @foreach ($municipisAry as $municipi)
                                <option value="{{ $municipi->id }}" {{ (($theobj->municipis_id==$municipi->id)?'selected':'') }}>{{ $municipi->nom }}</option>
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
                            <textarea rows="6" class="form-control" id="xdescripcio" name="xdescripcio">{{ $theobj->descripcio }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <div class="col-3">
                    <div class="row">
                        <label for="xnommetge" class="col-4 col-form-label pr-1"><small>Metge</small></label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="xnommetge" name="xnommetge" value="{{ $theobj->nom_metge }}">
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="xtipusincidenciesid" class="col-3 col-form-label"><small>Tipus</small></label>
                        <div class="col-9">
                            <select class="custom-select" id="xtipusincidenciesid" name="xtipusincidenciesid">
                                @foreach ($tipusAry as $tipus)
                                <option value="{{ $tipus->id }}" {{ (($theobj->tipus_incidencies_id==$tipus->id)?'selected':'') }}>{{ $tipus->tipus }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="xalertantsid" class="col-3 col-form-label"><small>Alertant</small></label>
                        <div class="col-9">
                            <select class="custom-select" id="xalertantsid" name="xalertantsid">
                                @foreach ($alertantsAry as $alertant)
                                <option value="{{ $alertant->id }}" {{ (($theobj->alertants_id==$alertant->id)?'selected':'') }}>{{ $alertant->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="xusuarisid" class="col-3 col-form-label"><small>Usuari</small></label>
                        <div class="col-9">
                            <select class="custom-select" id="xusuarisid" name="xusuarisid">
                                @foreach ($usuarisAry as $usuari)
                                <option value="{{ $usuari->id }}" {{ (($theobj->usuaris_id==$usuari->id)?'selected':'') }}>{{ $usuari->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action([App\Http\Controllers\IncidenciaController::class, 'index']) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>



@endsection
