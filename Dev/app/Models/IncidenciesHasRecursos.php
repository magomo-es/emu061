<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidenciesHasRecursos extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'incidencies_has_recursos';
    // - - - - - - - - - - clave primaria, por defecto asume que es id
    protected $primaryKey = ['incidencies_id', 'recursos_id', 'afectats_id'];
    // - - - - - - - - - - incremento de clave, por defecto asume autoincrement
    public $incrementing = false;
    // - - - - - - - - - - tipo de clave, por defecto asume entero
    // protected $keyType = 'string';
    // - - - - - - - - - - por defecto asume que existen created_at y updated_at para registrar timestamp
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'updated_date';
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function incidencia() //: BelongsTo
    {
        return $this->belongsTo(Incidencia::class, 'incidencies_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function afectat() //: HasMany
    {
        return $this->belongsTo(Afectat::class, 'afectats_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function recurs() //: HasMany
    {
        return $this->belongsTo(Recurs::class, 'recursos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function desti() //: HasMany
    {
        return $this->belongsTo(Alertant::class, 'desti_alertant_id');
    }


    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

}



