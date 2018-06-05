<?php

namespace App\Services;

use Storage;
use Image;


class ImageResizing {

  public function imageStore($image) {

    $imageName = $image->store('','images');
    $image->store('','thumbnails');
    // create instance
    $thumbnail = Image::make(Storage::disk('thumbnails')->path($imageName))->resize(200, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });           
  
    //$path = Storage::disk('thumbnails')->getAdapter()->getPathPrefix();
  
    $thumbnail->save();

    return $imageName;
  }

  public function imageDelete($imageName) {
    storage::disk('images')->delete($imageName);
    storage::disk('thumbnails')->delete($imageName);
  }
};
