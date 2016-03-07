<?php

namespace App;

use App\Traits\Sluggify;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Sluggify;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function experts()
    {
        return $this->belongsToMany('App\Expert')->withTimestamps();
    }
    
    public function toSlug()
    {
        return $this->name;
    }
}
