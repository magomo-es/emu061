@extends('_layouts.admin')

@section('pageTitle', 'Usuaris list | Administració emu061 - Emulador de Sistema d\'Emergències 061')

@section('pageContent')

@include('_partials.mensajes')

<div class="card mb-3">

    <div class="card-body">

        <h5>Cercar</h5>

        <form action="{{ action([App\Http\Controllers\UsuariController::class, 'index']) }}" method="GET">
            @csrf
            <div class="form-group row">

                <div class="col-5">
                    <div class="form-group row">
                        <label for="srchname" class="col-2 col-form-label">Nom</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="srchname" name="srchname" value="{{ old('srchname') }}">
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="form-group row">
                        <label for="srchrol" class="col-2 col-form-label">Roles</label>
                        <div class="col-10">
                            <select class="custom-select" id="srchrol" name="srchrol">
                                <option value="0">seleccioneu rol...</option>
                                @foreach ($rolsAry as $rol)
                                <option value="{{ $rol->id }}" {{ ((old('srchrol')==$rol->id)?'selected':'') }}>{{ $rol->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-2 text-right">
                    <button type="submit" class="btn btn-secondary btn mt-1"><i class="fas fa-search"></i> Cercar</button>
                </div>

            </div>

        </form>

    </div>

</div>

@if ( empty($objectsAry) )

<div class="alert alert-primary bg-primary text-white" role="alert">Encara no hi ha cap element donat d'alta.</div>

@else

<div class="card">

    <div class="card-header bg-white">Usuaris</div>

    <div class="card-body">

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Usuari</th>
                <th scope="col">Contrasenya</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Recurs</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($objectsAry as $theobject)
                <tr>
                    <td>{{ $theobject->id }}</th>
                    <td>{{ $theobject->nom }} {{ $theobject->cognoms }}</th>
                    <td>{{ $theobject->username }}</td>
                    <td>{{ $theobject->contrasenya }}</th>
                    <td>{{ $theobject->email }}</td>
                    <td>{{ $theobject->rols_id }}</td>
                    <td>{{ $theobject->recursos_id }}</td>
                    <td class="text-right">

                        <div class="btn-group" role="group">
                            <form class="m-0 p-0" action="{{ action([App\Http\Controllers\UsuariController::class, 'edit'], ['theobj' => $theobject->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn"><i class="fas fa-edit"></i> Editar</button>
                            </form>
                        </div>

                        <div class="btn-group ml-1" role="group">

                            <button type="button" class="btn btn-danger btn" data-toggle="modal" data-target="#boxModal"
                             data-idelement="{{ $theobject->username }}"
                             data-action="{{ action([App\Http\Controllers\UsuariController::class, 'destroy'], ['theobj' => $theobject->id]) }}"
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

<a href="{{ action([App\Http\Controllers\UsuariController::class, 'create']) }}"><button id="NewButton" type="button" class="btn btn-secondary">
    <i class="fas fa-plus"></i> Nou Usuari</button>
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
