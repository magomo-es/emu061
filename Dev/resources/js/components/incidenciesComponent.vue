<template>
    <main>
        <div class="container-lg" style="max-width: 1300px;">
        <form id="app" @submit.prevent="onSubmit" action="" method="post" novalidate="true">

            <p v-if="errors.length">
                <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
            </p>

            <div class="form-group">
                <div class="row">
                    <div class="col" style="max-width: max-content;">
                        <label for="num">Número:</label>
                        <input class="form-control form-control-sm" id="num" v-model="num" type="number" name="num" value="0" disabled>
                    </div>

                    <div class="col" style="max-width: max-content;">
                        <label for="data">Data:</label>
                        <input class="form-control form-control-sm" id="data" v-model="data" type="date" name="data">
                    </div>


                    <div class="col" style="max-width: max-content;">
                        <label for="hora">Hora:</label>
                        <input class="form-control form-control-sm" id="hora" v-model="hora" type="datetime" name="hora">
                    </div>


                    <div class="col">
                        <label for="munics">Municipi:</label>
                        <select class="form-control form-control-sm" id="munics" v-model="munics">
                            <option v-for="munic in munics">{{ munic }}</option>
                        </select>
                    </div>


                    <div class="col">
                        <label for="comarcas">Comarca:</label>
                        <select class="form-control form-control-sm" name="comarcas" id="comarcas" v-model="comarcas">
                            <option v-for="comarca in comarcas">{{ comarca }}</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="provincia">Provincia:</label>
                        <select class="form-control form-control-sm" name="provincia" id="provincia" v-model="provincia">
                            <option v-for="prov in provincia">{{ prov }}</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="direcc">Direcció:</label>
                        <input class="form-control form-control-sm" id="direcc" v-model="direcc" type="text" name="direcc">
                    </div>

                    <div class="col">
                        <label for="direcc_compl">Direcció Compl.</label>
                        <input class="form-control form-control-sm" id="direcc_compl" v-model="direcc_compl" type="text"
                            name="direcc_compl">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="desc">Descripció</label>
                <textarea class="form-control form-control-sm" id="desc" v-model="desc" rows="2"></textarea>
            </div>

            <hr>

                <tablaAfectados></tablaAfectados>
            <!-- <div class="form-group">
                <label for="desc">Llista d'afectats:</label>
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Noms</th>
                            <th>Cognoms</th>
                            <th>CIP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Rodolfo</td>
                            <td>Gallardo</td>
                            <td>0000000000</td>
                        </tr>
                        <tr>
                            <td>Marcelo</td>
                            <td>Goncevatt</td>
                            <td>0000000000</td>
                        </tr>
                        <tr>
                            <td>Mario</td>
                            <td>de la Torre</td>
                            <td>0000000000</td>
                        </tr>
                    </tbody>
                  </table>
            </div> -->

            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Enviar">
            </div>

        </form>
    </div>
    </main>


</template>

<script>

export default {

    data: {
      errors: [],
      num: null,
      data: null,
      hora: null,
      munics: ['Barcelona', 'Hospitalet de Llobregat', 'Badalona', 'Mataró'],
      comarcas: ['Baix Llogregat', 'Barcelonés', 'Baix Penedés'],
      provincia: ['Barcelona', 'Lleida', 'Tarragona', 'Girona'],
      direcc: null,
      direcc_compl: null,
      desc: null,
    },
    methods: {
        onSubmit() {
            this.errors = []

            if ( this.num && this.data && this.hora && this.munics && this.comarcas && this.provincia && this.direcc_compl && this.direcc && this.desc ) {
                let form = {
                    num: this.num,
                    data: this.data,
                    hora: this.hora,
                    munics: this.munic,
                    comarcas: this.comarcas,
                    provincia: this.provincia,
                    direcc: this.direcc,
                    direcc_compl: this.direcc_compl,
                    desc: this.desc
                }
                eventBus.$emit('form-submitted', form)
                this.num = null,
                this.data = null,
                this.hora = null,
                this.munics = null,
                this.comarcas = null,
                this.provincia = null,
                this.direcc_compl = null,
                this.direcc = null,
                this.desc = null
            }
            else {
                if (!this.data) this.errors.push("Has de seleccionar una Data.")
                if (!this.hora) this.errors.push("Has de seleccionar una Hora.")
                if (!this.munics) this.errors.push("Has de seleccionar un Municipi.")
                if (!this.comarcas) this.errors.push("Has de seleccionar una Comarca.")
                if (!this.provincia) this.errors.push("Has de seleccionar una Provincia.")
                if (!this.direcc) this.errors.push("Has d'introduir una Direcció.")
            }
        }
    }
  }

</script>
