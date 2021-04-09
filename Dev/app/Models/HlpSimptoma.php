<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HlpSimptoma extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'hlp_simptomes';

    public $timestamps = false;

    /**
     * The roles that belong to the incidencies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hlp_valoracions() //: BelongsToMany
    {
        return $this->belongsToMany(HlpValoracio::class, 'hlp_valoracio_has_simptomes', 'id_valoracio', 'id_simptoma');
    }

}
