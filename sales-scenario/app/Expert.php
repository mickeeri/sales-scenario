<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expert extends Model
{
    use SoftDeletes;

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
     * The attributes that should be mutated to dates
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
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
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }
}
