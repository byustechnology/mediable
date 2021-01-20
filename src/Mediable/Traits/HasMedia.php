<?php

namespace ByusTechnology\Mediable\Traits;

use Illuminate\Database\Eloquent\Model;
use ByusTechnology\Mediable\Media;
use ByusTechnology\Mediable\Mediable;

trait HasMedia {

    public static function bootHasMedia()
    {        
        static::deleting(function(Model $model) {
            $model->medias->each(function($media) {
                $media->delete();
            });
        });
    }

    /**
     * A Model instance can 
     * contain multiple medias
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function media()
    {
        return new Mediable($this);
    }

    public function getMedia($name)
    {
        return $this->medias()->where('name', $name)->first();
    }

    public function getMediaColumn($column, $name = 'default')
    {
        return optional($this->getMedia($name))->$column;
    }

}