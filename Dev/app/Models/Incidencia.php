<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function usuari(): BelongsTo
    {
        return $this->belongsTo(Usuari::class, 'usuaris_id');
    }

     /**
     * Get all of the alumno_has_modulos for the Alumno
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidencies_has_recursos(): HasMany
    {
        return $this->hasMany(IncidenciesHasRecursos::class, 'incidencies_id');
    }
}
