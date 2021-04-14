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

                    <div class="form-group row">
                        <div class="col-12">
                            <div class="row px-1">
                                <label for="afectat_codivaloracio" class="col-12 col-form-label pl-1"><small>Codi Valoracio</small></label>
                                <select class="col-8 custom-select" id="afectat_codivaloracio" @change="onChangeValoracio($event)" v-model="afectat.codi_valoracio">
                                    <option v-for="(item) in codisvaloracions" v-bind:key="item.id" v-bind:value="item.codi">{{ item.nom }}</option>
                                </select>
                                <button type="button" class="col-2 btn btn-primary" @click="openVideoValoracio()">Video</button>
                                <button type="button" class="col-2 btn btn-primary" data-toggle="collapse" data-target="#collapseAyuda" aria-expanded="false" aria-controls="collapseExample">Ayuda</button>
                            </div>
                            <div class="collapse" id="collapseAyuda">
                                <div class="card card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</div>
                            </div>
                        </div>
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
                    <button type="button" class="btn btn-primary" @click="registerAfectat()">{{ (key_tmp<0)?'Afegir':'Modificar' }}</button>
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

                    <video id="videoValoracio" v-bind:src="play_video" style="width: 100%; height; auto;" ></video>

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

                key_tmp: 0,

                valoracionCodi: '',

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
                this.afectat = afectat
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
            // - - - - - - - - - - - - - - - - - - - - - SELECT VALORACIO: onChangeValoracio =>
            onChangeValoracio( ev ) {

                this.valoracionCodi = ev.currentTarget.options[ev.currentTarget.selectedIndex].value

            },
            // - - - - - - - - - - - - - - - - - - - - - VIDEO VALORACIO: openVideoValoracio =>
            openVideoValoracio() {

                console.log( 'openVideoValoracio ' + this.valoracionCodi )

                this.videoid = this.findVideoFileById( this.findVideoIdByCodiValoracio( this.valoracionCodi ) )

                if( this.videoid>=0 ) {

                    console.log(' codi valoracion in playvideos ' + this.vdsvideos[this.videoid].filename )
                    this.play_video = '/videos/'+encodeURI(this.vdsvideos[this.videoid].filename)
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
        },

        mounted() { console.log('Component mounted...') }

    }
</script>














