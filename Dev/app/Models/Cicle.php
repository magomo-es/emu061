<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cicle extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'cicles';
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
     * Get all of the cursos for the Cicles
     *
     * @return \IlCurse\Database\Eloquent\Relations\HasMany
     */
    public function cursos() //: HasMany
    {
        return $this->hasMany(Curs::class, 'cicles_id');
    }
}
