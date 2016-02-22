<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    protected $table = 'experts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'website', 'info'
    ];

    /**
     * Get podcasts associated with given expert
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function podcasts()
    {
        return $this->hasMany('App\Podcast');
    }

    /**
     * Get the tags with the given expert.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

}
