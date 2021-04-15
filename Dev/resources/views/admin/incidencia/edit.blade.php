@extends('_layouts.admin')

@section('pageTitle', 'Edit Incidencia | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Incidencia</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\IncidenciaController::class, 'update'], ['theobj' => $theobj->id] ) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group row">

                <div class="col-4">
                    <div class="row">
                        <label for="numincident" class="col-3 col-form-label"><small>Id Incident</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="numincident" name="numincident" value="{{ $theobj->num_incident }}">
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="data" class="col-4 col-form-label"><small>Data</small></label>
                        <div class="col-8">
                            <input type="date" class="form-control" id="data" name="data"
                            min="{{ date('Y-m-d',time()-86400) }}" max="{{ date('Y-m-d',time()+86400) }}"
                            value="{{ $theobj->data }}">
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="row">
                        <label for="hora" class="col-4 col-form-label"><small>Hora</small></label>
                        <div class="col-8">
                            <input type="time" class="form-control" id="hora" name="hora" value="{{ $theobj->hora }}">
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="telefonalertant" class="col-4 col-form-label"><small>Telefon</small></label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="telefonalertant" name="telefonalertant" value="{{ $theobj->telefon_alertant }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <label for="adreca" class="col-1 col-form-label"><small>Adreça</small></label>
                <div class="col-11">
                    <input type="text" class="form-control" id="adreca" name="adreca" value="{{ $theobj->adreca }}">
                </div>

            </div>

            <div class="form-group row">

                <div class="col-6">
                    <div class="row">
                        <label for="adrecacomplement" class="col-2 col-form-label"><small>Adreça comp</small></label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="adrecacomplement" name="adrecacomplement" value="{{ $theobj->adreca_complement }}">
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <label for="municipisid" class="col-2 col-form-label"><small>Municipi</small></label>
                        <div class="col-10">
                            <select class="custom-select" id="municipisid" name="municipisid">
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
                        <label for="descripcio" class="col-1 col-form-label pr-1"><small>Descripcio</small></label>
                        <div class="col-11">
                            <textarea rows="6" class="form-control" id="descripcio" name="descripcio">{{ $theobj->descripcio }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <div class="col-3">
                    <div class="row">
                        <label for="nommetge" class="col-4 col-form-label pr-1"><small>Metge</small></label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="nommetge" name="nommetge" value="{{ $theobj->nom_metge }}">
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="tipusincidenciesid" class="col-3 col-form-label"><small>Tipus</small></label>
                        <div class="col-9">
                            <select class="custom-select" id="tipusincidenciesid" name="tipusincidenciesid">
                                @foreach ($tipusAry as $tipus)
                                <option value="{{ $tipus->id }}" {{ (($theobj->tipus_incidencies_id==$tipus->id)?'selected':'') }}>{{ $tipus->tipus }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="alertantsid" class="col-3 col-form-label"><small>Alertant</small></label>
                        <div class="col-9">
                            <select class="custom-select" id="alertantsid" name="alertantsid">
                                @foreach ($alertantsAry as $alertant)
                                <option value="{{ $alertant->id }}" {{ (($theobj->alertants_id==$alertant->id)?'selected':'') }}>{{ $alertant->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="usuarisid" class="col-3 col-form-label"><small>Usuari</small></label>
                        <div class="col-9">
                            <select class="custom-select" id="usuarisid" name="usuarisid">
                                @foreach ($usuarisAry as $usuari)
                                <option value="{{ $usuari->id }}" {{ (($theobj->usuaris_id==$usuari->id)?'selected':'') }}>{{ $usuari->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Afectats Table VUE -->
            <div class="form-group row" id="app"
                data-pafectats='{!! ($objectsAry)?str_replace("'", '´', $objectsAry->toJson()):"[]" !!}'
                data-palertants='{!! ($alertantsAry)?str_replace("'", '´', $alertantsAry->toJson()):"[]" !!}'
                data-psexes='{!! ($sexesAry)?str_replace("'", '´', $sexesAry->toJson()):"[]" !!}'
                data-ptipusrecursos='{!! ($tipusrecursosAry)?str_replace("'", '´', $tipusrecursosAry->toJson()):"[]" !!}'
                data-pcodisgravetat='{!! ($codisgravetatAry)?str_replace("'", '´', $codisgravetatAry->toJson()):'[]' !!}'
                data-pcodisvaloracions='{!! ($codisvaloracionsAry)?str_replace("'", '´', $codisvaloracionsAry->toJson()):'[]' !!}'
                data-pvdsvideos='{!! ($vdsvideosAry)?str_replace("'", '´', $vdsvideosAry->toJson()):'[]' !!}'
                data-pvdsevents='{!! ($vdseventsAry)?str_replace("'", '´', $vdseventsAry->toJson()):'[]' !!}'
                data-pvdsplay='{!! ($vdsplayAry)?str_replace("'", '´', $vdsplayAry->toJson()):'[]' !!}'
                data-phlpvaloracions='{!! ($hlpvaloracionsAry)?str_replace("'", '´', $hlpvaloracionsAry->toJson()):'[]' !!}'
                data-phlpsimptomes='{!! ($hlpsimptomesAry)?str_replace("'", '´', $hlpsimptomesAry->toJson()):'[]' !!}'
                data-plpvaloraciohassimptomesAry='{!! ($hlpvaloraciohassimptomesAry)?str_replace("'", '´', $hlpvaloraciohassimptomesAry->toJson()):'[]' !!}'
            ><magomo-component></magomo-component></div>
            <!-- Afectats Table VUE -->

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action([App\Http\Controllers\IncidenciaController::class, 'index']) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>



@endsection
