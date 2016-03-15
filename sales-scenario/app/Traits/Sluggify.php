<?php

namespace App\Traits;


trait Sluggify
{

    protected static $delimiter = "-";
    public static $saveTo = 'slug';

    public static function bootSluggify()
    {
        // Generate slug on create.
        static::saving(function($model) {

            if ($model->isDirty()) {
                $model->{static::$saveTo} = $model->generateSlug();
            }
        });
    }
    
    public function generateSlug()
    {
        $slug = str_slug($this->toSlug(), self::$delimiter);

        $index = 1;

        while(true){
            $query = static::where(static::$saveTo, '=', $slug);

            if($this->exists){
                $query->where('id', '!=', $this->id);
            }

            if($this->usesSoftDeleting()){
                $query->withTrashed();
            }

            if($query->get()->isEmpty()){
                break;
            }

            $slug = str_slug($this->toSlug(), self::$delimiter) . self::$delimiter . $index++;
        }

        return $slug;
    }
    
    public function toSlug()
    {
        return $this->name;
    }

    /**
     * Query scope for finding a model by its slug.
     *
     * @param $scope
     * @param $slug
     * @return mixed
     */
    public function scopeWhereSlug($scope, $slug)
    {
        return $scope->where(static::$saveTo, $slug);
    }

    /**
     * Find a model by slug.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public static function findBySlug($slug)
    {
        return self::whereSlug($slug)->first();
    }

    /**
     * Find a model by slug or fail.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function findBySlugOrFail($slug)
    {
        return self::whereSlug($slug)->firstOrFail();
    }

    /**
     * Simple find by Id if it's numeric or slug if not. Fail if not found.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public static function findBySlugOrIdOrFail($slug)
    {
        if (!$result = static::findBySlug($slug)) {
            return static::findOrFail((int)$slug);
        }
        return $result;
    }
    /**
     * Simple find by Id if it's numeric or slug if not.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null
     */
    public static function findBySlugOrId($slug)
    {
        if (!$result = static::findBySlug($slug)) {
            return static::find($slug);
        }
        return $result;
    }

    /**
     * Does this model use softDeleting?
     *
     * @return bool
     */
    protected function usesSoftDeleting()
    {
        return method_exists($this, 'BootSoftDeletes');
    }
    
}