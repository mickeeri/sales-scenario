<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    public function setPasswordAttribute($value)
    {
        if(!is_null($value) && !empty($value)){
            $this->attributes['password'] = bcrypt($value);
        }elseif(isset($this->attributes['password'])){
            unset($this->attributes['password']);
        }
    }

    protected $fillable = [
        'username', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function podcasts()
    {
        return $this->belongsToMany('App\Podcast', 'podcast_user')->withTimestamps();
    }
}
