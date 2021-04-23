@extends('_layouts.admin')

@section('pageTitle', 'Nova Incidencia | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nova Incidencia</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\IncidenciaController::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">

                <div class="col-12">
                    <div class="row">

                        <div class="col-3">
                            <div class="row">
                                <label for="numincident" class="col-12 col-form-label"><small>Id Incidencia</small></label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="numincident" name="numincident" value="{{ (old('numincident'))?old('numincident'):rand(10000,10000000) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="row">
                                <label for="data" class="col-12 col-form-label"><small>Data</small></label>
                                <div class="col-12">
                                    <input type="date" class="form-control" id="data" name="data"
                                    min="{{ date('Y-m-d',time()-86400) }}" max="{{ date('Y-m-d',time()+86400) }}"
                                    value="{{ (!empty(old('data'))?old('data'):date('Y-m-d',time())) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="row">
                                <label for="hora" class="col-12 col-form-label"><small>Hora</small></label>
                                <div class="col-12">
                                    <input type="time" class="form-control" id="hora" name="hora"
                                        value="{{ (!empty(old('hora'))?old('hora'):date('H:i',time())) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="row">
                                <label for="telefonalertant" class="col-12 col-form-label"><small>Telefon</small></label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="telefonalertant" name="telefonalertant" value="{{ old('telefonalertant') }}" pattern="[0-9]{9}" minlength="9" maxlength="9">
                                </div>
                                <div class="col-4">
                                    <button id="addAlertant" type="button" class="btn btn-primary w-100 px-3" data-toggle="modal" data-target="#modalAlertant">Alertant</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="row">

                        <label for="adreca" class="col-12 col-form-label"><small>Adreça</small></label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="adreca" name="adreca" value="{{ old('adreca') }}" required>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="row">

                        <div class="col-6">
                            <div class="row">
                                <label for="adrecacomplement" class="col-12 col-form-label"><small>Adreça comp</small></label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="adrecacomplement" name="adrecacomplement" value="{{ old('adrecacomplement') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <label for="municipisid" class="col-12 col-form-label"><small>Municipi</small></label>
                                <div class="col-12">
                                    <select class="custom-select" id="municipisid" name="municipisid">
                                        @foreach ($municipisAry as $municipi)<option value="{{ $municipi->id }}" {{ ((old('municipisid')==$municipi->id)?'selected':'') }}>{{ $municipi->nom }}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="row">

                        <div class="col">
                            <div class="row">
                                <label for="descripcio" class="col-12 col-form-label pr-1"><small>Descripció</small></label>
                                <div class="col-12">
                                    <textarea rows="4" class="form-control" id="descripcio" name="descripcio" required>{{ old('descripcio') }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="row">

                        <div class="col-4">
                            <div class="row">
                                <label for="nommetge" class="col-12 col-form-label pr-1"><small>Metge</small></label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="nommetge" name="nommetge" value="{{ old('nommetge') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="row">
                                <label for="tipusincidenciesid" class="col-12 col-form-label"><small>Tipus</small></label>
                                <div class="col-12">
                                    <select class="custom-select" id="tipusincidenciesid" name="tipusincidenciesid">
                                        @foreach ($tipusAry as $tipus)<option value="{{ $tipus->id }}" {{ ((old('tipusincidenciesid')==$tipus->id)?'selected':'') }}>{{ $tipus->tipus }}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="row">
                                <label for="usuarisid" class="col-12 col-form-label"><small>Usuari</small></label>
                                <div class="col-12">
                                    <select class="custom-select" id="usuarisid" name="usuarisid">
                                        @foreach ($usuarisAry as $usuari)<option value="{{ $usuari->id }}" {{ ((old('usuarisid')==$usuari->id)?'selected':'') }}>{{ $usuari->nom }}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Afectats Table VUE -->
            <div class="form-group row" id="app"
                data-pafectats='{!! "[]" !!}'
                data-palertants='{!! ($alertantsAry)?str_replace("'", '´', $alertantsAry->toJson()):"[]" !!}'
                data-pdestins='{!! ($destinsAry)?str_replace("'", '´', $destinsAry->toJson()):"[]" !!}'
                data-psexes='{!! ($sexesAry)?str_replace("'", '´', $sexesAry->toJson()):"[]" !!}'
                data-ptipusrecursos='{!! ($tipusrecursosAry)?str_replace("'", '´', $tipusrecursosAry->toJson()):"[]" !!}'
                data-precursos='{!! ($recursosAry)?str_replace("'", '´', $recursosAry->toJson()):"[]" !!}'
                data-pcodisgravetat='{!! ($codisgravetatAry)?str_replace("'", '´', $codisgravetatAry->toJson()):'[]' !!}'
                data-pcodisvaloracions='{!! ($codisvaloracionsAry)?str_replace("'", '´', $codisvaloracionsAry->toJson()):'[]' !!}'
                data-pvdsvideos='{!! ($vdsvideosAry)?str_replace("'", '´', $vdsvideosAry->toJson()):'[]' !!}'
                data-pvdsevents='{!! ($vdseventsAry)?str_replace("'", '´', $vdseventsAry->toJson()):'[]' !!}'
                data-pvdsplay='{!! ($vdsplayAry)?str_replace("'", '´', $vdsplayAry->toJson()):'[]' !!}'
                data-phlpvaloracions='{!! ($hlpvaloracionsAry)?str_replace("'", '´', $hlpvaloracionsAry->toJson()):'[]' !!}'
                data-phlpsimptomes='{!! ($hlpsimptomesAry)?str_replace("'", '´', $hlpsimptomesAry->toJson()):'[]' !!}'
                data-phlpvaloraciohassimptomes='{!! ($hlpvaloraciohassimptomesAry)?str_replace("'", '´', $hlpvaloraciohassimptomesAry->toJson()):'[]' !!}'
                data-pappurl='{!! url('/videos') !!}'
            ><magomo-component></magomo-component></div>
            <!-- Afectats Table VUE -->

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action([App\Http\Controllers\IncidenciaController::class, 'index']) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

            <!-- Modal modalAlertant -->
            <div id="modalAlertant" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="boxModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Alertant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group px-3">

                            <div class="row">
                                <label for="alertant_nom" class="col-12 col-form-label pl-1"><small>Nom</small></label>
                                <input type="text" class="col-12 form-control" id="alertant_nom" name="alertant_nom" value="{{ old('alertant_nom') }}">
                            </div>

                            <div class="row">
                                <label for="alertant_cognoms" class="col-12 col-form-label pl-1"><small>Congnoms</small></label>
                                <input type="text" class="col-12 form-control" id="alertant_cognoms" name="alertant_cognoms" value="{{ old('alertant_cognoms') }}">
                            </div>

                            <div class="row">
                                <label for="alertant_adreca" class="col-12 col-form-label pl-1"><small>Adreça</small></label>
                                <input type="text" class="col-12 form-control" id="alertant_adreca" name="alertant_adreca" value="{{ old('alertant_adreca') }}">
                            </div>

                            <div class="row">
                                <label for="alertant_municipisid" class="col-12 col-form-label pl-1"><small>Municipi</small></label>
                                <select class="col-12 custom-select" id="alertant_municipisid" name="alertant_municipisid">
                                    @foreach ($municipisAry as $municipi)<option value="{{ $municipi->id }}" {{ ((old('alertant_municipisid')==$municipi->id)?'selected':'') }}>{{ $municipi->nom }}</option>@endforeach
                                </select>
                            </div>

                            <div class="row">
                                <label for="alertant_tipusalertantsid" class="col-12 col-form-label pl-1"><small>Tipus</small></label>
                                <select class="col-12 custom-select" id="alertant_tipusalertantsid" name="alertant_tipusalertantsid">
                                    @foreach ($tipusalertantAry as $typealertant)<option value="{{ $typealertant->id }}" {{ ((old('alertant_tipusalertantsid')==$typealertant->id)?'selected':'') }}>{{ $typealertant->tipus }}</option>@endforeach
                                </select>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Tarcar</button>
                    </div>
                </div>
                </div>
            </div>
            <!-- Modal modalAlertant -->

        </form>

    </div>

</div>


@endsection

@section('pageModalScript')

<!-- Modal -->
<script>
    $('#boxModal').on('show.bs.modal', function (event) {

        var modal = $(this)
        var caller = $(event.relatedTarget) // Elemento que llama al modal

        var idelement = caller.data('idelement') // Extrae artibuto data-*
        modal.find('.modal-body').text('Està segur que vol esborrar l\'element ' + idelement + ' ?')

        var action = caller.data('action') // Extrae artibuto data-*
        modal.find('#okmodal').attr("action", action)

    })
    </script>
<!-- Modal -->

@endsection
