<?php

namespace App;

use App\Traits\Sluggify;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use Sluggify;
    
    public static function podcastLocation()
    {
        return public_path().'/audio/podcasts/';
    }

    protected $table = 'podcasts';

    protected $fillable = [
        'title', 'filename', 'expert_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expert()
    {
        return $this->belongsTo('App\Expert');
    }
    
    public function toSlug()
    {
        return $this->title;
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
}
