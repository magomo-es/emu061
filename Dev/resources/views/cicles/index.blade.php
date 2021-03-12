@extends('layouts.main')

@section('pageTitle', 'Cicles | CEP')

@section('pageContent')

@include('partials.mensajes')

<div class="card mb-3">

    <div class="card-body">

        <h5>Buscar</h5>

        <form action="{{ action([App\Http\Controllers\CicleController::class, 'index']) }}" method="GET">
            @csrf
            <div class="form-group row">

                <div class="form-check col-sm-1 mt-2 text-right">
                    <input class="form-check-input" type="checkbox" value="actiu" id="srchactiu" name="srchactiu" {{ ((old('srchactiu'))?'checked':'') }}>
                    <label class="form-check-label" for="srchactiu">Actiu</label>
                </div>

                <div class="col-sm-1 text-right">
                    <button type="submit" class="btn btn-secondary btn-sm mt-1"><i class="fas fa-search"></i> Buscar</button>
                </div>

            </div>

        </form>

    </div>

</div>


@if ( empty($cicles) )

<div class="alert alert-primary bg-primary text-white" role="alert">Encara no hi ha cap cicle donat d'alta.</div>

@else

<div class="card">

    <div class="card-header bg-white">Cicles</div>

    <div class="card-body">

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Sigles</th>
                <th scope="col">Nom</th>
                <th scope="col">Actiu</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($cicles as $cicle)
                <tr>
                    <td>{{ $cicle->id }}</th>
                    <td>{{ $cicle->sigles }}</td>
                    <td>{{ $cicle->nom }}</td>
                    <td>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" {{ (($cicle->actiu==1)?'checked':'') }} disabled>
                        </div>

                    </td>
                    <td class="text-right">

                        <div class="btn-group" role="group">
                            <form class="m-0 p-0" action="{{ action([App\Http\Controllers\CicleController::class, 'edit'], ['cicle' => $cicle->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Editar</button>
                            </form>
                        </div>

                        <div class="btn-group ml-1" role="group">

                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#boxModal"
                             data-sigles="{{ $cicle->sigles }}"
                             data-action="{{ action([App\Http\Controllers\CicleController::class, 'destroy'], ['cicle' => $cicle->id]) }}"
                             ><i class="fas fa-trash"></i> Esborrar</button>

                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

{{ $cicles->links() }}

    </div>

</div>

@endif


<a href="{{ url('cicles/create') }}"><button id="NewButton" type="button" class="btn btn-secondary"><i class="fas fa-plus"></i> Nou Cicle</button></a>


<?php
//$thevalue = 1;
// Index Cicle Id #{{ $thevalue }}: {{ App\Clases\Cicle::getElementIndex( $cicles, $thevalue ) }}
?>

<!-- Modal -->
<div id="boxModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="boxModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Esborrar Cicle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">Estas segur de que vols esborrar el cicle</div>
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

        var sigles = caller.data('sigles') // Extrae artibuto data-*
        modal.find('.modal-body').text('Estas segur de que vols esborrar el cicle ' + sigles + ' ?')

        var action = caller.data('action') // Extrae artibuto data-*
        modal.find('#okmodal').attr("action", action)

    })
    </script>
<!-- Modal -->
@endsection
