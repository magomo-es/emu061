@extends('_layouts.admin')

@section('pageTitle', 'Nou Provincia | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nova Valoracio</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\HlpValoracioController::class, 'store'] ) }}" method="POST">

            @csrf



            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\HlpValoracioController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>


@endsection
