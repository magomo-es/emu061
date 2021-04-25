<template>
    <main>




    <div class="container-lg mt-2" style="max-width: 1300px;">



    <form id="app" @submit.prevent="onSubmit" action="" method="post" novalidate="true">

        <!-- <p v-if="errors.length">
            <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
        <ul>
            <li v-for="error in errors">{{ error }}</li>
        </ul>
        </p> -->

        <div class="form-group">
            <div class="row">
                <div class="col" style="max-width: max-content;">
                    <label for="num"><small>Número:</small></label>
                    <input class="form-control form-control-sm" id="num" v-model="num" type="number" name="num"
                        value="0" disabled>
                </div>

                <div class="col" style="max-width: max-content;">
                    <label for="data"><small>Data:</small></label>
                    <input class="form-control form-control-sm" id="data" v-model="data" type="date" name="data">
                </div>


                <div class="col" style="max-width: max-content;">
                    <label for="hora"><small>Hora:</small></label>
                    <input class="form-control form-control-sm" id="hora" v-model="hora" type="time" name="hora">
                </div>


                <div class="col">
                    <label for="munics"><small>Municipi:</small></label>
                    <select class="form-control form-control-sm select-form " id="munics" v-model="munics">
                        <option v-for="munic in munics" :key='munic' v-bind:value="munic.id">{{ munic.nom }}</option>
                    </select>
                </div>


                <div class="col">
                    <label for="comarcas"><small>Comarca:</small></label>
                    <select class="form-control form-control-sm select-form " name="comarcas" id="comarcas" v-model="comarcas">
                        <option v-for="comarca in comarcas" :key='comarca'>{{ comarca }}</option>
                    </select>
                </div>

                <div class="col">
                    <label for="provincia"><small>Provincia:</small></label>
                    <select class="form-control form-control-sm select-form " name="provincia" id="provincia"
                        v-model="provincia">
                        <option v-for="prov in provincia" :key='prov'>{{ prov }}</option>
                    </select>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="direcc"><small>Adreça:</small></label>
                    <input class="form-control form-control-sm" id="direcc" v-model="direcc" type="text"
                        name="direcc">
                </div>

                <div class="col">
                    <label for="direcc_compl"><small>Adreça Compl.:</small></label>
                    <input class="form-control form-control-sm" id="direcc_compl" v-model="direcc_compl" type="text"
                        name="direcc_compl">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="desc"><small>Descripció:</small></label>
            <textarea class="form-control form-control-sm" id="desc" v-model="desc" rows="2"></textarea>
        </div>

        <hr>

        <tabla-afectados-component></tabla-afectados-component>

        <div class="form-group mt-4">
            <input class="btn btn-primary" type="submit" value="Confirmar Incidencia">

            <input class="btn btn-secondary" type="submit" value="Cancel·lar">


        </div>

    </form>

  </div>
  </main>

</template>

<style>

.form-group
{
    margin-bottom: 0.5rem !important;
}

.form-group label
{
    margin-bottom: 0rem !important;
}

.form-control-sm
{
    box-shadow: 0px 1px 0.1px grey !important;
}

.label
{
    font-size: 85%;
}

</style>

<script>
import TablaAfectadosComponent from './tablaAfectadosComponent.vue';
export default {
  data() {
    return {
        errors: [],
        num: null,
        TablaAfectadosComponent,
        data: null,
        hora: null,
        munics: [],
        comarcas: [],
        provincia: [],
        direcc: null,
        direcc_compl: null,
        desc: null
    }
  },
  methods: {
    // getNum()

    getMunicipi()
    {
        let me = this;
          axios
            .get('http://app.emu061.es/api/municipis')
            .then(response => {
                me.munics = response.data;
            })
            .catch( error => {
                console.log(error)
            })
            .finally(() => this.loading = false)
    },

    getComarca()
    {
        let me = this;
          axios
            .get('/comarca')
            .then(response => {
                me.comarcas = response.data;
            })
            .catch( error => {
                console.log(error)
            })
            .finally(() => this.loading = false)
    },

    getProvincia()
    {
        let me = this;
          axios
            .get('/provincia')
            .then(response => {
                me.provincia = response.data;
            })
            .catch( error => {
                console.log(error)
            })
            .finally(() => this.loading = false)
    },

    cleanForm() {
        return {
            errors: [],
            num: null,
            TablaAfectadosComponent,
            data: null,
            hora: null,
            munics: [],
            comarcas: [],
            provincia: [],
            direcc: null,
            direcc_compl: null,
            desc: null
        }
    },

    onSubmit() {
      if (
        this.num &&
        this.data &&
        this.hora &&
        this.munics &&
        this.comarcas &&
        this.provincia &&
        this.direcc_compl &&
        this.direcc &&
        this.desc
      ) {
        let form = {
          num: this.num,
          data: this.data,
          hora: this.hora,
          munics: this.munic,
          comarcas: this.comarcas,
          provincia: this.provincia,
          direcc: this.direcc,
          direcc_compl: this.direcc_compl,
          desc: this.desc,
        };
        eventBus.$emit("form-submitted", form);
        (this.num = null),
          (this.data = null),
          (this.hora = null),
          (this.munics = null),
          (this.comarcas = null),
          (this.provincia = null),
          (this.direcc_compl = null),
          (this.direcc = null),
          (this.desc = null);
      }
    },
  }
};
</script>
