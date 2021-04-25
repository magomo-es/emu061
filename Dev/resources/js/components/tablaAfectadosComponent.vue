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
                                    <label for="afectat_nom" class="col-12 col-form-label pl-1">
                                        <small>Nom</small>
                                    </label>

                                    <input type="text" id="afectat_nom" class="col-12 form-control" v-model="afectat.nom">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row px-1">
                                    <label for="afectat_cognoms" class="col-12 col-form-label pl-1">
                                        <small>Congnoms</small>
                                    </label>

                                    <input type="text" id="afectat_cognoms" class="col-12 form-control"  v-model="afectat.cognoms">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-4">
                                <div class="row px-1">
                                    <label for="afectat_cip" class="col-12 col-form-label pl-1">
                                        <small>CIP</small>
                                    </label>

                                    <input type="text" id="afectat_cip" class="col-12 form-control" v-model="afectat.cip">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="row px-1">
                                    <label for="afectat_edat" class="col-12 col-form-label pl-1">
                                        <small>Edat</small>
                                    </label>

                                    <input type="text" id="afectat_edat" class="col-12 form-control" v-model="afectat.edat">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="row px-1">
                                    <label for="afectat_sexesid" class="col-12 col-form-label pl-1">
                                        <small>Sexe</small>
                                    </label>

                                    <select id="afectat_sexesid" class="select-form col-12 custom-select" v-model="afectat.sexe_id">
                                        <option v-for="sexe in sexes" :key="sexe.id" value="sexe.id">{{ sexe.nom }}</option>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <div class="row px-1">
                                    <label for="afectat_tipusrecursosid" class="col-12 col-form-label pl-1">
                                        <small>Tipus Recurs</small>
                                    </label>

                                    <select id="afectat_tipusrecursosid" class="select-form col-12 custom-select">
                                        <option v-for="recurs in tipus_recurs" :key="recurs.id">{{ recurs.nom }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row px-1">
                                    <label for="afectat_codigravetat" class="col-12 col-form-label pl-1">
                                        <small>Codi Gravetat</small>
                                    </label>

                                    <select id="afectat_codigravetat" class="select-form col-12 custom-select">
                                        <option v-for="grav in codis_gravetat" :key="grav.id" value="grav.id">{{ grav.nom }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="row px-1">
                                    <label for="afectat_codivaloracio" class="col-12 col-form-label pl-1">
                                        <small>Codi Valoracio</small>
                                    </label>

                                    <select id="afectat_codivaloracio" class="select-form col-7 custom-select">
                                        <option v-for="codi in codis_valoracio" :key="codi.id" value="codi.id">{{ codi.nom }}</option>
                                    </select>

                                    <button type="button" class="col-2 btn btn-outline-secondary ml-3"><i class="bi bi-camera-reels"></i> Video</button>
                                    <button type="button" class="col-2 btn btn-outline-secondary ml-3" data-toggle="collapse"><i class="bi bi-globe2"></i> Ayuda</button>
                                </div>

                                <div id="collapseAyuda" class="collapse">
                                    <div class="card card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="row px-1">
                                    <label for="afectat_descripcio" class="col-12 col-form-label pl-1">
                                        <small>Descripcio</small>
                                    </label>

                                    <textarea rows="2" id="afectat_descripcio" class="col-12 form-control" v-model="afectat.descripcio"></textarea>
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
            key_tmp: 0,

            afectat: {
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
            },
            afectats: [],
            sexes: [],
            tipus_recurs: [],
            codis_gravetat: [],
            codis_valoracio: []
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
                me.tipus_recurs = response.data;
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
                me.codis_gravetat = response.data;
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
                me.codis_valoracio = response.data;
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
      }

  },
  mounted() {
      console.log('Component mounted')
  }
};
</script>
