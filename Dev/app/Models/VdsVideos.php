<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VdsVideos extends Model
{
    // - - - - - - - - - - especifica tabla
    protected $table = 'vds_videos';

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function valoracions() //: HasMany
    {
        return $this->hasMany(VdsPlay::class, 'id_video');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videoevents() //: HasMany
    {
        return $this->hasMany(VdsEvents::class, 'id_video');
    }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function valoracions() //: BelongsToMany
    {
        return $this->belongsToMany(CodisValoracio::class, 'vds_playvideosbycaller', 'id_caller', 'id_video');
    }

}
