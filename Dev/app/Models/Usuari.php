<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//class Usuari extends Model
//{
class Usuari extends Authenticatable
    {
        use HasFactory, Notifiable;


    // - - - - - - - - - - especifica tabla
    protected $table = 'usuaris';
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
     * Get the user that owns the usuaris
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol() //: BelongsTo
    {
        return $this->belongsTo(Rol::class, 'rols_id');
    }

    /**
     * Get the user that owns the usuaris
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recurso() //: BelongsTo
    {
        return $this->belongsTo(Recurs::class, 'recursos_id');
    }

    /**
     * Get all of the comments for the usuaris
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidencies() //: HasMany
    {
        return $this->hasMany(Incidencia::class, 'usuaris_id');
    }

}
