@extends('_layouts.admin')

@section('pageTitle', 'Edit Video Esdeveniment | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Edit Video Esdeveniment</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\VdsEventsController::class, 'update'], ['theobj' => $theobj->id] ) }}" method="POST">

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

            </div>
            <div class="form-group row">

                <div class="col-4">
                    <div class="row">
                        <label for="ontime" class="col-3 col-form-label"><small>S'inicia</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="ontime" name="ontime" value="{{ $theobj->ontime }}">
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="row">
                        <label for="timeout" class="col-3 col-form-label"><small>Interval</small></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="timeout" name="timeout" value="{{ $theobj->timeout }}">
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="row">
                        <label for="type" class="col-sm-3 col-form-label"><small>Tipus</small></label>
                        <div class="col-sm-9">
                            <select class="custom-select" id="type" name="type">
                                @foreach ($typeAry as $key => $type)
                                <option value="{{ $key }}" {{ (( $theobj->type==$key)?'selected':'') }}>{{ $type }}</option>
                                @endforeach
                            </select>
                         </div>
                    </div>
                </div>

            </div>
            <div class="form-group row">

                <div class="col">
                    <div class="row">
                        <label for="jsondata" class="col-1 col-form-label pr-1"><small>Event Data (json)</small></label>
                        <div class="col-11">
                            <textarea rows="6" class="form-control" id="jsondata" name="jsondata">{{ $theobj->jsondata }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action( [App\Http\Controllers\VdsEventsController::class, 'index'] ) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>



@endsection
