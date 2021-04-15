<template>
    <div class="form-group">
        <label for="desc">Llista d'afectats:</label>

        <div class="tableFixHead">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Noms</th>
                        <th scope="col">Cognoms</th>
                        <th scope="col">CIP</th>
                        <th scope="col" class="text-right">
                            <div role="group" class="btn-group ml-1">
                                <button type="button" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Nou Afectat
                                </button>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>Rodolfo</td>
                        <td>Gallardo</td>
                        <td>0000000000</td>
                        <td class="text-right">
                            <div role="group" class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                            </div>

                            <div role="group" class="btn-group ml-1">
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Esborrar
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Marcelo</td>
                        <td>Goncevatt</td>
                        <td>0000000000</td>
                        <td class="text-right">
                            <div role="group" class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                            </div>

                            <div role="group" class="btn-group ml-1">
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Esborrar
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Mario</td>
                        <td>de la Torre</td>
                        <td>0000000000</td>
                        <td class="text-right">
                            <div role="group" class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                            </div>

                            <div role="group" class="btn-group ml-1">
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Esborrar
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Mario</td>
                        <td>de la Torre</td>
                        <td>0000000000</td>
                        <td class="text-right">
                            <div role="group" class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                            </div>

                            <div role="group" class="btn-group ml-1">
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Esborrar
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Mario</td>
                        <td>de la Torre</td>
                        <td>0000000000</td>
                        <td class="text-right">
                            <div role="group" class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                            </div>

                            <div role="group" class="btn-group ml-1">
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Esborrar
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Mario</td>
                        <td>de la Torre</td>
                        <td>0000000000</td>
                        <td class="text-right">
                            <div role="group" class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                            </div>

                            <div role="group" class="btn-group ml-1">
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Esborrar
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>

    </div>
</template>

<style>

.tableFixHead          { overflow: auto; height: 200px; box-shadow: 0px 1px 0.1px grey;}
.tableFixHead thead th { position: sticky; top: -1px; z-index: 1; }

/* Just common table stuff. Really. */
table  { border-collapse: collapse; width: 100%; }
th, td { padding: 8px 16px; }
th     { background:#eee; }

.table th, td
{
    font-size: 85%;
    vertical-align: middle !important;
}


</style>

<script>
export default {
  data: function() {
        return {}
  },
};
</script>
