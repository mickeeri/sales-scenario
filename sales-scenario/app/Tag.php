<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /*public static function tagLocation()
    {
        return public_path().'/audio/s/';
    }*/

    protected $table = 'tags';

    protected $fillable = [
        'name'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    /*public function tags()
    {
        return $this->belongsToMany('App\Expert')->withTimestamps();
    }*/
}
