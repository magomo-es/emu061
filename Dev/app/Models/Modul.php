<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{


    /**
     * The moduls that belon    //g to the Cursos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cursos()    //: BelongsToMany
    {
        return $this->belongsToMany(Curs::class, 'moduls_has_cursos', 'moduls_id', 'cursos_id')->withPivot('curs_academic_id');
    }

}
