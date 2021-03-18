<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'incidencies';
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
     * Get the user that owns the incidencies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipus_incidencia() //: BelongsTo
    {
        return $this->belongsTo(TipusIncidencia::class, 'tipus_incidencies_id');
    }

    /**
     * Get the user t //hat owns the incidencies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alertant() //: BelongsTo
    {
        return $this->belongsTo(Alertant::class, 'alertants_id');
    }

    /**
     * Get the user that owns the incidencies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function municipi() //: BelongsTo
    {
        return $this->belongsTo(Municipi::class, 'municipis_id');
    }

    /**
     * Get the user that owns the incidencies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuari() //: BelongsTo
    {
        return $this->belongsTo(Usuari::class, 'usuaris_id');
    }

    /**
     * The roles that belong to the incidencies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function afectats() //: BelongsToMany
    {
        return $this->belongsToMany(Afectat::class, 'incidencies_has_afectats', 'afectats_id', 'incidencies_id');
    }

    /**
     * The roles that belong to the incidencies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recursos() //: BelongsToMany
    {
        return $this->belongsToMany(Recurs::class, 'incidencies_has_recursos', 'recursos_id', 'incidencies_id');
    }
}