<?php

namespace App;

use App\Traits\Sluggify;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Sluggify;

    protected $table = 'tags';

    protected $fillable = [
        'name'
    ];

    public function toSlug()
    {
        return $this->name;
    }
}
