<?php

namespace App;

use App\Traits\Sluggify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expert extends Model
{
    use SoftDeletes;
    use Sluggify;

    protected $table = 'experts';

    protected $fillable = [
        'first_name', 'last_name', 'website', 'info'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function podcasts()
    {
        return $this->hasMany('App\Podcast');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function toSlug()
    {
        return $this->full_name;
    }

    /**
     * Cascade for experts podcasts
     */
    public static function boot()
    {
        parent::boot();

        static::deleted(function($expert)
        {
            $expert->podcasts()->delete();

        });
    }
}
