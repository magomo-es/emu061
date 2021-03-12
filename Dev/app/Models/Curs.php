<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curs extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'cursos';
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
     * Get the user that owns   // the Cursos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cicle()  //: BelongsTo
    {
        return $this->belongsTo(Cicle::class, 'cicles_id');
    }

    /**
     * The moduls that belon    //g to the Cursos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function moduls()    //: BelongsToMany
    {
        return $this->belongsToMany(Modul::class, 'moduls_has_cursos', 'cursos_id', 'moduls_id')->withPivot('curs_academic_id');;
    }

}
