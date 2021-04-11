<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HlpValoracio extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'hlp_valoracio';
    // - - - - - - - - - - clave primaria, por defecto asume que es id
    protected $primaryKey = 'codi_valoracio';
    // - - - - - - - - - - incremento de clave, por defecto asume autoincrement
    public $incrementing = false;
    // - - - - - - - - - - tipo de clave, por defecto asume entero
    protected $keyType = 'string';
    // - - - - - - - - - - por defecto asume que existen created_at y updated_at para registrar timestamp
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'updated_date';
    public $timestamps = false;

    /**
    * Get all of the comments for the provincies
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function valoracio() //: HasOne
    {
        return $this->belongsTo(CodisValoracio::class, 'codi_valoracio', 'codi');
    }

    /**
     * The roles that belong to the incidencies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function simptomes() //: BelongsToMany
    {
        return $this->belongsToMany(HlpSimptomes::class, 'hlp_valoracio_has_simptomes', 'id_simptoma', 'codi_valoracio');
    }

}
