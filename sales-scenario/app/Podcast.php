<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{

    public function __construct()
    {
        \Validator::extend('audio', function($attribute, $value, $parameters)
        {
            $allowed = array('audio/mpeg');
            $mime = new \App\Libraries\MimeReader($value->getRealPath());

            // Make sure file type has extension .m4a and not mp4.
            if ($mime->get_type() == 'video/mp4' && preg_match('/^.*\.(m4a)$/', $value->getClientOriginalName())) {
                return true;
            }

            return in_array($mime->get_type(), $allowed);
        });
    }

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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

            if (!empty($extension)) { // Make sure file has extension.
                $finalFileName = $this->attributes['id'].'.'.$extension;

                if (file_exists(self::podcastLocation().$finalFileName)) { // If file exists, delete it first.
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
