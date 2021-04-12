@extends('_layouts.admin')

@section('pageTitle', 'Edit Valoracio (anglés) | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Valoracio (anglés)</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\HlpValoracioController::class, 'update'], ['theobj' => $theobj->codi_valoracio] ) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group row">

                <label class="col-2 col-form-label"><small>Valoracio</small></label>
                <div class="col-10">
                    <input type="text" class="form-control"
                        value="{{ $theobj->codi_valoracio . ' - ' . $theobj->valoracio->nom }}"
                        readonly>
                </div>

            </div>

            <div class="form-group row">

                <label for="translation" class="col-2 col-form-label"><small>Traduccio</small></label>
                <div class="col-10">
                    <input type="text" class="form-control" id="translation" name="translation" value="{{ $theobj->translation }}">
                </div>


            </div>
            <div class="form-group row">

                <label for="soundlike" class="col-2 col-form-label"><small>Soundlike</small></label>
                <div class="col-10">
                    <input type="text" class="form-control" id="soundlike" name="soundlike" value="{{ $theobj->soundlike }}">
                </div>

            </div>
            <div class="form-group row">

                <label for="item" class="col-2 col-form-label align-right"><small>Simptomes</small></label>
                <div class="col-10">
                    <div class="row">

                        @foreach ($simptomesAry as $simptoma)

                        <div class="col-6">
                            <div class="row">
                                <div class="col-1 pl-2">
                                    <input class="form-check-input ml-1"
                                        type="checkbox"
                                        value="{{ $simptoma->id }}"
                                        id="item_{{ $simptoma->id }}"
                                        name="simptomes[]" {{ ( isset( $simtomesIdAry[ $simptoma->id ] ) )?'checked':'' }}>
                                </div>
                                <label for="item_{{ $simptoma->id }}"
                                    class="col-11 col-form-label align-right">
                                    <small>{{ $simptoma->pregunta }}</small>
                                </label>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>
            {{-- <div class="form-group row">
                <label for="jsontags" class="col-2 col-form-label pr-1"><small>Simptomes in JSON Data</small></label>
                <div class="col-10">
                    <textarea rows="6" class="form-control" id="jsontags" name="jsontags">{{ $theobj->jsontags }}</textarea>
                </div>
            </div> --}}

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\HlpValoracioController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>



@endsection
