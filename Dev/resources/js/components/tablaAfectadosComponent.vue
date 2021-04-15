<template>
    <div class="form-group">
        <label for="desc"><small>Llista d'afectats:</small></label>

        <div class="tableFixHead">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Noms</th>
                        <th scope="col">Cognoms</th>
                        <th scope="col">Edat</th>
                        <th scope="col">CIP</th>
                        <th scope="col" class="text-right">
                            <div role="group" class="btn-group ml-1">
                                <button type="button" class="btn btn-primary btn-sm m-1" data-toggle="modal" data-target="#modalCrearAfectat" @click="openModalAfectat()">
                                    <i class="fas fa-plus"></i> Nou Afectat
                                </button>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="afectat in afectats" v-bind:key="afectat.id">
                        <td>{{ afectat.nom }}</td>
                        <td>{{ afectat.cognoms }}</td>
                        <td>{{ afectat.edat }}</td>
                        <td>{{ afectat.cip }}</td>

                        <td class="text-right">
                            <!-- FALTA MODAL EDICIÓN -->
                            <div role="group" class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                            </div>

                            <!-- FALTA ELIMINCACIÓN -->
                            <div role="group" class="btn-group ml-1">
                                <button type="button" class="btn btn-danger btn-sm" @click="confirmDelete( afectat )">
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
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">Crear Afectat</h5>
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

                                    <select id="afectat_sexesid" class="col-12 custom-select" v-model="afectat.sexe_id">
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

                                    <select id="afectat_tipusrecursosid" class="col-12 custom-select">
                                        <option v-for="recurs in tipus_recurs" :key="recurs.id">{{ recurs.nom }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row px-1">
                                    <label for="afectat_codigravetat" class="col-12 col-form-label pl-1">
                                        <small>Codi Gravetat</small>
                                    </label>

                                    <select id="afectat_codigravetat" class="col-12 custom-select">
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

                                    <select id="afectat_codivaloracio" class="col-8 custom-select">
                                        <option v-for="codi in codis_valoracio" :key="codi.id" value="codi.id">{{ codi.nom }}</option>
                                    </select>

                                    <button type="button" class="col-2 btn btn-primary">Video</button>
                                    <button type="button" data-toggle="collapse" data-target="#collapseAyuda" aria-expanded="false" aria-controls="collapseExample" class="col-2 btn btn-primary">Ayuda</button>
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

                                    <textarea rows="2" id="afectat_descripcio" class="col-12 form-control" v-model="afectat"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Tarcar</button>
                        <button type="button" class="btn btn-primary" @click="createAfectat()">Afegir</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DELETE -->
        <div class="modal" tabindex="-1" id="confirmDelete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Esborrar Afectat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p>Estas segur de que vols esborrar l'afectat {{ afectat.id }} - {{ afectat.nom }} {{ afectat.cognoms }}</p> <!--Falta mostrar afectat-->
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


</style>

<script>
export default {
  data() {
        return {
            afectat: {
                id: '',
                telefon: '',
                cip: '',
                nom: '',
                cognoms: '',
                edat: '',
                sexe_id: '',
                tipus_recurs_id: '',
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

      confirmDelete( afectat )
      {
        this.afectat = afectat;
        $('#confirmDelete').modal("show")
      },

      deleteAfectat()
      {
          this.afectats.splice(afectat, 1)
      },

      openModalAfectat()
      {
          $('#modalCrearAfectat').modal("show")
      },

      createAfectat()
      {
            // let me = this;

            $('#modalCrearAfectat').modal("hide")
            this.afectats.push(this.afectat);

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
      }

  },
  mounted() {
      console.log('Component mounted')
  }
};
</script>
