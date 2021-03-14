<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comarca extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'comarques';
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
     * Get all of the comments for the comarques
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function municipis() //: HasMany
    {
        return $this->hasMany(Municipi::class, 'comarques_id');
    }

    /**
     * Get the user that owns the comarques
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provincia() //: BelongsTo
    {
        return $this->belongsTo(Provincia::class, 'provincies_id');
    }

}
