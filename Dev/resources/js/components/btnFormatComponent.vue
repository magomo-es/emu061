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
                                    <label for="afectat_cip" class="col-12 col-form-label" style="font-size: 80%; font-weight: 400;">Font:</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <div class="row px-1">
                                    <label class="col-4 col-form-label" style="font-size: 80%; font-weight: 400;">Tamany:</label>
                                    <select class="col-8" name="font" id="font" v-model="fontSelected" @change="onChangeSelect($event)">
                                        <option v-for="font in fonts" v-bind:key="font" v-bind:value="font">{{ font }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row px-1">
                                    <label class="col-4 col-form-label" style="font-size: 80%; font-weight: 400;">Color:</label>
                                    <input class="col-7 col-form-input" style="height: 37px; padding: 0px;" type="color" v-bind:value="fontColor" @change="onChangeColorFont($event)">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <div class="col-6">
                                <div class="row px-1">
                                    <label for="afectat_cip" class="col-12 col-form-label" style="font-size: 80%; font-weight: 400;">Fons de pantalla:</label>

                                    <label class="col-4 col-form-label" style="font-size: 80%; font-weight: 400;">Color:</label>
                                    <input class="col-8 col-form-input" style="height: 37px; padding: 0px;" type="color" v-bind:value="screenColor" @change="onChangeBackgroundColor($event)">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row px-1">
                                    <label for="afectat_cip" class="col-12 col-form-label" style="font-size: 80%; font-weight: 400;">Caixes:</label>

                                    <label class="col-4 col-form-label" style="font-size: 80%; font-weight: 400;">Fons:</label>
                                    <input class="col-7 col-form-input" style="height: 37px; padding: 0px;" type="color" v-bind:value="inputBackgroundColor" @change="onChangeBoxBackground($event)">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <div class="row px-1">
                                    <label class="col-4 col-form-label" style="font-size: 80%; font-weight: 400;">Color:</label>
                                    <input class="col-7 col-form-input" style="height: 37px; padding: 0px;" type="color" v-bind:value="inputColor" @change="onChangeBoxFontColor($event)">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <div class="row px-1">
                                    <label for="" class="col-12 col-form-label" style="display: flex; justify-content: center; font-size: 80%; font-weight: 400;">Aspectes:</label>
                                </div>
                            </div>
                            <div class="col-4"></div>
                        </div>

                        <div class="form-group row">
                            <div class="col-2"></div>
                            <div class="col-9">
                                <div class="col-12" style="display: flex; justify-content: center; align-items: center;">
                                    <input type="radio" name="theme" class="col-1" id="dark">
                                    <label for="dark" name="theme" class="col-4 col-form-label" @change="onChangeCheck($event)">Dark</label>

                                    <input type="radio" class="col-1"  name="theme" id="light" >
                                    <label for="light" class="col-4 col-form-label">Light</label>

                                    <input type="radio" class="col-1"  name="theme" id="daltonic">
                                    <label for="daltonic" class="col-4 col-form-label">Daltònic</label>
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
:root {
	--fontSize:12px;
    --fontColor:#212529;
    --BackgroundColor: #f8fafc;
    --BoxBackground: #ffffff;
    --BoxFontColor: #495057;
}

small
{
    font-size: var(--fontSize) !important;
    color: var(--fontColor) !important;
}

body
{
    background-color: var(--BackgroundColor) !important
}

input[type=text]
{
    background-color: var(--BoxBackground) !important;
    color: var(--BoxFontColor) !important;
}
input[type=date]
{
    background-color: var(--BoxBackground) !important;
    color: var(--BoxFontColor) !important;
}
input[type=time]
{
    background-color: var(--BoxBackground) !important;
    color: var(--BoxFontColor) !important;
}
input[type=number]
{
    background-color: var(--BoxBackground) !important;
    color: var(--BoxFontColor) !important;
}
textarea
{
    background-color: var(--BoxBackground) !important;
    color: var(--BoxFontColor) !important;
}
.select-form
{
    background-color: var(--BoxBackground) !important;
    color: var(--BoxFontColor) !important;
}
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
  },
  methods: {
      onChangeSelect(event)
      {
          document.documentElement.style.setProperty('--fontSize', event.target.value+'px');
          console.log("Font: " + event.target.value)
          console.log("FontSelected: " + this.fontSelected)
      },
      onChangeColorFont(event)
      {
          document.documentElement.style.setProperty('--fontColor', event.target.value);
          console.log("Color font: " + event.target.value)
      },
      onChangeBackgroundColor(event)
      {
          document.documentElement.style.setProperty('--BackgroundColor', event.target.value);
          console.log("Color Background: " + event.target.value)
      },
      onChangeBoxBackground(event)
      {
          document.documentElement.style.setProperty('--BoxBackground', event.target.value);
          console.log("Color Background Box: " + event.target.value)
      },
      onChangeBoxFontColor(event)
      {
          document.documentElement.style.setProperty('--BoxFontColor', event.target.value);
          console.log("Color font Box: " + event.target.value)
      },

      // CHECKBOX
      onChangeCheck(event)
      {
          console.log(event);
      }
  }
}

/*
    DARK - LIGHT::
    --fontSize: 12px;
    --fontColor: #ffffff;
    --BackgroundColor: #15202b;
    --BoxBackground: #94a7b8;
    --BoxFontColor: #000000;

    DARK::
    --fontSize: 12px;
    --BackgroundColor: #1a1a1a;
    --fontColor: #ffffff;
    --BoxFontColor: #ffffff;
    --BoxBackground: #3d3d3d;
*/

</script>
