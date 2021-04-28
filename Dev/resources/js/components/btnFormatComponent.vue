<template>

    <main>


        <button style="position: absolute; top: 0;right: 10px;z-index: 99;" type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#FormatModal"><i class="fas fa-cog"></i></button>

        <!-- Modal Ajustes Colores y Formato -->
        <div class="modal fade" id="FormatModal" tabindex="-1" role="dialog" aria-labelledby="FormatModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Opcions de format</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tancar control de format de pantalla">
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
                                    <select class="col-8" name="font" id="font" v-model="fontSelected" @change="onChangeSelect($event)" aria-label="Tamany de font">
                                        <option v-for="font in fonts" v-bind:key="font" v-bind:value="font">{{ font }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row px-1">
                                    <label class="col-4 col-form-label" style="font-size: 80%; font-weight: 400;">Color:</label>
                                    <input class="col-7 col-form-input" id="fontColor" style="height: 37px; padding: 0px;" type="color" v-bind:value="fontColor" @change="onChangeColorFont($event)" aria-label="Color de font">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <div class="col-6">
                                <div class="row px-1">
                                    <label for="afectat_cip" class="col-12 col-form-label" style="font-size: 80%; font-weight: 400;">Fons de pantalla:</label>

                                    <label class="col-4 col-form-label" style="font-size: 80%; font-weight: 400;">Color:</label>
                                    <input class="col-8 col-form-input" id="BackgroundColor" style="height: 37px; padding: 0px;" type="color" v-bind:value="screenColor" @change="onChangeBackgroundColor($event)" aria-label="Color de fons de pantalla">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row px-1">
                                    <label for="afectat_cip" class="col-12 col-form-label" style="font-size: 80%; font-weight: 400;">Caixes:</label>

                                    <label class="col-4 col-form-label" style="font-size: 80%; font-weight: 400;">Fons:</label>
                                    <input class="col-7 col-form-input" id="BoxBackground" style="height: 37px; padding: 0px;" type="color" v-bind:value="inputBackgroundColor" @change="onChangeBoxBackground($event)" aria-label="Color de les caixes de dades">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <div class="row px-1">
                                    <label class="col-4 col-form-label" style="font-size: 80%; font-weight: 400;">Color:</label>
                                    <input class="col-7 col-form-input" id="BoxFontColor" style="height: 37px; padding: 0px;" type="color" v-bind:value="inputColor" @change="onChangeBoxFontColor($event)" aria-label="Color de la font de les dades de les caixes">
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
                            <div class="col-12">
                                <div class="row" style="display: flex; justify-content: center; align-items: center;">
                                    <div class="col-4" style="display: flex; justify-content: center; align-items: center;">
                                        <input type="radio" name="theme" id="dark-rb" @change="onChangeCheck($event)" value="dark" aria-label="Aspecte Dark">
                                        <label for="dark" name="theme" class="col-form-label" style="margin-left:10px">Dark</label>
                                    </div>

                                    <div class="col-4" style="display: flex; justify-content: center; align-items: center;">
                                        <input type="radio" name="theme" id="dark-light-rb" @change="onChangeCheck($event)" value="dark-light" aria-label="Aspecte Dark Light">
                                        <label for="dark-light" name="theme" class="col-form-label" style="margin-left:10px">Dark Light</label>
                                    </div>

                                    <div class="col-4" style="display: flex; justify-content: center; align-items: center;">
                                        <input type="radio" name="theme" id="light-rb" @change="onChangeCheck($event)" value="light"  aria-label="Aspecte Light">
                                        <label for="light" class="col-form-label" style="margin-left:10px">Light</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <div class="col-12" style="display: flex; justify-content: center; align-items: center;">
                                <select class="col-8" name="dalt" id="dalt" @change="onChangeSelectDaltonics($event)" title="Selecciona el tipus" disabled aria-label="Tipus de daltonisme">
                                    <option v-for="dalt in daltonics" v-bind:key="dalt" v-bind:value="dalt">{{ dalt }}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Tancar control de format de pantalla">Cancel·lar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="saveChanges()" aria-label="Acceptar i Tancar control de format de pantalla">Acceptar</button>
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

.valoracio-box
{
    background-color: var(--BackgroundColor) !important;
    border: 1px solid #fff !important;
    color: var(--fontColor) !important;
}

.modal-style
{
    background-color: var(--BackgroundColor) !important;
    border: 1px solid #fff !important;
    color: var(--fontColor) !important;
}

.table-style
{
    background-color: var(--BoxBackground) !important;
    color: var(--fontColor) !important;
}

.table-head-style
{
    background-color: var(--BackgroundColor) !important;
    color: var(--fontColor) !important;
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
        inputColor: '#495057',

        daltonicSelected: false,
        daltonics: ['Deuteranopia', 'Protanopia', 'Tritanopia'],
        radioSelected: null
    }
  },
  methods: {
      onChangeSelect(event)
      {
          document.documentElement.style.setProperty('--fontSize', event.target.value+'px');
          $('#dark-rb').prop("checked", false);
          $('#dark-light-rb').prop("checked", false);
          $('#light-rb').prop("checked", false);

          $('#dalt').attr('disabled','disabled');
      },
      onChangeColorFont(event)
      {
          document.documentElement.style.setProperty('--fontColor', event.target.value);
          $('#dark-rb').prop("checked", false);
          $('#dark-light-rb').prop("checked", false);
          $('#light-rb').prop("checked", false);

          $('#dalt').attr('disabled','disabled');
      },
      onChangeBackgroundColor(event)
      {
          document.documentElement.style.setProperty('--BackgroundColor', event.target.value);
          $('#dark-rb').prop("checked", false);
          $('#dark-light-rb').prop("checked", false);
          $('#light-rb').prop("checked", false);

          $('#dalt').attr('disabled','disabled');
      },
      onChangeBoxBackground(event)
      {
          document.documentElement.style.setProperty('--BoxBackground', event.target.value);
          $('#dark-rb').prop("checked", false);
          $('#dark-light-rb').prop("checked", false);
          $('#light-rb').prop("checked", false);

          $('#dalt').attr('disabled','disabled');
      },
      onChangeBoxFontColor(event)
      {
          document.documentElement.style.setProperty('--BoxFontColor', event.target.value);
          $('#dark-rb').prop("checked", false);
          $('#dark-light-rb').prop("checked", false);
          $('#light-rb').prop("checked", false);

          $('#dalt').attr('disabled','disabled');
      },

      // CHECKBOX'S
      onChangeCheck(event)
      {
          var optionText = event.target.value;
          this.radioSelected = event.target.value;

          // -- DARK
          if (optionText == "dark")
          {
              document.documentElement.style.setProperty('--fontSize', '12px');
              document.documentElement.style.setProperty('--fontColor', '#ffffff');
              document.documentElement.style.setProperty('--BackgroundColor', '#1a1a1a');
              document.documentElement.style.setProperty('--BoxBackground', '#3d3d3d');
              document.documentElement.style.setProperty('--BoxFontColor', '#ffffff');

              $('#fontSize').val('12px');
              $('#fontColor').val('#ffffff');
              $('#BackgroundColor').val('#1a1a1a');
              $('#BoxBackground').val('#3d3d3d');
              $('#BoxFontColor').val('#ffffff');

               $('#dalt').attr('disabled','disabled');
              //$('#dalt').removeAttr("disabled");
          }
          else if (optionText == "dark-light")
          {
              document.documentElement.style.setProperty('--fontSize', '12px');
              document.documentElement.style.setProperty('--fontColor', '#ffffff');
              document.documentElement.style.setProperty('--BackgroundColor', '#15202b');
              document.documentElement.style.setProperty('--BoxBackground', '#94a7b8');
              document.documentElement.style.setProperty('--BoxFontColor', '#000000');

              $('#fontSize').val('12px');
              $('#fontColor').val('#ffffff');
              $('#BackgroundColor').val('#15202b');
              $('#BoxBackground').val('#94a7b8');
              $('#BoxFontColor').val('#000000');

              $('#dalt').removeAttr("disabled");

              // Deuteranopia: #94a7b8 -->  #9ca3b8
              // Protanopia: #94a7b8 -->  #a0a7b9
              // Tritanopia: #94a7b8 -->  #8babac
          }
          else if (optionText == "light")
          {
              document.documentElement.style.setProperty('--fontSize', '12px');
              document.documentElement.style.setProperty('--fontColor', '#212529');
              document.documentElement.style.setProperty('--BackgroundColor', '#f8fafc');
              document.documentElement.style.setProperty('--BoxBackground', '#ffffff');
              document.documentElement.style.setProperty('--BoxFontColor', '#495057');

              $('#fontSize').val('12px');
              $('#fontColor').val('#212529');
              $('#BackgroundColor').val('#f8fafc');
              $('#BoxBackground').val('#ffffff');
              $('#BoxFontColor').val('#495057');

              $('#dalt').removeAttr("disabled");

              // Deuteranopia: #495057 -->  #4c4e57
              // Protanopia: #495057 -->  #4d5057
              // Tritanopia: #495057 -->  #465252
          }
      },

      onChangeSelectDaltonics(event)
      {
          var optionText = event.target.value;

          if (optionText == "Deuteranopia")
          {
              if (this.radioSelected == "dark-light")
              {
                  document.documentElement.style.setProperty('--BoxBackground', '#9ca3b8');
                  $('#BoxBackground').val('#9ca3b8');
              }
              else if (this.radioSelected == "light")
              {
                  document.documentElement.style.setProperty('--BoxFontColor', '#4c4e57');
                  $('#BoxFontColor').val('#4c4e57');
              }
          }
          else if (optionText == "Protanopia")
          {
              if (this.radioSelected == "dark-light")
              {
                  document.documentElement.style.setProperty('--BoxBackground', '#a0a7b9');
                  $('#BoxBackground').val('#a0a7b9');
              }
              else if (this.radioSelected == "light")
              {
                  document.documentElement.style.setProperty('--BoxFontColor', '#4d5057');
                  $('#BoxFontColor').val('#4d5057');
              }
          }
          else if (optionText == "Tritanopia")
          {
              if (this.radioSelected == "dark-light")
              {
                  document.documentElement.style.setProperty('--BoxBackground', '#8babac');
                  $('#BoxBackground').val('#8babac');
              }
              else if (this.radioSelected == "light")
              {
                  document.documentElement.style.setProperty('--BoxFontColor', '#465252');
                  $('#BoxFontColor').val('#465252');
              }
          }
      }

      // -- DARK-LIGHT
      // -- LIGHT
      // -- DALTONIC
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

    LIGHT::
    --fontSize: 12px;
    --fontColor: #212529;
    --BackgroundColor: #f8fafc;
    --BoxBackground: #ffffff;
    --BoxFontColor: #495057;
*/

</script>
