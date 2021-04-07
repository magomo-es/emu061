@extends('_layouts.admin')

@section('pageTitle', 'Alertants list | Administració emu061 - Emulador de Sistema d\'Emergències 061')

@section('pageContent')

@include('_partials.mensajes')

<div class="card mb-3">

    <div class="card-body">

        <h5>Cercar</h5>

        <form action="{{ action([App\Http\Controllers\AlertantController::class, 'index']) }}" method="GET">
            @csrf

            <div class="form-group row">

                <div class="col-2">

                    <input type="text" class="form-control col-11" id="srchtelefon" name="srchtelefon" value="{{ old('srchtelefon') }}" placeholder="Telefon">

                </div>

                <div class="col-2">

                    <input type="text" class="form-control col-11" id="srchnom" name="srchnom" value="{{ old('srchnom') }}" placeholder="Nom">

                </div>

                <div class="col-3">

                    <select class="custom-select" id="srchtipus" name="srchtipus">
                        <option value="0" selected>...seleccioneu Tipus</option>
                        @foreach ($tipusAry as $tipus)
                        <option value="{{ $tipus->id }}" {{ ((old('srchtipus')==$tipus->id)?'selected':'') }}>{{ $tipus->tipus }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="col-3">

                    <select class="custom-select" id="srchmunicipis" name="srchmunicipis">
                        <option value="0" selected>...seleccioneu Municipi</option>
                        @foreach ($municipisAry as $municipi)
                        <option value="{{ $municipi->id }}" {{ ((old('srchmunicipis')==$municipi->id)?'selected':'') }}>{{ $municipi->nom }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="col-2 text-right">
                    <button type="submit" class="btn btn-secondary btn-sm mt-1"><i class="fas fa-search"></i> Cercar</button>
                </div>

            </div>

        </form>

    </div>

</div>

@if ( empty($objectsAry) )

<div class="alert alert-primary bg-primary text-white" role="alert">Encara no hi ha cap element donat d'alta.</div>

@else

<div class="card">

    <div class="card-header bg-white">Alertants</div>

    <div class="card-body">

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom i Cognoms</th>
                <th scope="col">Teléfon</th>
                <th scope="col">Adreça</th>
                <th scope="col">Municipi</th>
                <th scope="col">Tipo Alertant</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($objectsAry as $theobject)
                <tr>
                    <td><small>{{ $theobject->id }}</small></th>
                    <td><small>{{ $theobject->nom }} {{ $theobject->cognoms }}</small></td>
                    <td><small>{{ $theobject->telefon }}</small></td>
                    <td><small>{{ $theobject->adreca }}</small></th>
                    <td><small>{{ $municipisAry->firstWhere('id', $theobject->municipis_id)->nom }}</small></td>
                    <td><small>{{ $tipusAry->firstWhere('id', $theobject->tipus_alertants_id)->tipus }}</small></td>
                    <td class="text-right">

                        <div class="btn-group" role="group">
                            <form class="m-0 p-0" action="{{ action([App\Http\Controllers\AlertantController::class, 'edit'], ['theobj' => $theobject->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Editar</button>
                            </form>
                        </div>

                        <div class="btn-group ml-1" role="group">

                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#boxModal"
                             data-idelement="{{ $theobject->nom }} {{ $theobject->cognoms }}"
                             data-action="{{ action([App\Http\Controllers\AlertantController::class, 'destroy'], ['theobj' => $theobject->id]) }}"
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


<a href="{{ action([App\Http\Controllers\AlertantController::class, 'create']) }}"><button id="NewButton" type="button" class="btn btn-secondary">
    <i class="fas fa-plus"></i> Nou Alertant</button>
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
