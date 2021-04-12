@extends('_layouts.admin')

@section('pageTitle', 'Edit Play Video by Valoracio | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Play Video by Valoracio</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\VdsPlayController::class, 'update'], ['theobj' => $theobj->id] ) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group row">

                <div class="col-6">
                    <div class="row">
                        <label for="title" class="col-2 col-form-label"><small>Titul</small></label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="title" name="title" value="{{ $theobj->title }}">
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="row">
                        <label for="playevent" class="col-6 col-form-label align-right"><small>Play Events</small></label>
                        <div class="col-6 pl-2">
                            <input class="form-check-input ml-1" type="checkbox" value="1" id="playevent" name="playevent" {{ ($theobj->playevent==1)?'checked':'' }}>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="row">
                        <label for="start" class="col-6 col-form-label"><small>S'inicia</small></label>
                        <div class="col-6">
                            <input type="text" class="form-control" id="start" name="start" value="{{ $theobj->start }}">
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="row">
                        <label for="ends" class="col-6 col-form-label"><small>Finalitza</small></label>
                        <div class="col-6">
                            <input type="text" class="form-control" id="ends" name="ends" value="{{ $theobj->ends }}">
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group row">

                <div class="col-6">
                    <div class="row">
                        <label for="id_video" class="col-2 col-form-label"><small>Video</small></label>
                        <div class="col-10">
                            <select class="custom-select" id="id_video" name="id_video">
                                @foreach ($videosAry as $video)
                                <option value="{{ $video->id }}" {{ (( $theobj->id_video==$video->id)?'selected':'') }}>{{ $video->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <label for="id_video" class="col-2 col-form-label"><small>Valoracio</small></label>
                        <div class="col-10">
                            <select class="custom-select" id="id_caller" name="id_caller">
                                @foreach ($valoracionsAry as $valoracio)
                                <option value="{{ $valoracio->codi }}" {{ (( $theobj->id_caller==$valoracio->codi)?'selected':'') }}>{{ $valoracio->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\VdsPlayController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>



@endsection
