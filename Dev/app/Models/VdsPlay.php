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
    public function formelement() //: BelongsTo
    {
        return $this->belongsTo(CodiValoracio::class, 'id_formelement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function videos() //: BelongsTo
    {
        return $this->belongsTo(VdsVideos::class, 'id_video');
    }

}
