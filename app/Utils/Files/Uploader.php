<?php

namespace App\Utils\Files;

use App\Facades\FaceDetection as FaceDetect;
use League\Flysystem\File;
use Illuminate\Support\Facades\Storage;

trait Uploader {

    /**
     * Uploads a file
     *
     * @param string $requestFieldName file name request
     * @param string $path path to upload to
     * @return string uploaded file's path
     */
    private function uploadAs($requestFieldName, $path) {
        $file = request()->file($requestFieldName);

        if (!$file)
            return false;
        $fileName = $this->generateUniqueName() . '.' . $file->getClientOriginalExtension();
        request($requestFieldName)->move(public_path('storage/' . $path), $fileName);

        return $path . '/' . $fileName;
    }

    /**
     * Uploads a image crop  the extracting face
     *
     * @param string $requestFieldName file name request
     * @param string $path path to upload to
     * @return string uploaded image's path
     */
    private function uploadCropImageAs($requestImageName, $path )
    {
        $file = request()->file($requestImageName);

        if(! $file) return false;
        $imageName =  $this->generateUniqueName() . '.' . $file->getClientOriginalExtension();
        if (!file_exists(public_path('storage/'.$path))) {
        $folderPath = public_path('storage/'.$path);
        $response = mkdir($folderPath, 0777, true);
        }
        FaceDetect::extract(request()->file($requestImageName))->save(public_path('storage/'. $path .'/'. $imageName));

        return $path. '/' .$imageName;
    }

    /**
     * Delete a file from the specified storage
     *
     * @param string $filePath relative path to the file to delete
     * @param string $storage
     * @return void
     */
    public static function delete($filePath, $storage = 'public') {
        if (Storage::disk($storage)->exists($filePath)) {
            Storage::disk($storage)->delete($filePath);
        }
    }

    private function generateUniqueName() {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0);
    }

}
