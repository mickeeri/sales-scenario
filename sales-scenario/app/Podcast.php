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
}
