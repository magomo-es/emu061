<template>
<main>
    <div class="container-lg" style="max-width: 1300px;">
        <div class="row">
            <div class="col-2">
                <button class="btn btn-dark" type="button" @click="generarLlamada()">
                    Generar Trucada
                </button>
            </div>

            <div class="col-8" style="display: flex; align-items: center; justify-content: center;">
                <div class="row g-3 align-items-center">

                    <div class="col-auto">
                        <label for="tel_alertante" class="col-form-label"><small>Telèfon:</small></label>
                    </div>

                    <div class="col-auto">
                        <input type="text" id="tel_alertante" class="form-control form-control-sm" v-model="alertant.telefon" readonly>
                    </div>

                    <div class="col-auto cont-vip">
                        <a href="" data-toggle="modal" data-target="#exampleModal2" disabled>
                            <div class="circle" id="vip_btn"></div>
                            <span><small>VIP</small></span>
                        </a>
                    </div>

                    <div class="col-auto">
                        <button class="btn btn-light" data-toggle="modal" data-target="#modalAlertant" style="box-shadow: 0px 1px 0.1px grey;">Veure Alertant</button>
                    </div>
                </div>
            </div>

        </div>

        <!-- MODAL -->

        <div class="modal fade" id="modalAlertant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-style">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Alertant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tancar dades de l'alertant">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group px-3">

                            <div class="row">
                                <label for="alertant_nom" class="col-12 col-form-label pl-1"><small>Nom</small></label>
                                <input type="text" class="col-12 form-control" id="alertant_nom" name="alertant_nom" v-model="alertant.nom" aria-label="Nom de l'alertant">
                            </div>

                            <div class="row">
                                <label for="alertant_cognoms" class="col-12 col-form-label pl-1"><small>Congnoms</small></label>
                                <input type="text" class="col-12 form-control" id="alertant_cognoms" name="alertant_cognoms" v-model="alertant.cognoms" aria-label="Cognoms de l'alertant">
                            </div>

                            <div class="row">
                                <label for="alertant_adreca" class="col-12 col-form-label pl-1"><small>Adreça</small></label>
                                <input type="text" class="col-12 form-control" id="alertant_adreca" name="alertant_adreca" v-model="alertant.adreca" aria-label="Adreça de l'alertant">
                            </div>

                            <div class="row">
                                <label for="alertant_municipisid" class="col-12 col-form-label pl-1"><small>Municipi</small></label>
                                <select class="select-form col-12 custom-select" id="alertant_municipisid" v-model="alertant.municipi" title="Selecciona un municipi" name="alertant_municipisid" aria-label="Municipi de l'alertant">
                                    <option v-for="municipi in municipis" :key="municipi.id" :value="municipi.id">{{ municipi.nom }}</option>
                                    <!--v-model="alertant.municipis_id"-->
                                </select>
                            </div>

                            <div class="row">
                                <label for="alertant_tipusalertantsid" class="col-12 col-form-label pl-1"><small>Tipus</small></label>
                                <select class="select-form col-12 custom-select" id="alertant_tipusalertantsid" v-model="alertant.tipus_alertant" name="alertant_tipusalertantsid" aria-label="Tipus d'alertant">
                                    <option v-for="tipus in tipus_alertants" :key="tipus.id" :value="tipus.id">{{ tipus.tipus }}</option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Tancar finestra d'alertant">Cancel·lar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Confirmar dades de l'alertant">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

</template>

<style>

.circle
{
    background-color: yellow;
    border-radius: 50%;
    width: 10px;
    height: 10px;
    margin-top: 14px;
    margin-left: -25px;
}

.cont-vip
{
    width: 40px;
    height: 37px;
    margin-left: 20px;
}

.cont-vip span
{
    color: black;
    float: right;
    margin-top: -17px;
    margin-left: 15px;
}

.ctrlsBtn { position: absolute; top: 10px; padding: 10px; background-color: #eff2ef; color: #333; cursor: pointer; border-radius: 5px; box-shadow: 1px 1px 2px; }

</style>

<script>
export default {

    data() {
        return {
            alertants: [],
            municipis: [],
            tipus_alertants: [],

            alertant:
            {
                telefon: '',
                nom: '',
                cognoms: '',
                adreca: '',
                municipi: '',
                tipus_alertant: ''
            }
        }
    },

    methods: {

        getAlertant()
        {
            let me = this;
            axios
                .get('http://app.emu061.es/api/alertants')
                .then(response => {
                    me.alertants = response.data.data;

                })
                .catch( error => {
                    console.log(error)
                })
                .finally(() => this.loading = false)
        },

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

        getTipus_alertants()
        {
            let me = this;
            axios
                .get('http://app.emu061.es/api/tipus_alertants')
                .then(response => {
                    me.tipus_alertants = response.data.data;
                })
                .catch( error => {
                    console.log(error)
                })
                .finally(() => this.loading = false)
        },

        generarLlamada()
        {
            var random_boolean = Math.random() < 0.4;
            console.log("Random: " + random_boolean);
            var telefon = '';

            // SI ES TRUE -> BUSCA TELEFONO DE AFECTADOS EN API
            if ( random_boolean )
            {
                var alertant_aux = this.alertants[Math.floor(Math.random() * this.alertants.length)];
                console.log(alertant_aux)
                telefon = alertant_aux.telefon;

                this.alertant.nom = alertant_aux.nom;
                this.alertant.cognoms = alertant_aux.cognoms;
                this.alertant.adreca = alertant_aux.adreca;
                this.alertant.municipi = alertant_aux.municipi.id;
                this.alertant.tipus_alertant = alertant_aux.tipus_alertants_id;

                $('#vip_btn').css('background-color', '#1bdc1b');
            }
            // SI ES FALSE -> GENERA UN NUMERO DE TELEFONO ALEATORIO
            else
            {
                telefon = Math.floor(100000000 + Math.random() * 900000000);

                $('#vip_btn').css('background-color', 'red');
            }

            this.alertant.telefon = telefon;

        }
    },

    created() {

        this.getMunicipis()

        this.getAlertant()

        this.getTipus_alertants()

    }

}
</script>
