@extends('_layouts.admin')

@section('pageTitle', 'Nou Incidencia | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nou Incidencia</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\IncidenciaController::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">

                <div class="col-3">
                    <div class="row">
                        <label for="xnumincident" class="col-4 col-form-label"><small>Id Incidencia</small></label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="xnumincident" name="xnumincident" value="{{ old('xnumincident') }}">
                        </div>
                    </div>
                </div>

                <?php date_default_timezone_set('Europe/Madrid'); ?>

                <div class="col-3">
                    <div class="row">
                        <label for="xdata" class="col-4 col-form-label"><small>Data</small></label>
                        <div class="col-8">
                            <input type="date" class="form-control" id="xdata" name="xdata"
                            min="{{ date('Y-m-d',time()-86400) }}" max="{{ date('Y-m-d',time()+86400) }}"
                            value="{{ (!empty(old('xdata'))?old('xdata'):date('Y-m-d',time())) }}" required>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="row">
                        <label for="xhora" class="col-4 col-form-label"><small>Hora</small></label>
                        <div class="col-8">
                            <input type="time" class="form-control" id="xhora" name="xhora"
                            value="{{ (!empty(old('xhora'))?old('xhora'):date('G:i',time())) }}" required>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="row">
                        <label for="xtelefonalertant" class="col-2 col-form-label"><small>Telefon</small></label>
                        <div class="col-6">
                            <input type="text" class="form-control" id="xtelefonalertant" name="xtelefonalertant" value="{{ old('xtelefonalertant') }}">
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-primary w-100 px-3"
                                data-toggle="modal" data-target="#boxAlertant"
                                data-idelement="{{ old('xtelefonalertant') }}"
                                data-action="{{ action([App\Http\Controllers\IncidenciaController::class, 'create'], ['theobj' => $theobject->id]) }}

                            >Alertant</button>



                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#boxModal"
                            data-idelement="{{ $theobject->num_incident }}"
                            data-action="{{ action([App\Http\Controllers\IncidenciaController::class, 'destroy'], ['theobj' => $theobject->id]) }}"
                            ><i class="fas fa-trash"></i> Esborrar</button>

                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <label for="xadreca" class="col-1 col-form-label"><small>Adreça</small></label>
                <div class="col-11">
                    <input type="text" class="form-control" id="xadreca" name="xadreca" value="{{ old('xadreca') }}">
                </div>

            </div>

            <div class="form-group row">

                <div class="col-6">
                    <div class="row">
                        <label for="xadrecacomplement" class="col-2 col-form-label"><small>Adreça comp</small></label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="xadrecacomplement" name="xadrecacomplement" value="{{ old('xadrecacomplement') }}">
                        </div>
                    </div>
                </div>

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

            <div class="form-group row">

                <div class="col-3">
                    <div class="row">
                        <label for="xnommetge" class="col-4 col-form-label pr-1"><small>Metge</small></label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="xnommetge" name="xnommetge" value="{{ old('xnommetge') }}">
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="xtipusincidenciesid" class="col-3 col-form-label"><small>Tipus</small></label>
                        <div class="col-9">
                            <select class="custom-select" id="xtipusincidenciesid" name="xtipusincidenciesid">
                                @foreach ($tipusAry as $tipus)
                                <option value="{{ $tipus->id }}" {{ ((old('xtipusincidenciesid')==$tipus->id)?'selected':'') }}>{{ $tipus->tipus }}</option>
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
                                <option value="{{ $alertant->id }}" {{ ((old('xalertantsid')==$alertant->id)?'selected':'') }}>{{ $alertant->nom }}</option>
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
                                <option value="{{ $usuari->id }}" {{ ((old('xusuarisid')==$usuari->id)?'selected':'') }}>{{ $usuari->nom }}</option>
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


<!-- Modal -->
<div id="boxModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="boxModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Esborrar Element</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">Està segur que vol esborrar l'element </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Tarcar</button>
            <form id="okmodal" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" type="button" class="btn btn-danger"><i class="fas fa-trash"></i> Esborrar</button>
            </form>
        </div>
      </div>
    </div>
  </div>
<!-- Modal -->

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
