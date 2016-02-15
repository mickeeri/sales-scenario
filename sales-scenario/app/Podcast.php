<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    protected $table = 'podcasts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'filename',
    ];

    public function expert()
    {
        return $this->belongsTo('App\Expert');
    }

    public function save(array $options = array())
    {
        // before save code
        parent::save($options);
        // after save code
        $finalLocation = storage_path().'/app/podcasts/';
        $tempLocation = $finalLocation.'temp/';
        $tempFileName = $this->attributes['filename'];

        if (file_exists($tempLocation.$tempFileName)) {
            $finalFileName = $this->attributes['id'].'.'.pathinfo($tempLocation.$tempFileName, PATHINFO_EXTENSION);
            rename($tempLocation.$tempFileName, $finalLocation.$finalFileName);
            $this->attributes['filename'] = $finalFileName;
            parent::save();
        }

    }

}
