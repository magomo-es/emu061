<template>
<main>

<div class="alert alert-info text-white" v-bind:class="{ 'bg-danger': retError }" role="alert" v-on:click="resetReturn()" v-show="showMsgs">{{ retMessage + ' ('+retStatus+')' }}</div>

<div class="card">

    <div class="card-header">Nou Incidencia</div>

    <div class="card-body">

        <form action="{{ action( [App\Http\Controllers\IncidenciaController::class, 'store'] ) }}" method="POST">

            @csrf

            <div class="form-group row">

                <div class="col-3">
                    <div class="row">
                        <label for="xnumincident" class="col-4 col-form-label"><small>Id Incidencia</small></label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="numincident" name="numincident" value="{{ old('numincident') }}" v-model="incident.numincident">
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="xdata" class="col-4 col-form-label"><small>Data</small></label>
                        <div class="col-8">
                            <input type="date" class="form-control" id="xdata" name="xdata"
                            min="{{ date('Y-m-d',time()-86400) }}" max="{{ date('Y-m-d',time()+86400) }}"
                            value="{{ (!empty(old('xdata'))?old('xdata'):date('Y-m-d',time())) }}" required>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="row">
                        <label for="xhora" class="col-4 col-form-label"><small>Hora</small></label>
                        <div class="col-8">
                            <input type="time" class="form-control" id="xhora" name="xhora"
                            value="{{ (!empty(old('xhora'))?old('xhora'):date('G:i',time())) }}" required>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="row">
                        <label for="xtelefonalertant" class="col-2 col-form-label"><small>Telefon</small></label>
                        <div class="col-6">
                            <input type="text" class="form-control" id="xtelefonalertant" name="xtelefonalertant" value="{{ old('xtelefonalertant') }}">
                        </div>
                        <div class="col-4">
                            <button id="addAlertant" type="button" class="btn btn-primary w-100 px-3" @click="openAlertantEdit()">Alertant</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <label for="xadreca" class="col-1 col-form-label"><small>Adreça</small></label>
                <div class="col-11">
                    <input type="text" class="form-control" id="xadreca" name="xadreca" value="{{ old('xadreca') }}">
                </div>

            </div>

            <div class="form-group row">

                <div class="col-6">
                    <div class="row">
                        <label for="xadrecacomplement" class="col-2 col-form-label"><small>Adreça comp</small></label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="xadrecacomplement" name="xadrecacomplement" value="{{ old('xadrecacomplement') }}">
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <label for="xmunicipisid" class="col-2 col-form-label"><small>Municipi</small></label>
                        <div class="col-10">
                            <select class="custom-select" id="xmunicipisid" name="xmunicipisid">
                                @foreach ($municipisAry as $municipi)
                                <option value="{{ $municipi->id }}" {{ ((old('xmunicipisid')==$municipi->id)?'selected':'') }}>{{ $municipi->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <div class="col">
                    <div class="row">
                        <label for="xdescripcio" class="col-1 col-form-label pr-1"><small>Descripcio</small></label>
                        <div class="col-11">
                            <textarea rows="6" class="form-control" id="xdescripcio" name="xdescripcio">{{ old('xdescripcio') }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">

                <div class="col-3">
                    <div class="row">
                        <label for="xnommetge" class="col-4 col-form-label pr-1"><small>Metge</small></label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="xnommetge" name="xnommetge" value="{{ old('xnommetge') }}">
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="xtipusincidenciesid" class="col-3 col-form-label"><small>Tipus</small></label>
                        <div class="col-9">
                            <select class="custom-select" id="xtipusincidenciesid" name="xtipusincidenciesid">
                                @foreach ($tipusAry as $tipus)
                                <option value="{{ $tipus->id }}" {{ ((old('xtipusincidenciesid')==$tipus->id)?'selected':'') }}>{{ $tipus->tipus }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="xalertantsid" class="col-3 col-form-label"><small>Alertant</small></label>
                        <div class="col-9">
                            <select class="custom-select" id="xalertantsid" name="xalertantsid">
                                @foreach ($alertantsAry as $alertant)
                                <option value="{{ $alertant->id }}" {{ ((old('xalertantsid')==$alertant->id)?'selected':'') }}>{{ $alertant->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="row">
                        <label for="xusuarisid" class="col-3 col-form-label"><small>Usuari</small></label>
                        <div class="col-9">
                            <select class="custom-select" id="xusuarisid" name="xusuarisid">
                                @foreach ($usuarisAry as $usuari)
                                <option value="{{ $usuari->id }}" {{ ((old('xusuarisid')==$usuari->id)?'selected':'') }}>{{ $usuari->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">

                <a class="btn btn-secondary" href="{{ action([App\Http\Controllers\IncidenciaController::class, 'index']) }}">Cancel.lar</a>
                <button type="submit" class="btn btn-dark">Aceptar</button>

            </div>

        </form>

    </div>

</div>









































                <tr v-for="cicle in cicles" v-bind:key="cicle.id">
                    <td>{{ cicle.id }}</td>
                    <td>{{ cicle.sigles }}</td>
                    <td>{{ cicle.nom }}</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" v-bind:checked="cicle.actiu" disabled>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="btn-group" role="group">
                            <button class="btn btn-secondary btn-sm" @click="openEditCicle(cicle)">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                        </div>
                        <div class="btn-group ml-1" role="group">
                            <button type="submit" class="btn btn-danger btn-sm" @click="confirmDeleteCicle(cicle)">
                                <i class="fas fa-trash"></i> Esborrar
                            </button>
                        </div>
                    </td>
                </tr>















<!-- Modal Delete -->
<div id="deleteModal" class="modal" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Esborrar Cicle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">Estas segur de que vols esborrar el cicle {{ cicle.sigles }} ?</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Tarcar</button>
          <button type="submit" class="btn btn-danger" @click="deleteCicle()"><i class="fas fa-trash"></i> Esborrar</button>
        </div>
      </div>
    </div>
</div>
<!-- Modal Delete -->

<!-- Modal Inser/Update -->
<div id="editModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edita Cicle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

            <div class="alert alert-info text-white" v-bind:class="{ 'bg-danger': retError }" role="alert" v-on:click="resetReturn()" v-show="showModalMsgs">{{ retMessage + ' ('+retStatus+')' }}</div>

          <form>
            <div class="form-group row">
                <label for="xsigles" class="col-sm-2 col-form-label">Sigles</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xsigles" name="xsigles" v-model="cicle.sigles">
                </div>
            </div>

            <div class="form-group row">
                <label for="xnom" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="xnom" name="xnom" v-model="cicle.nom">
                </div>
            </div>

            <div class="form-group row">
                <label for="xdescripcio" class="col-sm-2 col-form-label">Descripcio</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="xdescripcio" name="xdescripcio" rows="5" v-model="cicle.descripcio"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="xactiu" class="col-sm-2 col-form-label">Actiu</label>
                <div class="col-sm-10 pl-2">
                    <input class="form-check-input ml-1" type="checkbox" value="1" id="xactiu" name="xactiu" v-model="cicle.actiu">
                </div>
            </div>

          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Tarcar</button>
          <button type="submit" class="btn btn-primary" @click="saveCicle()"><i class="fas fa-trash"></i> {{ (!cicle.id)?'Afegir':'Modificar' }}</button>
        </div>
      </div>
    </div>
</div>
<!-- Modal -->



</main>

</template>

<script>
    export default {
        data() {
            return {
                frm_formelement: { id: 0, title: '', description: '', tagid: '' }, frmelements: [],
                codi_gravetat: { codi: '', nom: '' }, gravetat: [],
                codi_valoracio: { codi: '', nom: '' }, valoracions: [],
                hlp_valoracio: { codi_valoracio: '', translation: '', soundlike: '', jsontags: '' , simptomes: [] }, hlpvaloracions: [],
                hlp_simptoma: { id: 0, pregunta: '', translation: '', soundlike: '' }, hlpsimtomes: [],
                vds_video: { id: 0, title: '', description: '', filename: '' }, vdsvideos: [],
                vds_play: { id: 0, title: '', id_caller: '', id_video: 0, start: 0, ends: 0, playevent: false }, vdsplayers: [],
                vds_event: { id: 0, title: '', id_video: 0, ontime: 0, timeout: 0, type: 0, jsondata: '' }, vdsevents: [],
                afectat: { id: 0, telefon: 0, cip: '', nom: '', cognoms: '', edat: '', te_cip: 0, sexes_id: 0, descripcio: '', tipus_recursos_id: 0, codi_gravetat: '', codi_valoracio: '' }, afectats: [],
                sexe: { id: 0, sexe: '' }, sexes: [],
                municipi: { id: 0, nom: '', comarques_id: 0 }, municipis: [],
                alertant: { id: 0, telefon: 0, nom: '', cognoms: '', adreca: '', municipis_id: 0, tipus_alertants_id: 0 }, alertants: [],
                tipus_incidencia: { id: 0, tipus: '', video: '' }, tipusincidencias: [],
                recurso: { id: 0, codi: '', actiu: false, tipus_recursos_id: 0 },
                recursos: [],
                hasrecurso: { incidencies_id: 0, recursos_id: 0, afectats_id: 0, hora_activacio: '', hora_mobilitzacio: '', hora_assistencia: '', hora_transport: '', hora_arribada_hospital: '', hora_transferencia: '', hora_finalitzacio: '', prioritat: 0, desti: '', desti_alertant_id: 0 }, hasrecursos: [],
                incidencies: {
                id: 0,
                num_incident: 0,
                data: '',
                hora: '',
                telefon_alertant: 0,
                adreca: '',
                adreca_complement: '',
                descripcio: '',
                nom_metge: '',
                tipus_incidencies_id: 0,
                alertants_id: 0,
                municipis_id: 0,
                usuaris_id: 0,
                afectats: []
                },
                retError: false,
                retMessage: "",
                retStatus: 0,
                showMsgs: false,
                showModalMsgs: false
            }
        },
        methods: {
            resetCicle() {
                return { id: '', sigles: '', nom: '', descripcio: '', actiu: false }
            },
            resetReturn() {
                this.retError = false
                this.retMessage = ""
                this.retStatus = 0
                this.showMsgs = false
                this.showModalMsgs = false
            },
            selectCicles() {
                this.resetReturn()
                let me = this;
                axios.get('/api/cicles')
                    .then(response => { me.cicles = response.data; })
                    .catch(error => {
                        console.log(error);
                        me.retError = true
                        me.retMessage = response.error
                        me.retStatus = response.status
                        me.showMsgs = true
                    } )
                    .finally( () => this.loading = false )
            },
            confirmDeleteCicle(cicle) {
                this.resetReturn()
                this.cicle = cicle
                $('#deleteModal').modal('show')
            },
            openEditCicle(cicle) {
                this.resetReturn()
                this.cicle = JSON.parse(JSON.stringify(cicle))
                $('#editModal').modal('show')
            },
            saveCicle() {
                let me = this;
                if (!this.cicle.id) {
                    console.log( 'insert cicle -> url -> ' + '/api/cicles');
                    axios
                        .post( '/api/cicles', me.cicle )
                        .then( response => {
                            console.log(response)
                            me.selectCicles()
                            $('#editModal').modal('hide')
                            me.retMessage = 'Cicle '+me.cicle.sigles+' Afegit'
                            me.retStatus = response.status
                            me.showMsgs = true
                        } )
                        .catch( error => {
                            console.log(error.response.status)
                            console.log(error.response.data)
                            me.retError = true
                            me.retMessage = error.response.data.error
                            me.retStatus = error.response.status
                            me.showModalMsgs = true
                        })
                } else {
                    console.log( 'update cicle -> url -> ' + '/api/cicles/' + this.cicle.id);
                    axios
                        .put( '/api/cicles/'+this.cicle.id, me.cicle )
                        .then( response => {
                            console.log(response)
                            me.selectCicles()
                            $('#editModal').modal('hide')
                            me.retMessage = 'Cicle '+me.cicle.sigles+' Modificat'
                            me.retStatus = response.status
                            me.showMsgs = true
                        } )
                        .catch( error => {
                            console.log(error)
                            me.retError = true
                            me.retMessage = error.response.data.error
                            me.retStatus = error.response.status
                            me.showModalMsgs = true
                        })
                }
            },
            deleteCicle() {
                let me = this;
                console.log('/api/cicles/' + me.cicle.id);
                axios
                    .delete( '/api/cicles/' + me.cicle.id )
                    .then( response => {
                        console.log(response)
                        me.selectCicles()
                        $('#deleteModal').modal('hide')
                        me.retMessage = response.data.message
                        me.retStatus = response.status
                        me.showMsgs = true
                    } )
                    .catch( error => {
                        $('#deleteModal').modal('hide')
                        console.log(error);
                        me.retError = true
                        me.retMessage = error.response.data.error
                        me.retStatus = error.response.status
                        me.showMsgs = true
                    })
            }
        },
        created() {
            this.selectCicles()
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
