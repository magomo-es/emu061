@extends('_layouts.admin')

@section('pageTitle', 'Afectats list | Administració emu061 - Emulador de Sistema d\'Emergències 061')

@section('pageContent')

@include('_partials.mensajes')

<div class="card mb-3">

    <div class="card-body">

        <h5>Cercar</h5>

        <form action="{{ action([App\Http\Controllers\AfectatController::class, 'index']) }}" method="GET">
            @csrf
            <div class="form-group row">

                <div class="form-check col-sm-1 mt-2 text-right">
                    <input class="form-check-input" type="checkbox" value="actiu" id="srchactiu" name="srchactiu" {{ ((old('srchactiu'))?'checked':'') }}>
                    <label class="form-check-label" for="srchactiu">Actiu</label>
                </div>

                <div class="col-sm-1 text-right">
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

    <div class="card-header bg-white">Afectats</div>

    <div class="card-body">

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom i Congoms</th>
                <th scope="col">CIP</th>
                <th scope="col">Teléfon</th>
                <th scope="col">Edat</th>
                <th scope="col">Sexe</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($objectsAry as $theobject)
                <tr>
                    <td>{{ $theobject->id }}</th>
                    <td>{{ $theobject->nom }} {{ $theobject->cognoms }}</td>
                    <td>{{ $theobject->cip }}</td>
                    <td>{{ $theobject->telefon }}</td>
                    <td>{{ $theobject->edat }}</td>
                    <td>{{ $theobject->sexes_id }}</td>
                    <td>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" {{ (($theobject->actiu==1)?'checked':'') }} disabled>
                        </div>

                    </td>
                    <td class="text-right">

                        <div class="btn-group" role="group">
                            <form class="m-0 p-0" action="{{ action([App\Http\Controllers\AfectatController::class, 'edit'], ['theobj' => $theobject->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Editar</button>
                            </form>
                        </div>

                        <div class="btn-group ml-1" role="group">

                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#boxModal"
                             data-idelement="{{ $theobject->nom }} {{ $theobject->cognoms }}"
                             data-action="{{ action([App\Http\Controllers\AfectatController::class, 'destroy'], ['theobj' => $theobject->id]) }}"
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


<!--a href="{{ url('admin/afectats') }}"><button id="NewButton" type="button" class="btn btn-secondary"><i class="fas fa-plus"></i> Nou Cicle</button></a -->


<?php
//$thevalue = 1;
// Index Cicle Id #{{ $thevalue }}: {{ App\Clases\Cicle::getElementIndex( $cicles, $thevalue ) }}
?>

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
