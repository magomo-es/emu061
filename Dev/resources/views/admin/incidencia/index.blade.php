@extends('_layouts.admin')

@section('pageTitle', 'Incidències list | Administració emu061 - Emulador de Sistema d\'Emergències 061')

@section('pageContent')

@include('_partials.mensajes')

<div class="card mb-3">

    <div class="card-body">

        <h5>Cercar</h5>

        <form action="{{ action([App\Http\Controllers\IncidenciaController::class, 'index']) }}" method="GET">
            @csrf

            <div class="row">
                <div class="col-10">

                    <div class="form-group row">

                        <div class="col-3">
                            <input type="text" class="form-control col-11" id="srchnom" name="srchnom" value="{{ old('srchnom') }}" placeholder="Nom">
                        </div>

                        <div class="col-3">
                            <select class="custom-select" id="srchtipusincidencia" name="srchtipusincidencia">
                                <option value="0">seleccioneu tipus...</option>
                                @foreach ($tipusAry as $tipus)
                                <option value="{{ $tipus->id }}" {{ ((old('srchtipusincidencia')==$tipus->id)?'selected':'') }}>{{ $tipus->tipus }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-3">
                            <select class="custom-select" id="srchusuari" name="srchusuari">
                                <option value="0">seleccioneu usuari...</option>
                                @foreach ($usuarisAry as $usuari)
                                <option value="{{ $usuari->id }}" {{ ((old('srchusuari')==$usuari->id)?'selected':'') }}>{{ $usuari->username }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-3">
                            <select class="custom-select" id="srchmunicipi" name="srchmunicipi">
                                <option value="0">seleccioneu municipi...</option>
                                @foreach ($municipisAry as $municipi)
                                <option value="{{ $municipi->id }}" {{ ((old('srchmunicipi')==$municipi->id)?'selected':'') }}>{{ $municipi->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                <div class="col-2">

                    <div class="col text-right">
                        <button type="submit" class="btn btn-secondary btn-sm mt-1"><i class="fas fa-search"></i> Cercar</button>
                    </div>

                </div>


            </div>

        </form>

    </div>

</div>

@if ( empty($objectsAry) )

<div class="alert alert-primary bg-primary text-white" role="alert">Encara no hi ha cap element donat d'alta.</div>

@else

<div class="card">

    <div class="card-header bg-white">Incidències</div>

    <div class="card-body">

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col"># Incidencia</th>
                <th scope="col">Data/Hora</th>
                <th scope="col">Adreça</th>
                <th scope="col">Tipus</th>
                <th scope="col">Alertant</th>
                <th scope="col">Municipi</th>
                <th scope="col">Usuari</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($objectsAry as $theobject)
                <tr>
                    <td><small>{{ $theobject->num_incident }}</small></td>
                    <td><small>{{ $theobject->data. ' ' . $theobject->hora }}</small></td>
                    <td><small>{{ $theobject->adreca }} - {{ $theobject->adreca_complement }}</small></td>
                    <td><small>{{ $theobject->tipus_incidencia->tipus }}</small></td>
                    <td><small>{{ $theobject->alertant->nom }}</small></td>
                    <td><small>{{ $theobject->municipi->nom }}</small></td>
                    <td><small>{{ $theobject->usuari->username }}</small></td>
                    <td class="text-right">

                        <div class="btn-group" role="group">
                            <form class="m-0 p-0" action="{{ action([App\Http\Controllers\IncidenciaController::class, 'edit'], ['theobj' => $theobject->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Editar</button>
                            </form>
                        </div>

                        <div class="btn-group ml-1" role="group">

                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#boxModal"
                             data-idelement="{{ $theobject->num_incident }}"
                             data-action="{{ action([App\Http\Controllers\IncidenciaController::class, 'destroy'], ['theobj' => $theobject->id]) }}"
                             ><i class="fas fa-trash"></i> Esborrar</button>

                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

{{ $objectsAry->links() }}

    </div>

</div>

@endif


<a href="{{ action([App\Http\Controllers\IncidenciaController::class, 'create']) }}"><button id="NewButton" type="button" class="btn btn-secondary">
    <i class="fas fa-plus"></i> Nova Incidencia</button>
</a>


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
