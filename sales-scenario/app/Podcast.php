<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    public static function podcastLocation()
    {
        return storage_path().'/app/podcasts/';

    }



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

        if (isset($this->attributes['filename']) && is_null($this->attributes['filename']) ||
            empty($this->attributes['filename'])) {

            return false;
        }
        // before save code
        parent::save($options);
        // after save code
        $tempLocation = self::podcastLocation().'temp/';
        $tempFileName = $this->attributes['filename'];

        if (file_exists($tempLocation.$tempFileName)) {
            $extension = pathinfo($tempLocation.$tempFileName, PATHINFO_EXTENSION);

            if (!empty($extension)) {
                $finalFileName = $this->attributes['id'].'.'.$extension;
                if (file_exists(self::podcastLocation().$finalFileName)) {
                    unlink(self::podcastLocation().$finalFileName);
                }
                rename($tempLocation.$tempFileName, self::podcastLocation().$finalFileName);
                $this->attributes['filename'] = $finalFileName;
                parent::save();
            }
        }

    }
    
    public function delete()
    {

        // before delete
        if (!empty($this->attributes['filename']) && file_exists(self::podcastLocation().$this->attributes['filename'])) {
            unlink(self::podcastLocation().$this->attributes['filename']);
        }

        parent::delete();


    }

}
