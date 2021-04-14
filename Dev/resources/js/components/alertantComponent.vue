<template>

    <div class="container mt-4" style="max-width: 40%;">

        <div class="row g-3 align-items-center">

            <div class="col-auto">
                <label for="tel_alertante" class="col-form-label">Telèfon:</label>
            </div>

            <div class="col-auto">
                <input type="tel_alertante" id="tel_alertante" class="form-control form-control-sm" disabled>
            </div>

            <div class="col-auto cont-vip">
                <a href="" data-toggle="modal" data-target="#exampleModal2">
                    <div class="circle"></div>
                    <span>VIP</span>
                </a>
            </div>

            <div class="col-auto">
                <button class="btn btn-light" style="box-shadow: 0px 1px 0.1px grey;">Veure Alertant</button>
            </div>

        </div>

    </div>

</template>

<style>

.circle
{
    background-color: rgb(27, 220, 27);
    border-radius: 50%;
    width: 10px;
    height: 10px;
    margin-top: 14px;
}

.cont-vip
{
    width: 40px;
    height: 37px;
}

.cont-vip span
{
    color: black;
    float: right;
    margin-top: -17px;
    margin-left: 15px;
}

</style>

<script>
    export default {

    data() {
        return {
            tel_alertante: null
        }
    },
    methods: {

    }
  }
</script>
