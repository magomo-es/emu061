<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class municipis extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'municipis';
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
     * Get the user that owns the municipis
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comarca() //: BelongsTo
    {
        return $this->belongsTo(comarques::class, 'comarques_id');
    }

    /**
     * Get all of the comments for the municipis
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alertants() //: HasMany
    {
        return $this->hasMany(alertants::class, 'municipis_id');
    }

    /**
     * Get all of the comments for the municipis
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidencies() //: HasMany
    {
        return $this->hasMany(incidencies::class, 'municipis_id');
    }


}
