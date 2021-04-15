<template>
<div class="w-100 mt-4 px-3">

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col"><small>Id</small></th>
            <th scope="col"><small>Nom i Congoms</small></th>
            <th scope="col"><small>CIP</small></th>
            <th scope="col"><small>Teléfon</small></th>
            <th scope="col"><small>Edat</small></th>
            <th scope="col"><small>Sexe</small></th>
            <th scope="col" class="text-right">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary btn-sm" @click="openEditAfectat(emptyAfectat(),-1)">Nou Afectat</button>
                </div>
            </th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="(afectat, index) in afectats" v-bind:key="afectat.id">
                <td>{{ index + 1 }}</td>
                <td>{{ afectat.nom }} {{ afectat.cognoms }}</td>
                <td>{{ afectat.cip }}</td>
                <td>{{ afectat.telefon }}</td>
                <td>{{ afectat.edat }}</td>
                <td>{{ sexes[afectat.sexe] }}</td>
                <td class="text-right">
                    <input type="hidden" v-bind:id="'afectat['+index+'][id]'" v-bind:name="'afectat['+index+'][id]'" />
                    <input type="hidden" v-bind:id="'afectat['+index+'][nom]'" v-bind:name="'afectat['+index+'][nom]'" />
                    <input type="hidden" v-bind:id="'afectat['+index+'][cognoms]'" v-bind:name="'afectat['+index+'][cognoms]'" />
                    <input type="hidden" v-bind:id="'afectat['+index+'][cip]'" v-bind:name="'afectat['+index+'][cip]'" />
                    <input type="hidden" v-bind:id="'afectat['+index+'][telefon]'" v-bind:name="'afectat['+index+'][telefon]'" />
                    <input type="hidden" v-bind:id="'afectat['+index+'][edat]'" v-bind:name="'afectat['+index+'][edat]'" />
                    <input type="hidden" v-bind:id="'afectat['+index+'][sexe]'" v-bind:name="'afectat['+index+'][sexe]'" />
                    <input type="hidden" v-bind:id="'afectat['+index+'][descripcio]'" v-bind:name="'afectat['+index+'][descripcio]'" />
                    <input type="hidden" v-bind:id="'afectat['+index+'][tipus_recursos_id]'" v-bind:name="'afectat['+index+'][tipus_recursos_id]'" />
                    <input type="hidden" v-bind:id="'afectat['+index+'][codi_gravetat]'" v-bind:name="'afectat['+index+'][codi_gravetat]'" />
                    <input type="hidden" v-bind:id="'afectat['+index+'][codi_valoracio]'" v-bind:name="'afectat['+index+'][codi_valoracio]'" />
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-warning btn-sm" @click="openEditAfectat(afectat, index)">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                    </div>
                    <div class="btn-group ml-1" role="group">
                        <button type="button" class="btn btn-danger btn-sm" @click="confirmDeleteAfectat(afectat, index)">
                            <i class="fas fa-trash"></i> Esborrar
                        </button>
                    </div>
                </td>
            </tr>

        </tbody>

    </table>

    <!-- Modal modalAfectatDelete Delete -->
    <div id="modalAfectatDelete" class="modal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Esborrar Afectat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Estas segur de que vols esborrar l'afectat {{ '# '+(key_tmp+1)+' - '+afectat.nom+' '+afectat.cognom  }} ?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Tarcar</button>
                    <button type="button" class="btn btn-danger" @click="deleteAfectat()"><i class="fas fa-trash"></i> Esborrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal modalAfectatDelete Delete -->

    <!-- Modal modalEditAfectat Inser/Update -->
    <div id="modalEditAfectat" class="modal" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Afectat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body px-5">

                    <div class="form-group row">
                        <div class="col-6">
                            <div class="row px-1">
                                <label for="afectat_nom" class="col-12 col-form-label pl-1"><small>Nom</small></label>
                                <input type="text" class="col-12 form-control" id="afectat_nom" v-model="afectat.nom">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row px-1">
                                <label for="afectat_cognoms" class="col-12 col-form-label pl-1"><small>Congnoms</small></label>
                                <input type="text" class="col-12 form-control" id="afectat_cognoms" v-model="afectat.cognoms">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-4">
                            <div class="row px-1">
                                <label for="afectat_cip" class="col-12 col-form-label pl-1"><small>CIP</small></label>
                                <input type="text" class="col-12 form-control" id="afectat_cip" v-model="afectat.cip">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row px-1">
                                <label for="afectat_edat" class="col-12 col-form-label pl-1"><small>Edat</small></label>
                                <input type="text" class="col-12 form-control" id="afectat_edat" v-model="afectat.edat">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row px-1">
                                <label for="afectat_sexesid" class="col-12 col-form-label pl-1"><small>Sexe</small></label>
                                <select class="col-12 custom-select" id="afectat_sexesid" v-model="afectat.sexes_id">
                                    <option v-for="(item) in sexes"  v-bind:key="item.id" v-bind:value="item.id">{{ item.sexe }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <div class="row px-1">
                                <label for="afectat_tipusrecursosid" class="col-12 col-form-label pl-1"><small>Tipus Recurs</small></label>
                                <select class="col-12 custom-select" id="afectat_tipusrecursosid" v-model="afectat.tipus_recursos_id">
                                    <option v-for="(item) in tipusrecursos"  v-bind:key="item.id" v-bind:value="item.id">{{ item.tipus }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row px-1">
                                <label for="afectat_codigravetat" class="col-12 col-form-label pl-1"><small>Codi Gravetat</small></label>
                                <select class="col-12 custom-select" id="afectat_codigravetat" v-model="afectat.codi_gravetat">
                                    <option v-for="(item) in codisgravetat" v-bind:key="item.id" v-bind:value="item.codi">{{ item.nom }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row" id="boxValoracio" v-bind:class="{ 'valoracio-box': displayHelp }">
                        <div class="col-12">
                            <div class="row px-1 mb-3">
                                <label for="afectat_codivaloracio" class="col-12 col-form-label pl-1"><small>Codi Valoracio</small></label>
                                <select class="col-8 custom-select" id="afectat_codivaloracio" @change="onChangeValoracio($event)" v-model="afectat.codi_valoracio">
                                    <option v-for="(item, index) in codisvaloracions" v-bind:key="item.id" v-bind:id="('v_'+index+'_'+item.codi)" v-bind:value="item.codi">{{ item.nom }}</option>
                                </select>
                                <div class="col-2 p-0 m-0 pl-4"><button type="button" class="btn btn-outline-secondary w-100" @click="openVideoValoracio()"><i class="far fa-play-circle"></i> Video</button></div>
                                <div class="col-2 p-0 m-0 pl-4"><button type="button" class="btn btn-outline-secondary w-100" data-toggle="collapse" @click="openBoxValoracio()" v-show="(!displayHelp)"><i class="far fa-question-circle"></i> Ayuda</button></div>
                            </div>
                            <div v-show="(displayHelp)" class="row px-1 mb-3">

                                <h5>Simptomes</h5>
                                <div class="container-fluid mt-3 mb-5">

                                    <div class="row">
                                        <div class="col-4 mb-2 px-2" v-for="(item, index) in hlpsimtomes" v-bind:key="item.id" style="border-left: 1px dotted #0b0a0b;">

                                            <p class="w-100 p-1 m-0" style="background-color: #fff;">
                                                <input class="" type="checkbox" v-bind:id="('simptoma'+item.id)" v-bind:data-simptoma="item.id" v-bind:data-codi="item.codi" v-bind:data-ind="index" @click="checkboxSimptomes($event)">
                                                <small>{{ item.pregunta }}</small>
                                            </p>
                                            <p class="w-100 p-1 m-0" style="background-color: rgb(244, 241, 51);"><small>{{ item.translation }}</small></p>
                                            <p class="w-100 p-1 m-0" style="background-color: rgb(148, 244, 51);"><small>{{ item.soundlike }}</small></p>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" @click="closeBoxValoracio()" v-show="(displayHelp)" style="position: absolute; bottom: 30px; right: 30px;">Tarcar</button>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <div class="row px-1">
                                <label for="afectat_descripcio" class="col-12 col-form-label pl-1"><small>Descripcio</small></label>
                                <textarea rows="2" class="col-12 form-control" id="afectat_descripcio" v-model="afectat.tipusrecursosid"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tarcar</button>
                    <button type="button" class="btn btn-primary" @click="registerAfectat()" v-text="((key_tmp<0)?'Afegir':'Modificar')"></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal modalEditAfectat Inser/Update -->

    <!-- Modal modalVideoValoracio VIDEO-->
    <div id="modalVideoValoracio" class="modal fade bd-example-modal-lg" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Videos per Valoració</h5>
                </div>
                <div class="modal-body" style="position: relative">

                    <video id="videoValoracio" v-bind:src="play_video" style="width: 100%; height; auto;" onclick="this.play()"></video>
                    <button id="rewButton" type="button" class="ctrlsBtn">rew</button>
                    <div id="timeBox">00:00</div>
                    <button id="fwrButton" type="button" class="ctrlsBtn">fow</button>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="closeVideoValoracio()">Tanca</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal modalVideoValoracio VIDEO -->

</div>
</template>

<style>
    .ctrlsBtn { position: absolute; top: 10px; padding: 10px; background-color: #eff2ef; color: #333; cursor: pointer; border-radius: 5px; box-shadow: 1px 1px 2px; }
    #rewButton { left: 10px; }
    #fwrButton { right: 10px; }
    #timeBox { position: absolute; box-sizing: border-box; top: 10px; width: 100px; margin-left: calc( 50% - 50px ); padding: 10px; background-color: #07ad07; color: #fff; text-align: center; }
    .valoracio-box { position: fixed; top: 20px; left: 20px; right: 20px; bottom: 20px; padding: 20px; background-color: #fff; z-index: 99; }

</style>

<script>
    export default {

        props: [
            'pafectats',
            'psexes',
            'ptipusrecursos',
            'pcodisgravetat',
            'pcodisvaloracions',
            'pvdsvideos',
            'pvdsevents',
            'pvdsplay',
            'phlpvaloracions',
            'phlpsimptomes'
            ],

        data() {

            return {

                displayHelp: false,

                key_tmp: 0,

                valoracionCodi: '',

                simptomesSelected:  new Map(),

                videoId: 0,

                play_video: '',



                afectat: { id: 0, telefon: 0, cip: '', nom: '', cognoms: '', edat: '', te_cip: 0, sexes_id: 0, descripcio: '', tipus_recursos_id: 0, codi_gravetat: '', codi_valoracio: '' },

                afectats: [],
                sexes: [],
                tipusrecursos: [],
                codisgravetat: [],
                codisvaloracions: [],
                vdsvideos: [],
                vdsevents: [],
                vdsplay: [],
                hlpvaloracions: [],
                hlpsimtomes: [],
                byid_hlpsimtomes: [],
                hlpvaloraciohassimptomes: [],

            }

        },

        methods: {
            // - - - - - - - - - - - - - - - - - - - - - AFECTAT: emptyAfectat =>
            emptyAfectat() {
                return {
                    id: '',
                    telefon: 0,
                    cip: '',
                    nom: '',
                    cognoms: '',
                    edat: '',
                    te_cip: 0,
                    sexes_id: 0,
                    descripcio: '',
                    tipus_recursos_id: 0,
                    codi_gravetat: '',
                    codi_valoracio: ''
                }
            },
            // - - - - - - - - - - - - - - - - - - - - - AFECTAT: confirmDeleteAfectat =>
            confirmDeleteAfectat( afectat, keyindex ) {

                console.log( 'open modal delete x afectat id ' + (keyindex+1) )
                this.key_tmp = keyindex
                this.afectat = afectat
                $('#modalAfectatDelete').modal('show')

            },
            // - - - - - - - - - - - - - - - - - - - - - AFECTAT: openEditAfectat =>
            openEditAfectat( afectat, keyindex ) {

                console.log( 'open modal x edit afectat id ' + (keyindex+1) )
                this.key_tmp = keyindex
                //this.afectat = afectat
                Object.assign(this.afectat, afectat);
                $('#modalEditAfectat').modal('show')

            },
            // - - - - - - - - - - - - - - - - - - - - - AFECTAT: deleteAfectat =>
            deleteAfectat() {

                console.log( 'delete afectat id ' + (this.key_tmp+1) )
                this.afectats.splice(this.work_key, 1);
                $('#modalAfectatDelete').modal('hide')

            },
            // - - - - - - - - - - - - - - - - - - - - - AFECTAT: registerAfectat =>
            registerAfectat() {

                if ( this.key_tmp >= 0 && this.afectats[this.key_tmp] ) {

                    console.log( 'updated afectat id ' + (this.key_tmp+1) )
                    this.afectats[this.key_tmp] = this.afectat

                } else {

                    console.log( 'added afectat id ' + (this.key_tmp+1) )
                    this.afectats.push( this.afectat )

                }

                $('#modalEditAfectat').modal('hide')

            },
            // - - - - - - - - - - - - - - - - - - - - - SELECT VALORACIO: checkboxSimptomes =>
            checkboxSimptomes( ev ) {
                /*
                let sayings = new Map();
                sayings.set('dog', 'woof');
                sayings.set('cat', 'meow');
                sayings.set('elephant', 'toot');
                sayings.size; // 3
                sayings.get('dog'); // woof
                sayings.get('fox'); // undefined
                sayings.has('bird'); // false
                sayings.delete('dog');
                sayings.has('dog'); // false

                for (let [key, value] of sayings) {
                console.log(key + ' goes ' + value);
                }
                // "cat goes meow"
                // "elephant goes toot"

                sayings.clear();
                sayings.size; // 0
                */
                console.log( 'checkboxSimtomes -> ev.target.id: '+ ev.currentTarget.id );

                if (ev.currentTarget.checked) {
                    this.simptomesSelected.set( ev.currentTarget.dataset.simptoma, ev.currentTarget.dataset.codi );
                } else {
                    this.simptomesSelected.delete( ev.currentTarget.dataset.simptoma );
                }
                this.showablesValoracio()
            },
            // - - - - - - - - - - - - - - - - - - - - - SELECT VALORACIO: showablesValoracio =>
            showablesValoracio() {

                for (let [key, value] of this.simptomesSelected) {
                    console.log( key + ' -> ' + value );
                    //document.getElementById('v_'+index+'_'+item.codi)

                }

            },
            // - - - - - - - - - - - - - - - - - - - - - SELECT VALORACIO: openBoxValoracio =>
            openBoxValoracio() {
                this.displayHelp = true
            },
            // - - - - - - - - - - - - - - - - - - - - - SELECT VALORACIO: closeBoxValoracio =>
            closeBoxValoracio() {
                this.displayHelp = false
            },
            // - - - - - - - - - - - - - - - - - - - - - SELECT VALORACIO: onChangeValoracio =>
            onChangeValoracio( ev ) {

                this.valoracionCodi = ev.currentTarget.options[ev.currentTarget.selectedIndex].value

            },
            // - - - - - - - - - - - - - - - - - - - - - SELECT VALORACIO: onChangeValoracio =>
            addValoracioDataset() {

                var optionobj;

                for( var i=0; i< this.hlpvaloracions.length; i++) {

                    optionobj = document.getElementById('v_'+i+'_'+this.hlpvaloracions[i].codi_valoracio);

                    for( var k=0; k< this.hlpvaloraciohassimptomes.length; k++) {

                        if (this.hlpvaloracions[i].codi_valoracio==this.hlpvaloraciohassimptomes[k].codi_valoracio) {

                            optionobj.dataset[this.hlpvaloraciohassimptomes[k].id_simptoma] = 1

                            console.log(' ___ found !! -> ' + this.hlpvaloraciohassimptomes[k].id_simptoma);

                        }
                    }
                }
            },
            // - - - - - - - - - - - - - - - - - - - - - SELECT VALORACIO: onChangeValoracio =>
            addValoracioSimptomes() {

                var optionobj;

                for( var i=0; i< this.hlpvaloracions.length; i++) {

                    optionobj = document.getElementById('v_'+i+'_'+this.hlpvaloracions[i].codi_valoracio);

                    for( var k=0; k< this.hlpvaloraciohassimptomes.length; k++) {

                        if (this.hlpvaloracions[i].codi_valoracio==this.hlpvaloraciohassimptomes[k].codi_valoracio) {

                            optionobj.dataset[this.hlpvaloraciohassimptomes[k].id_simptoma] = 1

                            console.log(' ___ found !! -> ' + this.hlpvaloraciohassimptomes[k].id_simptoma);

                        }
                    }
                }
            },
            // - - - - - - - - - - - - - - - - - - - - - VIDEO VALORACIO: openVideoValoracio =>
            openVideoValoracio() {

                console.log( 'openVideoValoracio ' + this.valoracionCodi )

                this.videoid = this.findVideoFileById( this.findVideoIdByCodiValoracio( this.valoracionCodi ) )

                if( this.videoid>=0 ) {

                    console.log(' codi valoracion in playvideos ' + this.vdsvideos[this.videoid].filename )
                    this.play_video = '/videos/'+encodeURI(this.vdsvideos[this.videoid].filename)



                        console.log( 'start script ->' );
                        var videoValoracio = document.getElementById('videoValoracio');
                        var timeBox = document.getElementById('timeBox');
                        var rewButton = document.getElementById('rewButton').onclick = function () { videoValoracio.currentTime -= 10; };
                        var fwrButton = document.getElementById('fwrButton').onclick = function () { videoValoracio.currentTime += 10; };
                        // videoValoracio.canplaythrough = function() { videoValoracioInit(); };
                        // videoValoracio.play = function() { console.log( 'start script -> play' ); };
                        // videoValoracio.playing = function() { console.log( 'start script -> playing' ); };
                        videoValoracio.ontimeupdate = function() { console.log( 'start script -> ontimeupdate' ); videoValoracioPlayingmy(); };
                        function videoValoracioInit() { console.log( 'videoValoracioPlayingmy ->' ); }
                        function videoValoracioPlayingmy() {
                            timeBox.innerHTML = parseInt( videoValoracio.duration - videoValoracio.currentTime );
                            let percentualElapsedTime = ( ( ( videoValoracio.currentTime ) * 100 ) / videoValoracio.duration );
                            if ( percentualElapsedTime > 90 ) { timeBox.style.backgroundColor = "#FF3300"; }
                            else if ( percentualElapsedTime > 80 ) { timeBox.style.backgroundColor = "#c5d304"; }
                            else { timeBox.style.backgroundColor = "#07ad07"; }
                            console.log( 'videoValoracioPlayingmy -> percentualElapsedTime: ' +percentualElapsedTime );
                        }




                    $('#modalVideoValoracio').modal('show')

                } else {

                    alert('Actualment no es disposa d\'cap vídeo per a aquesta valoració.' )

                }

            },
            // - - - - - - - - - - - - - - - - - - - - - VIDEO VALORACIO: closeVideoValoracio =>
            closeVideoValoracio() {

                document.getElementById('videoValoracio').pause();
                $('#modalVideoValoracio').modal('hide')
                this.play_video = ''

            },
            // - - - - - - - - - - - - - - - - - - - - - VIDEO VALORACIO: findVideoIdByCodiValoracio =>
            findVideoIdByCodiValoracio( code ) {

                var i = -1, foud = -1;
                if (code.length>0) {
                    while (foud<0 && ++i<this.vdsplay.length) {
                        if (this.vdsplay[i].id_caller==code) { foud = this.vdsplay[i].id_video; }
                    }
                }
                return foud

            },
            // - - - - - - - - - - - - - - - - - - - - - VIDEO VALORACIO: findVideoFileById =>
            findVideoFileById( id ) {

                var i = -1, foud = -1;
                if (id>=0) {
                    while (foud<0 && ++i<this.vdsplay.length) {
                        if (this.vdsvideos[i].id==id) { foud = i; }
                    }
                 }
                return foud

            },
            // - - - - - - - - - - - - - - - - - - - - - TOOLS: generateArrayById =>
            generateArrayById( original ) {
                let tmpary = [];
                    for( var i=0; i<original.length; i++ ) {
                        tmpary[original[i].id] = original[i];
                    }
                return tmpary
            }
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        },

        created() {
            let apptag = document.getElementById('app');
            this.afectats = JSON.parse( apptag.dataset.pafectats )
            this.sexes = JSON.parse( apptag.dataset.psexes )
            this.tipusrecursos = JSON.parse( apptag.dataset.ptipusrecursos )
            this.codisgravetat = JSON.parse( apptag.dataset.pcodisgravetat )
            this.codisvaloracions = JSON.parse( apptag.dataset.pcodisvaloracions )
            this.vdsvideos = JSON.parse( apptag.dataset.pvdsvideos )
            this.vdsevents = JSON.parse( apptag.dataset.pvdsevents )
            this.vdsplay = JSON.parse( apptag.dataset.pvdsplay )
            this.hlpvaloracions = JSON.parse( apptag.dataset.phlpvaloracions )
            this.hlpsimtomes = JSON.parse( apptag.dataset.phlpsimptomes )
            this.byid_hlpsimtomes = this.generateArrayById( this.hlpsimtomes )
            this.hlpvaloraciohassimptomes = JSON.parse( apptag.dataset.phlpvaloraciohassimptomes )
        },

        mounted() {

            console.log('Component mounted...')

            this.addValoracioDataset()

        }

    }
</script>














