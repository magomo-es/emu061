<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HlpValoracio extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'hlp_valoracio';

    public $timestamps = false;

    /**
     * The roles that belong to the incidencies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hlp_simptomes() //: BelongsToMany
    {
        return $this->belongsToMany(HlpSimptoma::class, 'hlp_valoracio_has_simptomes', 'id_simptoma', 'id_valoracio');
    }

}
