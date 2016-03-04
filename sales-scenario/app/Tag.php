<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function experts()
    {
        return $this->belongsToMany('App\Expert')->withTimestamps();
    }
}
