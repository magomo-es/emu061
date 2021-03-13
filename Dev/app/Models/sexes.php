<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sexes extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'sexes';
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
     * Get all of the comments f //or the sexes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function afectats() //: HasMany
    {
        return $this->hasMany(afectats::class, 'sexes_id');
    }

}
