<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alertant extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'alertants';
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
     * Get the user t //hat owns the alertants
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipus_alertant(): BelongsTo
    {
        return $this->belongsTo(TipusAlertant::class, 'tipus_alertants_id');
    }

    /**
     * Get the user that owns the alertants
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function municipi(): BelongsTo
    {
        return $this->belongsTo(Municipi::class, 'municipis_id');
    }

    /**
     * Get all of the comments for the alertants
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidencies(): HasMany
    {
        return $this->hasMany(Incidencia::class, 'alertants_id');
    }


}
