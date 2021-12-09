<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;

use Illuminate\Http\File;

/**
 * Description of S3Helpers
 *
 * @author moataz
 */
class S3Helpers {

    public function upload($image, $entity, $fileName, $s3filePath = '/profiles/') {
        $s3 = \Storage::disk('s3');
        $fileName = $fileName . '.' . $image->getClientOriginalExtension();
        $s3filePath = '/profiles/' . $entity . '/' . $fileName;
        $s3->put($s3filePath, file_get_contents($image), 'public');
    }

    public function uploadByFileName($imgPath, $entity, $fileName, $s3filePath = '/profiles/') {
        $s3filePath = '/profiles/' . $entity;
        \Storage::disk('s3')->putFileAs($s3filePath, new File($imgPath), $fileName, 'public');
    }

    public function copy($from, $to) {
        $s3 = \Storage::disk('s3');
        $s3->put($to,\Storage::disk('s3Passport')->get($from), 'public');

    }

    public function chackExists($path) {

        $s3 = \Storage::disk('s3');

        if ($s3->exists($path)) {
            $s3->delete($path);
        }
    }

}
