<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\TipusRecursResource;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Afectat extends Model
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
    public function sexe(): BelongsTo
    {
        return $this->belongsTo(Sexe::class, 'sexes_id');
    }

    /**
     * Get the user that owns the Afectat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipus_recurs(): BelongsTo
    {
        return $this->belongsTo(TipusRecurs::class, 'tipus_recursos_id');
    }

    /**
     * Get the user that owns the Afectat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gravetat(): BelongsTo
    {
        return $this->belongsTo(CodisGravetat::class, 'codi_gravetat');
    }

    /**
     * Get the user that owns the Afectat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function valoracio(): BelongsTo
    {
        return $this->belongsTo(CodisValoracio::class, 'codi_valoracio');
    }

     /**
     * Get all of the alumno_has_modulos for the Alumno
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidencies_has_recursos(): HasMany
    {
        return $this->hasMany(IncidenciesHasRecursos::class, 'afectats_id');
    }

}
