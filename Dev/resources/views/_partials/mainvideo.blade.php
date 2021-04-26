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
        <div class="modal-content modal-style">
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
