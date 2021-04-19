<template>
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
                <div class="col">
                    <label for="destino"><small>DESTINO:</small></label>
                    <input class="form-control form-control-sm" id="destino" v-model="destino" type="text" name="num"
                        value="0" disabled>
                </div>
            </div>
        </div>

        <input class="btn btn-primary" value="HORA">

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

</template>
<script>
export default {
  data() {
    return {

    }
  }
}
