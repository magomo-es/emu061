@extends('_layouts.admin')

@section('pageTitle', 'Nova Incidencia | CEP')

@section('pageContent')

@include('_partials.mensajes')

<div class="card">

    <div class="card-header">Nova Incidencia

        <button id="addAlertant" type="button" class="btn btn-dark float-right" onclick="openMainVideo()"><small>Videos</small></button>

    </div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\IncidenciaController::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">

                <div class="col-12">
                    <div class="row">

                        <div class="col-3">
                            <div class="row">
                                <label for="numincident" class="col-12 col-form-label"><small>Id Incidencia</small></label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="numincident" name="numincident" value="{{ (old('numincident'))?old('numincident'):rand(10000,10000000) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="row">
                                <label for="data" class="col-12 col-form-label"><small>Data</small></label>
                                <div class="col-12">
                                    <input type="date" class="form-control" id="data" name="data"
                                    min="{{ date('Y-m-d',time()-86400) }}" max="{{ date('Y-m-d',time()+86400) }}"
                                    value="{{ (!empty(old('data'))?old('data'):date('Y-m-d',time())) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="row">
                                <label for="hora" class="col-12 col-form-label"><small>Hora</small></label>
                                <div class="col-12">
                                    <input type="time" class="form-control" id="hora" name="hora"
                                        value="{{ (!empty(old('hora'))?old('hora'):date('H:i',time())) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="row">
                                <label for="telefonalertant" class="col-12 col-form-label"><small>Telefon</small></label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="telefonalertant" name="telefonalertant" value="{{ old('telefonalertant') }}" pattern="[0-9]{9}" minlength="9" maxlength="9" required>
                                </div>
                                <div class="col-4">
                                    <button id="addAlertant" type="button" class="btn btn-primary w-100 px-3" data-toggle="modal" data-target="#modalAlertant">Alertant</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="row">

                        <label for="adreca" class="col-12 col-form-label"><small>Adreça</small></label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="adreca" name="adreca" value="{{ old('adreca') }}" required>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="row">

                        <div class="col-6">
                            <div class="row">
                                <label for="adrecacomplement" class="col-12 col-form-label"><small>Adreça comp</small></label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="adrecacomplement" name="adrecacomplement" value="{{ old('adrecacomplement') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <label for="municipisid" class="col-12 col-form-label"><small>Municipi</small></label>
                                <div class="col-12">
                                    <select class="custom-select" id="municipisid" name="municipisid">
                                        @foreach ($municipisAry as $municipi)<option value="{{ $municipi->id }}" {{ ((old('municipisid')==$municipi->id)?'selected':'') }}>{{ $municipi->nom }}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="row">

                        <div class="col">
                            <div class="row">
                                <label for="descripcio" class="col-12 col-form-label pr-1"><small>Descripció</small></label>
                                <div class="col-12">
                                    <textarea rows="4" class="form-control" id="descripcio" name="descripcio" required>{{ old('descripcio') }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="row">

                        <div class="col-4">
                            <div class="row">
                                <label for="nommetge" class="col-12 col-form-label pr-1"><small>Metge</small></label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="nommetge" name="nommetge" value="{{ old('nommetge') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="row">
                                <label for="tipusincidenciesid" class="col-12 col-form-label"><small>Tipus</small></label>
                                <div class="col-12">
                                    <select class="custom-select" id="tipusincidenciesid" name="tipusincidenciesid">
                                        @foreach ($tipusAry as $tipus)<option value="{{ $tipus->id }}" {{ ((old('tipusincidenciesid')==$tipus->id)?'selected':'') }}>{{ $tipus->tipus }}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="row">
                                <label for="usuarisid" class="col-12 col-form-label"><small>Usuari</small></label>
                                <div class="col-12">
                                    <select class="custom-select" id="usuarisid" name="usuarisid">
                                        @foreach ($usuarisAry as $usuari)<option value="{{ $usuari->id }}" {{ ((old('usuarisid')==$usuari->id)?'selected':'') }}>{{ $usuari->nom }}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Afectats Table VUE -->
            <div class="form-group row" id="app"
                data-pafectats='{!! "[]" !!}'
                data-palertants='{!! ($alertantsAry)?str_replace("'", '´', $alertantsAry->toJson()):"[]" !!}'
                data-pdestins='{!! ($destinsAry)?str_replace("'", '´', $destinsAry->toJson()):"[]" !!}'
                data-psexes='{!! ($sexesAry)?str_replace("'", '´', $sexesAry->toJson()):"[]" !!}'
                data-ptipusrecursos='{!! ($tipusrecursosAry)?str_replace("'", '´', $tipusrecursosAry->toJson()):"[]" !!}'
                data-precursos='{!! ($recursosAry)?str_replace("'", '´', $recursosAry->toJson()):"[]" !!}'
                data-pcodisgravetat='{!! ($codisgravetatAry)?str_replace("'", '´', $codisgravetatAry->toJson()):'[]' !!}'
                data-pcodisvaloracions='{!! ($codisvaloracionsAry)?str_replace("'", '´', $codisvaloracionsAry->toJson()):'[]' !!}'
                data-pvdsvideos='{!! ($vdsvideosAry)?str_replace("'", '´', $vdsvideosAry->toJson()):'[]' !!}'
                data-pvdsevents='{!! ($vdseventsAry)?str_replace("'", '´', $vdseventsAry->toJson()):'[]' !!}'
                data-pvdsplay='{!! ($vdsplayAry)?str_replace("'", '´', $vdsplayAry->toJson()):'[]' !!}'
                data-phlpvaloracions='{!! ($hlpvaloracionsAry)?str_replace("'", '´', $hlpvaloracionsAry->toJson()):'[]' !!}'
                data-phlpsimptomes='{!! ($hlpsimptomesAry)?str_replace("'", '´', $hlpsimptomesAry->toJson()):'[]' !!}'
                data-phlpvaloraciohassimptomes='{!! ($hlpvaloraciohassimptomesAry)?str_replace("'", '´', $hlpvaloraciohassimptomesAry->toJson()):'[]' !!}'
                data-pappurl='{!! url('/videos') !!}'
            ><magomo-component></magomo-component></div>
            <!-- Afectats Table VUE -->

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action([App\Http\Controllers\IncidenciaController::class, 'index']) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

            <!-- Modal modalAlertant -->
            <div id="modalAlertant" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="boxModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Alertant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group px-3">

                            <div class="row">
                                <label for="alertant_nom" class="col-12 col-form-label pl-1"><small>Nom</small></label>
                                <input type="text" class="col-12 form-control" id="alertant_nom" name="alertant_nom" value="{{ old('alertant_nom') }}">
                            </div>

                            <div class="row">
                                <label for="alertant_cognoms" class="col-12 col-form-label pl-1"><small>Congnoms</small></label>
                                <input type="text" class="col-12 form-control" id="alertant_cognoms" name="alertant_cognoms" value="{{ old('alertant_cognoms') }}">
                            </div>

                            <div class="row">
                                <label for="alertant_adreca" class="col-12 col-form-label pl-1"><small>Adreça</small></label>
                                <input type="text" class="col-12 form-control" id="alertant_adreca" name="alertant_adreca" value="{{ old('alertant_adreca') }}">
                            </div>

                            <div class="row">
                                <label for="alertant_municipisid" class="col-12 col-form-label pl-1"><small>Municipi</small></label>
                                <select class="col-12 custom-select" id="alertant_municipisid" name="alertant_municipisid">
                                    @foreach ($municipisAry as $municipi)<option value="{{ $municipi->id }}" {{ ((old('alertant_municipisid')==$municipi->id)?'selected':'') }}>{{ $municipi->nom }}</option>@endforeach
                                </select>
                            </div>

                            <div class="row">
                                <label for="alertant_tipusalertantsid" class="col-12 col-form-label pl-1"><small>Tipus</small></label>
                                <select class="col-12 custom-select" id="alertant_tipusalertantsid" name="alertant_tipusalertantsid">
                                    @foreach ($tipusalertantAry as $typealertant)<option value="{{ $typealertant->id }}" {{ ((old('alertant_tipusalertantsid')==$typealertant->id)?'selected':'') }}>{{ $typealertant->tipus }}</option>@endforeach
                                </select>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Tarcar</button>
                    </div>
                </div>
                </div>
            </div>
            <!-- Modal modalAlertant -->

        </form>

    </div>

</div>















    <!-- Modal modalMainVideo VIDEO-->

    <style>

        #preButtonMV { position: absolute; box-sizing: border-box; top: 20px; left: 20px; width: 100px; padding: 3px; background-color: rgba(0,0,0,.4); color: #fff; font-weight: bold; cursor: pointer; }

        #timeBoxMV { position: absolute; box-sizing: border-box; top: 20px; width: 100px; margin-left: calc( 50% - 50px ); padding: 3px; background-color: #07ad07; color: #fff; text-align: center; }

        #nexButtonMV { position: absolute; box-sizing: border-box; top: 20px; right: 20px; width: 100px; padding: 3px;  background-color: rgba(0,0,0,.4); color: #fff; font-weight: bold; cursor: pointer; }

        .videoCtrlsBtnMV { background-color: rgba(0,0,0,.4); color: #fff; font-weight: bold; cursor: pointer; border-color: transparent; border-left: solid 3px #333; }

        #buttonsBoxMV { position: absolute; bottom: 20px; left: 20px; right: 20px; padding: 10px; padding: 3px; background-color: transparent; display: grid; grid-template-columns: 1fr 1fr 1fr 1fr 1fr; grid-gap: 0px; }

        #eventVideoBoxMV { position: absolute; top: 20px; left: 20px; right: 20px; bottom: 20px; padding: 10px; background-color: rgba(0,0,0,.5); display: none; color: #fff; font-size: 16px;}

        #closeQuizButton { position: absolute; right: 40px; bottom: 40px; }

    </style>

    <div id="modalMainVideo" class="modal fade bd-example-modal-lg" tabindex="-1">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Videos</h5>
                </div>
                <div class="modal-body" style="position: relative">

                    <video id="videoMV" data-start="" data-end="" data-playevent=""
                        v-bind:src="play_video"
                        style="width: 100%; height; auto; background-color: #1b2631;">
                    </video>

                    <div id="topButtonsBoxMV">

                        <button id="preButtonMV" type="button" class="videoCtrlsBtnMV"{!! (count($vdsvideosAry)<=1)?'style="display: none;"':'' !!}>anterior</button>

                        <div id="timeBoxMV">00:00</div>

                        <button id="nexButtonMV" type="button" class="videoCtrlsBtnMV"{!! (count($vdsvideosAry)<=1)?'style="display: none;"':'' !!}>següent</button>

                    </div>

                    <div id="buttonsBoxMV">

                        <button id="homButtonMV" type="button" class="videoCtrlsBtnMV">inici</button>
                        <button id="rewButtonMV" type="button" class="videoCtrlsBtnMV">rebobinar</button>
                        <button id="plyButtonMV" type="button" class="videoCtrlsBtnMV">veure/pausa</button>
                        <button id="fwrButtonMV" type="button" class="videoCtrlsBtnMV">endavant</button>
                        <button id="endButtonMV" type="button" class="videoCtrlsBtnMV">fi</button>

                    </div>

                    <div id="eventVideoBoxMV" style="position: "></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeMainVideo()">Tanca</button>
                </div>

            </div>
        </div>
    </div>

    <script>

        var vdsvideosAry = JSON.parse( {!! "'" . (($vdsvideosAry) ? str_replace("'", '´', $vdsvideosAry->toJson()) : '[]' ) . "'" !!} );

        var vdseventsAry = JSON.parse( {!! "'" . (($vdseventsAry) ? str_replace(['\\"',"'","\\r\\n",'"{','}"'], ['"','´','','{','}'], $vdseventsAry->toJson()) : '[]' ) . "'" !!} );

        var videoIndexVM = 0;

        var maxIndexVM = (vdsvideosAry.length - 1);

        console.log( 'maxIndexVM: ' + maxIndexVM );

        var publicDir = {!! '"'.url('/').'"' !!};

        var videoMV_obj = document.getElementById('videoMV');
        if ( maxIndexVM >= 0 ) { videoMV_obj.src = publicDir + '/videos/'+vdsvideosAry[videoIndexVM].filename; }

        var eventIndex = -1;
        var responseOK = -1;

        // - - - - - - - - - - - - - - - - - - - - - VIDEOS: openMainVideo =>
        function openMainVideo() {

            console.log("publicDir: "+publicDir);

            // control por array no vacio
            if ( vdsvideosAry.length > 0 ) {

                console.log( 'openMainVideo -> videoIndexVM: ' + videoIndexVM )

                // eventos de botones de video
                document.getElementById('homButtonMV').onclick = function (ev) {
                        videoMV_obj.currentTime = 0;
                };
                document.getElementById('rewButtonMV').onclick = function (ev) {
                    if ( (videoMV_obj.currentTime-10) < 0 ) { videoMV_obj.currentTime = 0; }
                    else { videoMV_obj.currentTime -= 10; }
                };
                document.getElementById('plyButtonMV').onclick = function (ev) {
                    if (!videoMV_obj.paused) { videoMV_obj.pause(); }
                    else { videoMV_obj.play(); }
                };
                document.getElementById('fwrButtonMV').onclick = function (ev) {
                    if ( (videoMV_obj.currentTime+10) > videoMV_obj.duration ) { videoMV_obj.currentTime = videoMV_obj.duration; }
                    else { videoMV_obj.currentTime += 10; }
                };
                document.getElementById('endButtonMV').onclick = function (ev) {
                    videoMV_obj.currentTime = videoMV_obj.duration;
                };
                document.getElementById('preButtonMV').onclick = function (ev) {
                    if ( ( videoIndexVM - 1 ) >= 0 ) { --videoIndexVM; }
                    else { videoIndexVM = maxIndexVM; }
                    videoMV_obj.src = publicDir + '/videos/'+vdsvideosAry[videoIndexVM].filename;
                };
                document.getElementById('nexButtonMV').onclick = function (ev) {
                    if ( ( videoIndexVM + 1 ) > maxIndexVM ) { ++videoIndexVM; }
                    else { videoIndexVM = 0; }
                    videoMV_obj.src = publicDir + '/videos/'+vdsvideosAry[videoIndexVM].filename;
                };
                videoMV_obj.ontimeupdate = function() {

                    console.log( 'start script -> ontimeupdate' );

                    // imprime tiempo de ejecucion de video
                    var calctmp = videoMV_obj.currentTime;
                    var timeBox = document.getElementById('timeBoxMV');
                    timeBox.innerHTML = parseInt( calctmp / 60 ) + ':' + ((( calctmp % 60 ) < 10 ) ? '0' : '') + parseInt( calctmp % 60 );

                    // control de eventos
                    var c = -1, isEvent = false;

                    while ( !isEvent && ++c < vdseventsAry.length ) {

                        console.log(' / control ' + vdsvideosAry[videoIndexVM].id+' == '+vdseventsAry[c].id_video+' && '+parseInt(videoMV_obj.currentTime)+' == '+vdseventsAry[c].ontime );

                        console.log( vdseventsAry[c] );

                        if ( vdsvideosAry[videoIndexVM].id == vdseventsAry[c].id_video && parseInt(videoMV_obj.currentTime) == vdseventsAry[c].ontime && !vdseventsAry[c].jsondata.made ) {

                            console.log(' - match !! ' + vdsvideosAry[videoIndexVM].id+' == '+vdseventsAry[c].id_video+' && '+parseInt(videoMV_obj.currentTime)+' == '+vdseventsAry[c].ontime );
                            videoMV_obj.pause();
                            isEvent = true;
                            eventIndex = c;

                        }

                    }
                    if (isEvent) {

                        vdseventsAry[c].jsondata.made = false;

                        openEventBoxVM();

                    }

                };

                $('#modalMainVideo').modal('show')

            } else {

                alert('Actualment no es disposa d\'cap vídeo.' )

            }

        }
        // - - - - - - - - - - - - - - - - - - - - - VIDEOS: openEventBoxVM =>
        function openEventBoxVM() {

            document.getElementById('topButtonsBoxMV').style.display = 'none';
            document.getElementById('buttonsBoxMV').style.display = 'none';

            var eventVideoBoxMV = document.getElementById('eventVideoBoxMV'), evVideoContent;
            evVideoContent = '<h3 style="text-align: center">' + vdseventsAry[eventIndex].jsondata.title + '</h3>';
            evVideoContent += '<p>' + vdseventsAry[eventIndex].jsondata.content + '</p>';

            if ( vdseventsAry[eventIndex].type == 2 ) {

                responseOK = vdseventsAry[eventIndex].jsondata.respuesta;

                for (var v = 0; v < vdseventsAry[eventIndex].jsondata.preguntas.length; v++ ) {

                    evVideoContent += '<p>' + (v+1) +'. '+ vdseventsAry[eventIndex].jsondata.preguntas[v] + '</p>';

                }

                evVideoContent += '<p>Premeu en el teclat el nombre de resposta correcta ...</p><p id="responsBox"></p>';
                (document.getElementsByTagName("body"))[0].onkeypress = function (ev) { responseQuiz(event); };


            }

            // control de timeout - si es mayor que 0, instala una ejecucion unica
            if ( vdseventsAry[eventIndex].timeout == 0 ) {

                evVideoContent += '<button id="closeQuizButton" type="button" class="btn btn-secondary" onclick="closeEventBoxVM()">Tanca Joc</button>';

            } else {

                setTimeout(function(){ closeEventBoxVM(); videoMV_obj.play(); }, ( vdseventsAry[eventIndex].timeout * 1000 ) );

            }

            eventVideoBoxMV.innerHTML = evVideoContent;
            eventVideoBoxMV.style.display = 'block';

        }
        // - - - - - - - - - - - - - - - - - - - - - VIDEOS: responseQuiz =>
        function responseQuiz(event) {

            if ( event.key >= 0 && event.key <= 9 ) {

                if (event.key == (responseOK+1) ) {

                    document.getElementById('responsBox').innerHTML = 'La opción '+event.key+' es Correcta !!';

                } else {

                    document.getElementById('responsBox').innerHTML = 'La opción '+event.key+' es Equivocada !!';

                }
            }

        }
        // - - - - - - - - - - - - - - - - - - - - - VIDEOS: closeEventBoxVM =>
        function closeEventBoxVM() {
            var eventVideoBoxMV = document.getElementById('eventVideoBoxMV');
            eventVideoBoxMV.innerHTML = '';
            eventVideoBoxMV.style.display = 'none';
            document.getElementById('topButtonsBoxMV').style.display = 'block';
            document.getElementById('buttonsBoxMV').style.display = 'grid';
            vdseventsAry[eventIndex].jsondata.made = true;
            (document.getElementsByTagName("body"))[0].onkeypress = null;
            videoMV_obj.play();
        }
        // - - - - - - - - - - - - - - - - - - - - - VIDEOS: findMainPlayIndex =>
        function findMainPlayIndex( code ) {

            var i = -1, foud = -1;
            if (code.length>0) {
                while (foud<0 && ++i<this.vdsplay.length) {
                    if (this.vdsplay[i].id_caller==code) { foud = i; }
                }
            }
            return foud

        }
        // - - - - - - - - - - - - - - - - - - - - - VIDEOS: findMainVideoIndexByPlayIndex =>
        function findMainVideoIndexByPlayIndex( videoid ) {

            var i = -1, foud = -1;
            if (videoid>=0) {
                while (foud<0 && ++i<this.vdsplay.length) {
                    if (this.vdsvideos[i].id==videoid) { foud = i; }
                }
            }
            return foud

        }
        // - - - - - - - - - - - - - - - - - - - - - VIDEOS: closeMainVideo =>
        function closeMainVideo() {

            videoMV_obj.pause();
            $('#modalMainVideo').modal('hide')

        }

    </script>

    <!-- Modal modalMainVideo VIDEO-->

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
