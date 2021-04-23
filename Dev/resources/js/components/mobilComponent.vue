<template>
<div onload="time()" class="container-lg mt-2" style="max-width: 1300px;">

    <form id="app" @submit.prevent="onSubmit" action="" method="post" novalidate="true">

    <div class="row">
        <div class="col-4"></div>
            <div class="col-4" style="display: flex; justify-content: center; align-items: center;">
                <div class='time-frame'>
                    <div id='date-part'></div>
                    <div id='time-part'></div>
                </div>
            </div>
        <div class="col-4"></div>
    </div>
        <!-- <p v-if="errors.length">
            <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
        <ul>
            <li v-for="error in errors">{{ error }}</li>
        </ul>
        </p> -->

        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="destino"><small>DESTINO:</small></label>
                    <input class="form-control form-control-sm" id="destino" v-model="destino" type="text" name="num"
                        value="0" disabled>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary">HORA</button>
    </form>

  </div>

</template>
<style>
        .time-frame {
        background-color: #000000;
        color: #ffffff;
        width: 300px;
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

        }
    }, methods:{

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
                case 3:
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
                case 3:
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
        }

    },
    mounted(){

        this.clock();
        setInterval(this.clock, 1000);

    }
    }
</script>
