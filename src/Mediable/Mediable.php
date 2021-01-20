<?php

namespace ByusTechnology\Mediable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Mediable {

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function find($name = 'default')
    {
        return $this->model->medias()->where('name', $name)->first();
    }

    public function createOrUpdate($uploadedFile, $path = '/', $name = 'default', $storage = 'public')
    {
        $exists = $this->find($name);

        if ( ! empty($exists)) {
            $exists->delete();
        }

        $this->create($uploadedFile, $path, $name, $storage);
    }
    
    public function create($uploadedFile, $path = '/', $name = 'default', $storage = 'public')
    {
        $filename = Str::orderedUuid() . '.' . $uploadedFile->extension();
        $filePath = str_replace('//', '/', $path . '/' . $filename);

        $uploadedFile->storeAs($path, $filename, $storage);

        $media = new Media([
            'name' => $name, 
            'uri' => url('/storage') . '/' . $filePath, 
            'url' => $filePath, 
            'storage' => $storage,  
            'path' => storage_path() . '/app/public/' . $filePath, 
            'extension' => $uploadedFile->extension(), 
            'file' =>  $filename, 
            'original_file' => $uploadedFile->getClientOriginalName(), 
            'mime' => $uploadedFile->getClientMimeType(), 
            'mediable_id' => $this->model->id, 
            'mediable_type' => get_class($this->model), 
        ]);
        $media->save();
    }

}