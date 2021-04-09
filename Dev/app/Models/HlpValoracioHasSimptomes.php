<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HlpValoracioHasSimptomes extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'hlp_valoracio_has_simptomes';
    // - - - - - - - - - - clave primaria, por defecto asume que es id
    protected $primaryKey = ['id_valoracio', 'id_simptoma'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function incidencia() //: BelongsTo
    {
        return $this->belongsTo(HlpValoracio::class, 'id_valoracio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function afectat() //: HasMany
    {
        return $this->belongsTo(HlpSimptoma::class, 'id_simptoma');
    }

}



