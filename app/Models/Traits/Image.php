<?php

namespace App\Models\Traits;

use SplFileInfo;

trait Image
{
    protected function storeImage($key, $value)
    {
        $request = app('request');

        // check we has file or not?
        // we must check value is SplFileInfo too.
        // we allow if programmer want to set string to it too.
        if (is_object($value) && $value instanceof SplFileInfo && $request->hasFile($key))
        {
            // we has file so go on ....

            // we check model is new or old
            if (! $this->exists)
            {
                // oh no! this is new model so we must create it first.
                // at this point I will set 'waiting' so we can tell later
                // that logic come across this point.
                $this->attributes[$key] = 'waiting';

                // add event created will move file to target
                parent::created(function($model) use ($key) {
                    $model->{$key} = $model->saveImage($key);
                    $model->save();
                });
            }
            else
            {
                // this is old model so web got all that we want!
                $this->attributes[$key] = $this->saveImage($key);
            }
            return;
        }

        // if logic go to found this line, maybe programmer want to set it as normal string.
        $this->attributes[$key] = $value;
    }

    public function saveImage($key)
    {
        $request = app('request');
        if ($request->hasFile($key))
        {
            $image = $request->file($key);
            $imagePath = trim($this->imagePath, '/');
            $imageName = sprintf("%03d", $this->getKey()). '-'. $key . '.' . $image->getClientOriginalExtension();
            $image->move(
                base_path() . '/public/'.$imagePath.'/', $imageName
            );
            return $imagePath.'/'.$imageName;
        }
        return false;
    }
}