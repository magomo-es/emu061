<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VdsPlay extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'vds_playvideosbycaller';

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function valoracio() //: BelongsTo
    {
        return $this->belongsTo(CodisValoracio::class, 'id_caller');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function video() //: BelongsTo
    {
        return $this->belongsTo(VdsVideos::class, 'id_video');
    }

}
