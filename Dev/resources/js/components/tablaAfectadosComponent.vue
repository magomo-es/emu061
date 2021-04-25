<template>
    <div class="form-group">
        <label for="desc"><small>Llista d'afectats:</small></label>

        <div class="tableFixHead">
            <table class="table table-style">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="table-head-style" style="border-left: 1px solid white;">ID</th>
                        <th scope="col" class="table-head-style">Noms</th>
                        <th scope="col" class="table-head-style">Cognoms</th>
                        <th scope="col" class="table-head-style">Edat</th>
                        <th scope="col" class="table-head-style">CIP</th>
                        <th scope="col" class="table-head-style">Sexe</th>
                        <th scope="col" class="table-head-style">Telèfon</th>
                        <th scope="col" class="table-head-style text-right"  style="border-right: 1px solid white;">
                            <div role="group" class="btn-group ml-1">
                                <button type="button" class="btn btn-primary btn-sm m-1" data-toggle="modal" data-target="#modalCrearAfectat" @click="openModalAfectat(cleanAfectat(),-1)">
                                    <i class="fas fa-plus"></i> Nou Afectat
                                </button>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="(afectat, index) in afectats" v-bind:key="afectat.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ afectat.nom }}</td>
                        <td>{{ afectat.cognoms }}</td>
                        <td>{{ afectat.edat }}</td>
                        <td>{{ afectat.cip }}</td>
                        <td>{{ sexes[afectat.sexe] }}</td>
                        <td>{{ afectat.telefon }}</td>

                        <td class="text-right">


                            <!-- FALTA MODAL EDICIÓN -->
                            <div role="group" class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm" @click="openModalAfectat(afectat, index)">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                            </div>

                            <!-- FALTA ELIMINCACIÓN -->
                            <div role="group" class="btn-group ml-1">
                                <button type="button" class="btn btn-danger btn-sm" @click="confirmDelete( afectat, index )">
                                    <i class="fas fa-trash"></i> Esborrar
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>

        <!-- MODAL CREAR AFECTADO -->
        <div class="modal fade" id="modalCrearAfectat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div role="document" class="modal-dialog modal-lg">
                <div class="modal-content modal-style">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">Afectats</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                            <span aria-hidden="true">×</span>
                        </button>
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
                                <label for="afectat_telefon" class="col-12 col-form-label pl-1"><small>Telefon</small></label>
                                <input type="text" class="col-12 form-control" id="afectat_telefon" v-model="afectat.telefon" pattern="[0-9]{9}" minlength="9" maxlength="9">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row px-1">
                                <label for="afectat_cip" class="col-12 col-form-label pl-1"><small>CIP</small></label>
                                <input type="text" class="col-12 form-control" id="afectat_cip" v-model="afectat.cip" minlength="14" maxlength="16">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row px-1">
                                <label for="afectat_edat" class="col-12 col-form-label pl-1"><small>Edat</small></label>
                                <input type="text" class="col-12 form-control" id="afectat_edat" v-model="afectat.edat" pattern="[0-9]{1,3}" minlength="1" maxlength="3">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row px-1">
                                <label for="afectat_sexesid" class="col-12 col-form-label pl-1"><small>Sexe</small></label>
                                <select class="select-form col-12 custom-select" id="afectat_sexesid" v-model="afectat.sexes_id">
                                    <option v-for="(item) in sexes"  v-bind:key="item.id" v-bind:value="item.id">{{ item.sexe }}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-6">
                            <div class="row px-1">
                                <label for="afectat_codigravetat" class="col-12 col-form-label pl-1"><small>Codi Gravetat</small></label>
                                <select class="select-form col-12 custom-select" id="afectat_codigravetat" v-model="afectat.codi_gravetat" title="Pick One">
                                    <option v-for="(item) in codisgravetat" v-bind:key="item.id" v-bind:value="item.codi">{{ item.nom }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row px-1">
                                <label for="afectat_recursosid" class="col-12 col-form-label pl-1"><small>Recurs</small></label>
                                <select class="select-form col-12 custom-select" id="afectat_recursosid" v-model="afectat.recursos_id" title="Pick One">
                                    <option v-for="(item) in recursos"  v-bind:key="item.id" v-bind:value="item.id">{{ item.codi + ' - ' + item.tipusrecursos.tipus }}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-6">
                            <div class="row px-1">
                                <label for="afectat_desti" class="col-12 col-form-label pl-1"><small>Destí</small></label>
                                <input type="text" class="col-12 form-control" id="afectat_desti" v-model="afectat.desti">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row px-1">
                                <label for="afectat_destialertantid" class="col-12 col-form-label pl-1"><small>Destins</small></label>
                                <select class="select-form col-12 custom-select" id="afectat_destialertantid" @change="onChangeDesti($event)" v-model="afectat.desti_alertant_id">
                                    <option value="0">Seleccioneu destí</option>
                                    <option v-for="(item) in destins" v-bind:key="item.id" v-bind:value="item.id">{{ item.nom }}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group row" id="boxValoracio" v-bind:class="{ 'valoracio-box': displayHelp }">

                        <div class="col-12">
                            <div class="row px-1 mb-3">
                                <label for="afectat_codivaloracio" class="col-12 col-form-label pl-1"><small>Codi Valoracio</small></label>
                                <select class="select-form col-8 custom-select" id="afectat_codivaloracio" @change="onChangeValoracio($event)" v-model="afectat.codi_valoracio">
                                    <option value="0">Seleccioneu valoració</option>
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
                                                <input class="" type="checkbox" v-bind:id="('simptoma'+item.id)" v-bind:data-simptoma="item.id" v-bind:data-ind="index" @click="checkboxSimptomes($event)">
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
                                <textarea rows="2" class="col-12 form-control" id="afectat_descripcio" v-model="afectat.descripcio"></textarea>
                            </div>
                        </div>

                    </div>

                </div>

                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Tarcar</button>
                        <button type="button" class="btn btn-primary" @click="createAfectat()">Desar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal modalVideoValoracio VIDEO-->
        <div id="modalVideoValoracio" class="modal fade bd-example-modal-lg" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-style">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Videos per Valoració</h5>
                    </div>
                    <div class="modal-body" style="position: relative">

                        <video id="videoValoracio" data-start="" data-end="" data-playevent=""
                            v-bind:src="play_video"
                            style="width: 100%; height; auto; background-color: #1b2631;"></video>
                        <div id="timeBox">00:00</div>
                        <div id="videoButtonsBox">
                            <button id="homButton" type="button" class="videoCtrlsBtn">init</button>
                            <button id="rewButton" type="button" class="videoCtrlsBtn">rew</button>
                            <button id="plyButton" type="button" class="videoCtrlsBtn">play/pause</button>
                            <button id="fwrButton" type="button" class="videoCtrlsBtn">fwr</button>
                            <button id="endButton" type="button" class="videoCtrlsBtn">end</button>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeVideoValoracio()">Tanca</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal modalVideoValoracio VIDEO -->

        <!-- MODAL DELETE -->
        <div class="modal" tabindex="-1" id="confirmDelete">
            <div class="modal-dialog">
                <div class="modal-content modal-style">
                    <div class="modal-header">
                        <h5 class="modal-title">Esborrar Afectat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p><small>Estas segur de que vols esborrar l'afectat - {{ (afectat.id + 1) }} - {{ afectat.nom }} {{ afectat.cognoms }}</small></p> <!--Falta mostrar afectat-->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                        <button type="button" class="btn btn-primary" @click="deleteAfectat()">Esborrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>

.tableFixHead          { overflow: auto; height: 200px; box-shadow: 0px 1px 0.1px grey;}
.tableFixHead thead th { position: sticky; top: -1px; z-index: 1; }

/* Just common table stuff. Really. */
table  { border-collapse: collapse; width: 100%; }
th, td { padding: 8px 16px; }
th     { background:#eee; padding:0px !important }

.table thead th
{
    border-bottom: 0px !important;
    padding-left: 15px !important;
}

.table th, td
{
    font-size: 85%;
    vertical-align: middle !important;
}

.ctrlsBtn { position: absolute; top: 10px; padding: 10px; background-color: #eff2ef; color: #333; cursor: pointer; border-radius: 5px; box-shadow: 1px 1px 2px; }
#rewButton { left: 10px; }
#fwrButton { right: 10px; }
#timeBox { position: absolute; box-sizing: border-box; top: 10px; width: 100px; margin-left: calc( 50% - 50px ); padding: 10px; background-color: #07ad07; color: #fff; text-align: center; }
.valoracio-box { position: fixed; top: 20px; left: 20px; right: 20px; bottom: 20px; padding: 20px; background-color: #fff; z-index: 99; }

</style>

<script>
export default {
  data() {
        return {
            key_tmp: -1,

            afectat: {
                id: 0,
                telefon: '',
                cip: '',
                nom: '',
                cognoms: '',
                edat: '',
                te_cip: 0,
                sexe_id: 0,
                tipus_recursos_id: '',
                codi_gravetat: '',
                codi_valoracio: '',
                descripcio: '',
                recursos_id: 0,
                prioritat: 0,
                desti: '',
                desti_alertant_id: 0
            },
            afectats: [],
            sexes: [],
            tipusrecursos: [],
            recursos: [],
            codisgravetat: [],
            codisvaloracions: [],
            destins: [],
            vdsvideos: [],
            vdsevents: [],
            vdsplay: [],
            hlpvaloracions: [],
            hlpsimtomes: [],
            byid_hlpsimtomes: [],
            hlpvaloraciohassimptomes: [],

            displayHelp: false,
            valoracionCodi: '',

            simptomesSelected:  new Map(),

            videoIndex: 0,
            playIndex: -1,
            play_video: '',
            videoPlayingTime: 0,
            videoPositionStart: 0,
            videoPositionEnd: 0,
            videoPlayEvents: false,

            default_codirecurso: '',
            default_codigravetat: '',
            default_codivaloracio: ''
        }
  },
  methods: {

      selectAfectats()
      {
          let me = this;
          axios
            .get('/afectats')
            .then(response => {
                me.afectats = response.data;
            })
            .catch( error => {
                console.log(error)
            })
            .finally(() => this.loading = false)
      },

      getSexes()
      {
          let me = this;
          axios
            .get('/sexes')
            .then(response => {
                me.sexes = response.data;
            })
            .catch( error => {
                console.log(error)
            })
            .finally(() => this.loading = false)
      },

      getTipus_recurs()
      {
          let me = this;
          axios
            .get('/recurs')
            .then(response => {
                me.tipusrecursos = response.data;
            })
            .catch( error => {
                console.log(error)
            })
            .finally(() => this.loading = false)
      },

      getCodis_gravetat()
      {
          let me = this;
          axios
            .get('/codis_gravetat')
            .then(response => {
                me.codisgravetat = response.data;
            })
            .catch( error => {
                console.log(error)
            })
            .finally(() => this.loading = false)
      },

      getCodis_valoracio()
      {
          let me = this;
          axios
            .get('/codis_valoracio')
            .then(response => {
                me.codisvaloracions = response.data;
            })
            .catch( error => {
                console.log(error)
            })
            .finally(() => this.loading = false)
      },

      confirmDelete( afectat, keyindex )
      {
          this.key_tmp = keyindex
          this.afectat = afectat;
          $('#confirmDelete').modal("show")
      },

      deleteAfectat()
      {
        this.afectats.splice(this.work_key, 1);
        $('#confirmDelete').modal("hide")
      },

      openModalAfectat( afectat, keyindex )
      {
          this.key_tmp = keyindex
          this.afectat = afectat
          $('#modalCrearAfectat').modal("show")
      },

      createAfectat()
      {
          if ( this.key_tmp >= 0 && this.afectats[this.key_tmp])
          {
              this.afectats[this.key_tmp] = this.afectat
          }
          else
          {
              this.afectats.push(this.afectat)
          }

            // let me = this;

            $('#modalCrearAfectat').modal("hide")

        //   axios
        //     .post('/', me.afectat)
        //     .then(function(response)
        //     {
        //         console.log(respose);

        //         me.selectAfectats();
        //
        //     }).catch(function(error)
        //     {
        //         me.errorMessage = error.response.data.error;
        //     })
      },

      cleanAfectat()
      {
        return {
            id: 0,
            telefon: '',
            cip: '',
            nom: '',
            cognoms: '',
            edat: '',
            sexe_id: 0,
            tipus_recursos_id: '',
            codi_gravetat: '',
            codi_valoracio: '',
            descripcio: ''
        }
      },
      // - - - - - - - - - - - - - - - - - - - - - SELECT DESTI: onChangeDesti =>
        onChangeDesti( ev ) {

            if ( ev.currentTarget.selectedIndex > 0) {

                console.log( 'onChangeDesti selected index > 0 (' + ev.currentTarget.selectedIndex +')')
                this.afectat.desti = ev.currentTarget.options[ev.currentTarget.selectedIndex].innerHTML

            } else {

                console.log( 'onChangeDesti selected index <= 0 (' + ev.currentTarget.selectedIndex +')')
                this.afectat.desti = ''

            }

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
                this.simptomesSelected.set( ev.currentTarget.dataset.simptoma, ev.currentTarget.dataset.ind );
                console.log( 'map added element key ' +  ev.currentTarget.dataset.simptoma + ' = ' + ev.currentTarget.dataset.ind );
            } else {
                this.simptomesSelected.delete( ev.currentTarget.dataset.simptoma );
            }
            this.showablesValoracio()
        },
        // - - - - - - - - - - - - - - - - - - - - - SELECT VALORACIO: showablesValoracio =>
        showablesValoracio() {

            var selectobj = document.getElementById('afectat_codivaloracio')

            var showThis = true;

            for (var i=0; i<selectobj.options.length; i++) {

                for (let [key, value] of this.simptomesSelected) {

                    if ( !(key in selectobj.options[i].dataset) && selectobj.options[i].value!=0 ) { showThis = false; }

                }

                if (showThis) {

                    selectobj.options[i].style.display = 'block';

                } else {

                    selectobj.options[i].style.display = 'none';

                }

                showThis = true;

            }

            console.log( 'showablesValoracio -> selected value = ' + selectobj.selectedIndex );
            selectobj.selectedIndex = 0;

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
        // - - - - - - - - - - - - - - - - - - - - - SELECT VALORACIO: addValoracioDataset =>
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
        // - - - - - - - - - - - - - - - - - - - - - SELECT VALORACIO: addValoracioSimptomes =>
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

            this.playIndex = this.findPlayIndexByCodiValoracio( this.valoracionCodi )

            if ( this.playIndex>=0 ) {

                this.videoIndex = this.findVideoIndexByPlayIndex( this.vdsplay[this.playIndex].id_video )

                console.log(' codi valoracion in playvideos ' + this.vdsvideos[this.videoIndex].filename )
                this.play_video = this.appurl + '/'+encodeURI(this.vdsvideos[this.videoIndex].filename)

                console.log( 'start script ->' );
                var videoValoracio = document.getElementById('videoValoracio');

                console.log(' - videoid: ' + this.videoIndex +
                            ' -> start: '+ this.vdsplay[this.playIndex].start +
                            ' / ends: '+ this.vdsplay[this.playIndex].ends +
                            ' / playevent: '+ this.vdsplay[this.playIndex].playevent
                )

                // variables de video
                this.videoPlayingTime = 0
                this.videoPositionStart = this.vdsplay[this.playIndex].start
                this.videoPositionEnd = this.vdsplay[this.playIndex].ends
                this.videoPlayEvents = this.vdsplay[this.playIndex].playevent

                // set video start position
                videoValoracio.currentTime = this.videoPositionStart
                videoValoracio.dataset.start = this.videoPositionStart
                videoValoracio.dataset.end = this.videoPositionEnd
                videoValoracio.dataset.playevent = ((this.videoPlayEvents)?'1':'0')

                // eventos de botones de video
                document.getElementById('homButton').onclick = function (ev) {
                    console.log(' - HomeButton click event -> this.videoPositionStart: ' + this.videoPositionStart )
                    var videoValoracio = document.getElementById('videoValoracio');
                    videoValoracio.currentTime = this.videoPositionStart;
                }.bind(this)
                document.getElementById('rewButton').onclick = function (ev) {
                    var videoValoracio = document.getElementById('videoValoracio');
                    if ( (videoValoracio.currentTime-10) < this.videoPositionStart ) { videoValoracio.currentTime = this.videoPositionStart; }
                    else { videoValoracio.currentTime -= 10; }
                }.bind(this)
                document.getElementById('plyButton').onclick = function (ev) {
                    var videoValoracio = document.getElementById('videoValoracio');
                    if (!videoValoracio.paused) { videoValoracio.pause(); }
                    else { videoValoracio.play(); }
                }.bind(this)
                document.getElementById('fwrButton').onclick = function (ev) {
                    var videoValoracio = document.getElementById('videoValoracio');
                    if ( (videoValoracio.currentTime+10) > this.videoPositionEnd ) { videoValoracio.currentTime = this.videoPositionEnd; }
                    else { videoValoracio.currentTime += 10; }
                }.bind(this)
                document.getElementById('endButton').onclick = function (ev) {
                    console.log(' - EndButton click event -> this.videoPositionEnd: ' + this.videoPositionEnd )
                    var videoValoracio = document.getElementById('videoValoracio');
                    videoValoracio.currentTime = this.videoPositionEnd;
                }.bind(this)

                // videoValoracio.canplaythrough = function() { videoValoracioInit(); };
                // videoValoracio.play = function() { console.log( 'start script -> play' ); };
                // videoValoracio.playing = function() { console.log( 'start script -> playing' ); };

                videoValoracio.ontimeupdate = function(me) { console.log( 'start script -> ontimeupdate' ); videoValoracioPlayingmy(me); }.bind(this);
                //function videoValoracioInit() { console.log( 'videoValoracioPlayingmy ->' ); }

                function videoValoracioPlayingmy(me) {
                    var videoValoracio = document.getElementById('videoValoracio');

                    // pausa si fin
                    if ( videoValoracio.currentTime >= parseInt(videoValoracio.dataset.end) ) {
                        videoValoracio.pause();
                        videoValoracio.currentTime = parseInt(videoValoracio.dataset.end);
                        console.log( 'videoValoracioPlayingmy -> endlimit ('+parseInt(videoValoracio.dataset.end)+')' );
                    }

                    // imprime tiempo de ejecucion de video
                    var calctmp = videoValoracio.currentTime - parseInt(videoValoracio.dataset.start);
                    var timeBox = document.getElementById('timeBox');
                    timeBox.innerHTML = parseInt(calctmp/60)+':'+((parseInt(calctmp%60)<10)?'0':'')+parseInt(calctmp%60);

                    console.log( 'videoValoracioPlayingmy -> calctmp: ' + calctmp +
                    ' / parseInt(calctmp/60): ' + parseInt(calctmp/60) +
                    ' / parseInt(calctmp%60): ' + parseInt(calctmp%60)
                    );

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
        // - - - - - - - - - - - - - - - - - - - - - VIDEO VALORACIO: findPlayIndexByCodiValoracio =>
        findPlayIndexByCodiValoracio( code ) {

            var i = -1, foud = -1;
            if (code.length>0) {
                while (foud<0 && ++i<this.vdsplay.length) {
                    if (this.vdsplay[i].id_caller==code) { foud = i; }
                }
            }
            return foud

        },
        // - - - - - - - - - - - - - - - - - - - - - VIDEO VALORACIO: findVideoIndexByPlayIndex =>
        findVideoIndexByPlayIndex( videoid ) {

            var i = -1, foud = -1;
            if (videoid>=0) {
                while (foud<0 && ++i<this.vdsplay.length) {
                    if (this.vdsvideos[i].id==videoid) { foud = i; }
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

  },
  mounted() {
      console.log('Component mounted')
  }
};
</script>
