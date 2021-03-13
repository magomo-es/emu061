<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class afectats extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'afectats';
    // - - - - - - - - - - clave primaria, por defecto asume que es id
    // protected $primaryKey = 'xxx';
    // - - - - - - - - - - incremento de clave, por defecto asume autoincrement
    // public $incrementing = false;
    // - - - - - - - - - - tipo de clave, por defecto asume entero
    // protected $keyType = 'string';
    // - - - - - - - - - - por defecto asume que existen created_at y updated_at para registrar timestamp
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'updated_date';
    public $timestamps = false;

    /**
     * Get the user that owns the afectats
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sexe() //: BelongsTo
    {
        return $this->belongsTo(sexes::class, 'sexes_id');
    }

    /**
     * The roles that belong to the afectats
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function incidencies() //: BelongsToMany
    {
        return $this->incidencies(Role::class, 'incidencies_has_afectats', 'afectats_id', 'incidencies_id');
    }

}
