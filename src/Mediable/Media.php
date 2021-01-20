<?php

namespace ByusTechnology\Mediable;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Media extends Model {

    protected $table = 'mediable';

    protected $fillable = [
        'name', 
        'uri', 
        'url', 
        'storage', 
        'path', 
        'extension', 
        'file', 
        'original_file', 
        'mime', 
        'mediable_id', 
        'mediable_type', 
    ];

    protected static function booted()
    {
        static::deleted(function (Media $media) {
            if ( ! Storage::disk($media->storage)->delete($media->url)) {
                logger('Mediable: File not found at ' . $media->storage . ': ' . $media->path . '(' . $media->url . ')');
            }
        });
    }

    public function source()
    {
        return $this->morphTo();
    }
    
}