<?php
namespace App\Service;
class FileUploadService{

    public function saveImage($image){
        $path = '';
        // dd($image);
        if(isset($image) === true){
            $path = $image->store('photos', 'public');
        }
        return $path;
    }
}
