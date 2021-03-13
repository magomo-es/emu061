<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipus_alertants extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'tipus_alertants';
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
     * Get all of the comments for the tipus_alertants
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alertants() //: HasMany
    {
        return $this->hasMany(alertants::class, 'tipus_alertants_id');
    }

}
