<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CodisValoracio extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'codi_valoracio';
    // - - - - - - - - - - clave primaria, por defecto asume que es id
    protected $primaryKey = 'codi';
    // - - - - - - - - - - incremento de clave, por defecto asume autoincrement
    public $incrementing = false;
    // - - - - - - - - - - tipo de clave, por defecto asume entero
    protected $keyType = 'string';
    // - - - - - - - - - - por defecto asume que existen created_at y updated_at para registrar timestamp
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'updated_date';
    public $timestamps = false;

    /**
     * Get all of the comments for the provincies
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function afectats() //: HasMany
    {
        return $this->hasMany(Afectat::class, 'codi_valoracio');
    }

    /**
    * Get all of the comments for the provincies
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function valoracioangles() //: HasOne
    {
        return $this->hasOne(HlpValoracio::class, 'codi', 'codi_valoracio');
    }


    /**
     * Get all of the comments for the provincies
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function video() //: HasMany
    {
        return $this->hasOneThrough(VdsVideos::class, VdsPlay::class);
/*        return $this->hasOneThrough(
            VdsVideos::class,
            VdsPlay::class,
            'id_caller', // Foreign key on the cars table...
            'id_video', // Foreign key on the owners table...
                    char(7) NOT NULL,
                     int(10) unsigned NOT NULL,

            'id', // Local key on the mechanics table...
            'id' // Local key on the cars table...
        );

        return $this->hasOneThrough(
            Owner::class,
            Car::class,
            'mechanic_id', // Foreign key on the cars table...
            'car_id', // Foreign key on the owners table...
            'id', // Local key on the mechanics table...
            'id' // Local key on the cars table...
        );
*/

    }

}
