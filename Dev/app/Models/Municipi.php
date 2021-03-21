<?php

namespace App\Models;

use App\Models\Comarca;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipi extends Model
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
        return $this->belongsTo(Comarca::class, 'comarques_id');
    }

    /**
     * Get all of the comments for the municipis
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alertants() //: HasMany
    {
        return $this->hasMany(Alertant::class, 'municipis_id');
    }

    /**
     * Get all of the comments for the municipis
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidencies() //: HasMany
    {
        return $this->hasMany(Incidencia::class, 'municipis_id');
    }


    /**
     * Get the Municipis
     */
    public function provincia()
    {
        return $this->hasOneThrough(
            Provincia::class,
            Comarca::class,
            'id', // comarques.id as KEY
            'id', // provincies.id en JOIN
            'comarques_id', // Local key on the mechanics table...
            'provincies_id' // Local key on the cars table...
        );

    }


}
