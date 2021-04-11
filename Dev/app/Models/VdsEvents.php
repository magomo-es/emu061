<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VdsEvents extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'vds_videoevents';

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function video() //: BelongsTo
    {
        return $this->belongsTo(VdsVideos::class, 'id_video');
    }


}
