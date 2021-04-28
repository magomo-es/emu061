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
                    <input class="form-control form-control-sm" id="num" v-model="num" type="number" name="num" value="0" disabled  aria-label="Numero d'incidència">
                </div>

                <div class="col" style="max-width: max-content;">
                    <label for="data"><small>Data:</small></label>
                    <input class="form-control form-control-sm" id="data" v-model="data" type="date" name="data" aria-label="Data d'incidència">
                </div>


                <div class="col" style="max-width: max-content;">
                    <label for="hora"><small>Hora:</small></label>
                    <input class="form-control form-control-sm" id="hora" v-model="hora" type="time" name="hora" aria-label="Adreça de la incidència">
                </div>


                <div class="col">
                    <label for="munics"><small>Municipi:</small></label>
                    <select class="form-control form-control-sm select-form " id="munics" v-model="incidencia.municipi" aria-label="Municipi de la incidència" @change="filtrarMunicipis($event)">
                        <option v-for="munic in municipis" :key='munic.id' v-bind:value="munic.id">{{ munic.nom }}</option>
                    </select>
                </div>


                <div class="col">
                    <label for="comarcas"><small>Comarca:</small></label>
                    <select class="form-control form-control-sm select-form " name="comarcas" id="comarques-select" v-model="incidencia.comarca" aria-label="Comarca de la incidència" @change="filtrarComarques($event)">
                        <option v-for="comarca in comarques" id="comarques" :key='comarca.id' :value="comarca.id">{{ comarca.nom }}</option>
                    </select>
                </div>

                <div class="col">
                    <label for="provincia"><small>Provincia:</small></label>
                    <select class="form-control form-control-sm select-form " name="provincia-Select" id="provincia-Select" v-model="incidencia.provincia" aria-label="Provincia de la incidència" @change="filtrarProvincies($event)">
                        <option v-for="prov in provincies" :key='prov.id' :value="prov.id" id="provincia">{{ prov.nom }}</option>
                    </select>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="direcc"><small>Adreça:</small></label>
                    <input class="form-control form-control-sm" id="direcc" v-model="direcc" type="text" name="direcc" aria-label="Adreça de la incidència">
                </div>

                <div class="col">
                    <label for="direcc_compl"><small>Adreça Compl.:</small></label>
                    <input class="form-control form-control-sm" id="direcc_compl" v-model="direcc_compl" type="text" name="direcc_compl" aria-label="Adreça de la incidència">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="desc"><small>Descripció:</small></label>
            <textarea class="form-control form-control-sm" id="desc" v-model="desc" rows="2"  aria-label="Descripció de la incidència"></textarea>
        </div>

        <hr>

        <tabla-afectados-component></tabla-afectados-component>

        <div class="form-group mt-4">
            <input class="btn btn-primary" type="submit" value="Confirmar Incidencia" aria-label="Confirmar l'incidència">

            <input class="btn btn-secondary" type="submit" value="Cancel·lar" aria-label="Cancelar l'incidència">


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
        municipis: [],
        comarques: [],
        provincies: [],
        direcc: null,
        direcc_compl: null,
        desc: null,

        incidencia: {
            municipi: '',
            comarca: '',
            provincia: '',
        }
    }
  },
  methods: {
    // getNum()

    getMunicipis()
    {
        let me = this;
        axios
            .get('http://app.emu061.es/api/municipis')
            .then(response => {
                me.municipis = response.data.data;
            })
            .catch( error => {
                console.log(error)
            })
            .finally(() => this.loading = false)
    },

    getComarques()
    {
        let me = this;
          axios
            .get('http://app.emu061.es/api/comarques')
            .then(response => {
                me.comarques = response.data.data;
            })
            .catch( error => {
                console.log(error)
            })
            .finally(() => this.loading = false)
    },

    getProvincies()
    {
        let me = this;
          axios
            .get('http://app.emu061.es/api/provincies')
            .then(response => {
                me.provincies = response.data.data;
            })
            .catch( error => {
                console.log(error)
            })
            .finally(() => this.loading = false)
    },

    filtrarMunicipis(event)
    {
        let municipi_select = this.municipis.find(municipi => municipi.id == event.target.value);

        this.incidencia.comarca = municipi_select.comarca.id;
        this.incidencia.provincia = municipi_select.provincia.id;
    },

    filtrarComarques(event)
    {
        let comarca_select = this.comarques.find(comarca => comarca.id == event.target.value);

        this.incidencia.municipi = "";
        this.incidencia.provincia = comarca_select.provincia.id;
    },

    filtrarProvincies(event)
    {
        //let provincia_select = this.comarques.find(comarca => comarca.id == event.target.value);

        this.incidencia.municipi = "";
        this.incidencia.comarca = "";
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
  },

  created() {

        this.getProvincies()

        this.getMunicipis()

        this.getComarques()

    }
};
</script>
