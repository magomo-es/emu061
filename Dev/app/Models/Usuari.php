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
     */
    public function rol()
    {
        return $this->hasOne(Rol::class, 'id', 'rols_id');
    }

    /**
     */
    public function recurso()
    {
        return $this->hasOne(Recurs::class, 'id', 'recursos_id');
    }

    /**
     */
    public function incidencies()
    {
        return $this->hasMany(Incidencia::class, 'id', 'usuaris_id');
    }

}
