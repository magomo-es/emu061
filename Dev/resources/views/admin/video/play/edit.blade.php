@extends('_layouts.admin')

@section('pageTitle', 'Edit Provincia | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Provincia</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\ProvinciaController::class, 'update'], ['theobj' => $theobj->id] ) }}" method="POST">

            @csrf
            @method('PUT')


            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\ProvinciaController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>



@endsection
