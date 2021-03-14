<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurs extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'recursos';
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
     * Get the user that owns the recursos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipus_recurso() //: BelongsTo
    {
        return $this->belongsTo(TipusRecurs::class, 'tipus_recursos_id');
    }

    /**
     * Get all of the comments for the recursos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuaris() //: HasMany
    {
        return $this->hasMany(Usuari::class, 'recursos_id');
    }

    /**
     * The roles that belong to the recursos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function incidencies() //: BelongsToMany
    {
        return $this->belongsToMany(Incidencia::class, 'incidencies_has_recursos', 'recursos_id', 'incidencies_id');
    }

}
