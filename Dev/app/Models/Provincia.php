<?php

namespace App\Models;

use App\Models\Comarca;
use App\Models\Municipi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provincia extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'provincies';
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
     * Get all of the comments for the provincies
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comarques() //: HasMany
    {
        return $this->hasMany(Comarca::class, 'provincies_id');
    }


    /**
     * Get all of the deployments for the project.
     */
    public function municipis()
    {
        return $this->hasManyThrough(
            Comarca::class,
            Municipi::class,
            'id', // municipis.id en JOIN
            'id', // comarques.id as KEY
            'municipis_id', // Local key on the cars table...
            'comarques_id' // Local key on the mechanics table...
        );
    }

}
