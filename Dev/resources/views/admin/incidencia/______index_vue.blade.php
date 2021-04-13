@extends('layouts.main')

@section('pageTitle', 'Cicles | CEP')

@section('pageContent')

@include('partials.mensajes')

{{-- <div class="card mb-3">

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


@if ( empty(cicles) )

<div class="alert alert-primary bg-primary text-white" role="alert">Encara no hi ha cap cicle donat d'alta.</div>

@else --}}



{{-- @endif --}}





{{-- <?php
//$thevalue = 1;
// Index Cicle Id #{{ $thevalue }}: {{ App\Clases\Cicle::getElementIndex( $cicles, $thevalue ) }}
?> --}}



@endsection

