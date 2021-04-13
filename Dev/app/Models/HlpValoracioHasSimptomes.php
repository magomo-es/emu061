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
    // - - - - - - - - - - incremento de clave, por defecto asume autoincrement
    public $incrementing = false;

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function valoracio() //: BelongsTo
    {
        return $this->belongsTo(HlpValoracio::class, 'id_valoracio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function simptomes() //: HasMany
    {
        return $this->belongsTo(HlpSimptomes::class, 'id_simptoma');
    }

}



