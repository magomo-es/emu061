<template>

    <main>

        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#FormatModal"><i class="fas fa-cog"></i></button>

        <!-- Modal Ajustes Colores y Formato -->
        <div class="modal fade" id="FormatModal" tabindex="-1" role="dialog" aria-labelledby="FormatModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Opcions de format</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="row px-1">
                                    <label for="afectat_cip" class="col-12 col-form-label"><small>Font:</small></label>

                                    <label class="col-2 col-form-label"><small>Tamany: </small></label>
                                    <select class="col-5 custom-select" name="font" id="font" v-model="fontSelected">
                                        <option v-for="font in fonts" v-bind:key="font" v-bind:value="font">{{ font }}</option>
                                    </select>

                                    <label class="col-2 col-form-label" style="margin-right: -10px"><small>Color: </small></label>
                                    <input class="col-3 col-form-input" style="height: 37px; padding: 0px;" type="color" v-bind:value="fontColor">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <div class="col-6">
                                <div class="row px-1">
                                    <label for="afectat_cip" class="col-12 col-form-label"><small>Fons de pantalla:</small></label>

                                    <label class="col-4 col-form-label" style="margin-right: -10px"><small>Color: </small></label>
                                    <input class="col-8 col-form-input" style="height: 37px; padding: 0px;" type="color" v-bind:value="screenColor">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row px-1">
                                    <label for="afectat_cip" class="col-12 col-form-label"><small>Caixes:</small></label>

                                    <label class="col-4 col-form-label" style="margin-right: -10px"><small>Fons: </small></label>
                                    <input class="col-8 col-form-input" style="height: 37px; padding: 0px;" type="color" v-bind:value="inputBackgroundColor">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <div class="row px-1">
                                    <label class="col-4 col-form-label" style="margin-right: -10px"><small>Color: </small></label>
                                    <input class="col-8 col-form-input" style="height: 37px; padding: 0px;" type="color" v-bind:value="inputColor">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <div class="row px-1">
                                    <label for="" class="col-12 col-form-label" style="display: flex; justify-content: center;"><small>Aspectes:</small></label>
                                </div>
                            </div>
                            <div class="col-4"></div>
                        </div>

                        <div class="form-group row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="col-12" style="display: flex; justify-content: center; align-items: center;">
                                    <input type="checkbox" class="col-1">
                                    <label for="" class="col-4 col-form-label">Dark</label>

                                    <input type="checkbox" class="col-1">
                                    <label for="" class="col-4 col-form-label">Light</label>
                                </div>
                            </div>
                            <div class="col-2"></div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel·lar</button>
                        <button type="button" class="btn btn-primary" @click="saveChanges()">Acceptar</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

</template>

<style>

</style>

<script>

export default {
  data() {
    return {
        fontSelected: 12,
        fonts: [ 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20 ],
        screenColor: '#f8fafc',
        fontColor: '#212529',
        inputBackgroundColor: '#ffffff',
        inputColor: '#495057'
    }
  }
}

</script>
