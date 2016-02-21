<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    public function setPasswordAttribute($value)
    {
        if(!is_null($value) && !empty($value)){
            $this->attributes['password'] = bcrypt($value);
        }elseif(isset($this->attributes['password'])){
            unset($this->attributes['password']);
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * User belongs to one expert
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    /*public function experts()
    {
        return $this->hasOne('App\Expert');
    }*/
}
