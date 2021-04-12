@extends('_layouts.admin')

@section('pageTitle', 'Play Video by Valoracio list | Administració emu061 - Emulador de Sistema d\'Emergències 061')

@section('pageContent')

@include('_partials.mensajes')

@if ( empty($objectsAry) )

<div class="alert alert-primary bg-primary text-white" role="alert">Encara no hi ha cap element donat d'alta.</div>

@else

<div class="card">

    <div class="card-header bg-white">Play Video by Valoracio</div>

    <div class="card-body">

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titul</th>
                <th scope="col">Video</th>
                <th scope="col">Valoracio</th>
                <th scope="col">Inicia</th>
                <th scope="col">Finalitza</th>
                <th scope="col">Esdev.</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($objectsAry as $theobject)
                <tr>
                    <td>{{ $theobject->id }}</th>
                    <td>{{ $theobject->title }}</td>
                    <td>{{ $theobject->video->title }}</th>
                    <td>{{ $theobject->valoracio->nom }}</td>
                    <td>{{ $theobject->start }}</th>
                    <td>{{ $theobject->ends }}</td>
                    <td><input class="form-check-input" type="checkbox" {{ (($theobject->playevent==1)?'checked':'') }} disabled></td>
                    <td class="text-right">

                        <div class="btn-group" role="group">
                            <form class="m-0 p-0" action="{{ action([App\Http\Controllers\VdsPlayController::class, 'edit'], ['theobj' => $theobject->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Editar</button>
                            </form>
                        </div>

                        <div class="btn-group ml-1" role="group">

                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#boxModal"
                             data-idelement="{{ $theobject->nom }}"
                             data-action="{{ action([App\Http\Controllers\VdsPlayController::class, 'destroy'], ['theobj' => $theobject->id]) }}"
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


<a href="{{ action([App\Http\Controllers\VdsPlayController::class, 'create']) }}"><button id="NewButton" type="button" class="btn btn-secondary">
    <i class="fas fa-plus"></i> Nou Play Video by Valoracio</button>
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
