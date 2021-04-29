<template>
<div onload="clock()" class="container-lg mt-2" style="max-width: 1300px;">

        <div class="row">
                <div class="col-4">
                    <br>
                    <div class='time-frame'>
                        <div id='date-part'></div>
                        <div id='time-part'></div>
                    </div>
                </div>
                <div class="col-4" style="display: flex; justify-content: center; align-items: center;">
                    <div>
                        <label for="codIncidencia"><small>Cod. Incidencia:</small></label>
                        <input class="form-control form-control-sm" id=""  type="text" name="num" value="0" disabled>
                    </div>
                </div>
            <div class="col-4">
            </div>
        </div>


        <div class="row">
                <div class="col-6">
                    <label for="afectatNom"><small>Nom i cognoms:</small></label>
                    <input class="form-control form-control-sm" id="" :value="afectats[0].nom" type="text" name="num" readonly>

                    <label for="afectatCip"><small>CIP:</small></label>
                    <input class="form-control form-control-sm" id="" :value="afectats[0].cip" type="text" name="num" readonly>
                </div>
            <div class="col-6">
                <label for="afectatNom"><small>Gravetat:</small></label>
                <input class="form-control form-control-sm" id="" :value="afectats[0].codi_gravetat" type="text" name="num" readonly>

                <label for="afectatCip"><small>Valoració:</small></label>
                <input class="form-control form-control-sm" id="" :value="afectats[0].codi_valoracio" type="text" name="num" readonly>
            </div>
        </div>
        <br>
            <!-- <p v-if="errors.length">
                <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
            </p> -->
      <p>
        <a class="btn btn-secondary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Veure Descripció</a>
        </p>
      <div class="row">
        <div class="col">
          <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card card-body">
                Descripció
            </div>
          </div>
        </div>
      </div>

    <div class="form-group">
        <div class="row">
            <div class="col">
                <label for="destino"><small>DESTINO:</small></label>
                <input class="form-control form-control-sm" id="destino" type="text" name="num" value="CALLE FALSA 123" readonly="readonly">
            </div>
        </div>
    </div>

        <br>

        <div>
            <button type="button" @click="horaAct()" id="activacion" class="btn btn-primary btn-lg w-100" style="height:60px"> HORA ACTIVACIÓ </button>
        </div>
        <br>

        <div>
            <button type="button" @click="horaMob()" id="mobilizacion" class="btn btn-primary btn-lg w-100" style="height:60px" disabled> HORA MOBILITZACIÓ </button>
        </div>
        <br>

        <div>
            <button type="button" @click="horaAsis()" id="asistencia" class="btn btn-primary btn-lg w-100" style="height:60px" disabled> HORA ASISTENCIA </button>
        </div>
        <br>

        <div>
            <button type="button" @click="horaTrans()" id="transporte" class="btn btn-primary btn-lg w-100" style="height:60px" disabled> HORA TRANSPORTE  </button>
        </div>
        <br>

        <div>
            <button type="button" @click="horaArrib()" id="llegada" class="btn btn-primary btn-lg w-100" style="height:60px" disabled> HORA ARRIBADA </button>
        </div>
        <br>

        <div>
            <button type="button" @click="horaTransf()" id="transferencia" class="btn btn-primary btn-lg w-100" style="height:60px" disabled> HORA TRANSFERENCIA </button>
        </div>
        <br>

        <div>
            <button type="button" @click="horaFin()" id="finalizacion" class="btn btn-primary btn-lg w-100" style="height:60px" disabled> HORA FINALITZACIÓ </button>
        </div>
        <br>

  </div>

</template>
<style>
        .time-frame {
        background-color: #000000;
        color: #ffffff;
        font-family: Arial;
        }

        .time-frame > div {
            width: 100%;
            text-align: center;
        }

        #date-part {
            font-size: 1.2em;
        }
        #time-part {
            font-size: 2em;
        }
</style>
<script>
    export default {
    data() {
        return {
            afectats:[],

        }
    }, methods:{
        getAfectat(){
            let me = this;
            axios
                .get('http://app.emu061.es/api/afectats')
                .then(response => {
                    me.afectats = response.data.data;
                })
                .catch( error => {
                    console.log(error)
                })
                .finally(() => this.loading = false)
        },
        clock() {
            var clockElement = document.getElementById('time-part');
            var clockElement2 = document.getElementById('date-part');
            var fecha = new Date();
            var segundos = fecha.getSeconds();
            var minutos = fecha.getMinutes();
            var horas = fecha.getHours();
            var day = fecha.getDay();
            var mes = fecha.getMonth();

            switch(day) {
                case 0:
                    day = "Dom"
                    break;
                case 1:
                    day = "Lun"
                    break;
                case 2:
                    day = "Mar"
                    break;
                case 3:
                    day = "Mie"
                    break;
                case 4:
                    day = "Jue"
                    break;
                case 5:
                    day = "Vie"
                    break;
                case 6:
                    day = "Sab"
                    break;
                }

                switch(mes) {
                case 0:
                mes = "Enero"
                    break;
                case 1:
                mes = "Febrero"
                    break;
                case 2:
                mes = "Marzo"
                    break;
                case 3:
                mes = "Abril"
                    break;
                case 4:
                mes = "Mayo"
                    break;
                case 5:
                mes = "Junio"
                    break;
                case 6:
                mes = "Julio"
                    break;
                case 7:
                mes = "Agosto"
                    break;
                case 8:
                mes = "Septiembre"
                    break;
                case 9:
                mes = "Octubre"
                    break;
                case 10:
                mes = "Noviembre"
                    break;
                case 11:
                mes = "Diciembre"
                    break;
                }

            clockElement.textContent = (( horas <= 9) ? '0' : '') + horas + ':'
                + (( minutos <= 9) ? '0' : '') + minutos + ':'
                + (( segundos <= 9) ? '0' : '') + segundos;

            clockElement2.textContent = fecha.getDate() + " (" + day + ") " + mes + ' '
            + fecha.getFullYear();
        },
        horaAct(){
            var activacion = document.getElementById('activacion');
            var mobilizacion = document.getElementById('mobilizacion');
            var array = this.getDate();

            var texto = array[0] + ":" + array[1] + ":" + array[2];

            activacion.textContent ="HORA ACTIVACIÓ [" + texto + "]";
            activacion.disabled = true;
            mobilizacion.disabled = false;
        },
        horaMob(){
            var asistencia = document.getElementById('asistencia');
            var mobilizacion = document.getElementById('mobilizacion');
            var array = this.getDate();

            var texto = array[0] + ":" + array[1] + ":" + array[2];

            mobilizacion.textContent ="HORA MOBILITZACIÓ [" + texto + "]";
            asistencia.disabled = false;
            mobilizacion.disabled = true;
        },
        horaAsis(){
            var asistencia = document.getElementById('asistencia');
            var transporte = document.getElementById('transporte');
            var destino = document.getElementById('destino');
            var array = this.getDate();

            var texto = array[0] + ":" + array[1] + ":" + array[2];

            asistencia.textContent ="HORA ASISTENCIA [" + texto + "]";
            destino.value = "CALLE HOSPITAL";
            asistencia.disabled = true;
            transporte.disabled = false;
        },
        horaTrans(){
            var llegada = document.getElementById('llegada');
            var transporte = document.getElementById('transporte');
            var array = this.getDate();
            var texto = array[0] + ":" + array[1] + ":" + array[2];

            transporte.textContent ="HORA TRANSPORT [" + texto + "]";
            transporte.disabled = true;
            llegada.disabled = false;
        },
        horaArrib(){
            var llegada = document.getElementById('llegada');
            var transferencia = document.getElementById('transferencia');
            var array = this.getDate();

            var texto = array[0] + ":" + array[1] + ":" + array[2];

            llegada.textContent ="HORA ARRIBADA [" + texto + "]";
            llegada.disabled = true;
            transferencia.disabled = false;
        },
        horaTransf(){
            var transferencia = document.getElementById('transferencia');
            var fin = document.getElementById('finalizacion');
            var array = this.getDate();
            var texto = array[0] + ":" + array[1] + ":" + array[2];

            transferencia.textContent ="HORA TRANSFERENCIA [" + texto + "]";
            transferencia.disabled = true;
            fin.disabled = false;
        },
        horaFin(){
            var transferencia = document.getElementById('transferencia');
            var fin = document.getElementById('finalizacion');
            var array = this.getDate();

            var texto = array[0] + ":" + array[1] + ":" + array[2];

            fin.textContent ="HORA FINALIZACIÓ [" + texto + "]";
            transferencia.disabled = true;
            fin.disabled = true;

        }, getDate() {
            var fecha = new Date();
            var array = [];

            var segundos = fecha.getSeconds();
            var minutos = fecha.getMinutes();
            var horas = fecha.getHours();

            if(horas <= 9){
               horas = "0" + horas;
            }

            if(minutos <= 9){
               minutos = "0" + minutos;
            }

            if(segundos <= 9){
               segundos = "0" + segundos;
            }

            array.push(horas, minutos, segundos);

            return array;
        }
    },
    mounted(){


        setInterval(this.clock, 1000);

    },
    created(){
        this.getAfectat()
    }
    }
</script>
