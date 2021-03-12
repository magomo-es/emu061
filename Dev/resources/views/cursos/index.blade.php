@extends('layouts.main')

@section('pageTitle', 'Cursos | CEP')

@section('pageContent')

@include('partials.mensajes')

<div class="card mb-3">

    <div class="card-body">

        <h5>Buscar</h5>

        <form action="{{ action([App\Http\Controllers\CursController::class, 'index']) }}" method="GET">
            @csrf
            <div class="form-group row">

                <label for="srchcurs" class="col-sm-1 col-form-label">Cicle</label>

                <div class="col-sm-9">

                    <select class="custom-select" id="srchcicle" name="srchcicle">
                        <option value="0" selected>Tots els cicles</option>
                        @foreach ($cicles as $cicle)
                        <option value="{{ $cicle->id }}" {{ ((old('srchcicle')==$cicle->id)?'selected':'') }}>{{ $cicle->nom }}</option>
                        @endforeach
                    </select>

                </div>

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



<div class="card">

    <div class="card-body">

        <h5>Cursos</h5>

        @if ( empty($cursos) )

        <div class="alert alert-light text-center" role="alert">No hi ha cap curs, per la cerca realitzada</div>

        @else

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sigles</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Cicle</th>
                    <th scope="col">Actiu</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cursos as $curs)
                <tr>
                    <td>{{ $curs->sigles }}</td>
                    <td>{{ $curs->nom }}</td>
                    <td>{{ $cicles->firstWhere('id', $curs->cicles_id)->nom }}</td>
                    <td>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" {{ (($curs->actiu==1)?'checked':'') }} disabled>
                        </div>

                    </td>
                    <td class="text-right">

                        <div class="btn-group" role="group">
                            <form class="m-0 p-0" action="{{ action([App\Http\Controllers\CursController::class, 'edit'], ['curs' => $curs->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Editar</button>
                            </form>
                        </div>

                        <div class="btn-group ml-1" role="group">

                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#boxModal"
                             data-sigles="{{ $curs->sigles }}"
                             data-action="{{ action([App\Http\Controllers\CursController::class, 'destroy'], ['curs' => $curs->id]) }}"
                             ><i class="fas fa-trash"></i> Esborrar</button>

                        </div>

                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

        {{ $cursos->links() }}

        @endif

    </div>

</div>

<!-- Modal -->
<div id="boxModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="boxModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Esborrar Curs</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">Estas segur de que vols esborrar el curs</div>
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

<a href="{{ url('cursos/create') }}"><button id="NewButton" type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nou curs</button></a>

@endsection

@section('pageModalScript')
<!-- Modal -->
<script>
    $('#boxModal').on('show.bs.modal', function (event) {

        var modal = $(this)
        var caller = $(event.relatedTarget) // Elemento que llqama al modal

        var sigles = caller.data('sigles') // Extrae artibuto data-*
        modal.find('.modal-body').text('Estas segur de que vols esborrar el curs ' + sigles + ' ?')

        var action = caller.data('action') // Extrae artibuto data-*
        modal.find('#okmodal').attr("action", action)

    })
    </script>
<!-- Modal -->
@endsection
