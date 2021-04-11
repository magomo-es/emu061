<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CodisSEM3 extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'codi_sem3';
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

}
