<?php

namespace App\Utils;

use Softon\LaravelFaceDetect\FaceDetect;

class FaceDetection extends FaceDetect
{

    public function extract($file, $method='upload') {

        if($method == 'upload') {
            $filePath = $file->getPathName();
            if (is_resource($filePath)) {
                $this->canvas = $filePath;
            }
            elseif (is_file($filePath)) {
                $array = explode('.', $file->getClientOriginalName());
                $extencion = strtolower(end($array));

                if($extencion == 'png'){
                    $this->canvas = imagecreatefrompng($filePath);
                }else{
                    $this->canvas = imagecreatefromjpeg($filePath);
                }
            }
            else {
                throw new \Exception("Can not load $filePath");
            }

            $im_width = imagesx($this->canvas);
            $im_height = imagesy($this->canvas);

            //Resample before detection?
            $ratio = 0;
            $diff_width = 420 - $im_width;
            $diff_height = 240 - $im_height;
            if ($diff_width > $diff_height) {
                $ratio = $im_width / 420;
            } else {
                $ratio = $im_height / 240;
            }

            if ($ratio != 0) {
                $this->reduced_canvas = imagecreatetruecolor($im_width / $ratio, $im_height / $ratio);
                imagecopyresampled($this->reduced_canvas, $this->canvas, 0, 0, 0, 0, $im_width / $ratio, $im_height / $ratio, $im_width, $im_height);

                $stats = $this->get_img_stats($this->reduced_canvas);
                $this->face = $this->do_detect_greedy_big_to_small($stats['ii'], $stats['ii2'], $stats['width'], $stats['height']);

                if (isset($this->face) && $this->face['w'] > 0) {
                    $this->face['x'] *= $ratio;
                    $this->face['y'] *= $ratio;
                    $this->face['w'] *= $ratio;
                }
            } else {
                $stats = $this->get_img_stats($this->canvas);
                $this->face = $this->do_detect_greedy_big_to_small($stats['ii'], $stats['ii2'], $stats['width'], $stats['height']);
            }

            if(isset($this->face) && $this->face['w']>0){
                $this->face_found = true;
            }else{
                $this->face_found = false;
            }
            return $this;
        }

        else{
            if (is_resource($file)) {
                $this->canvas = $file;
            }
            elseif (is_file($file)) {
                $array = explode('.', $file);
                $extencion = strtolower(end($array));
                if($extencion == 'png'){
                    $this->canvas = imagecreatefrompng($file);
                }else{
                    $this->canvas = imagecreatefromjpeg($file);
                }
            }
            else {
                throw new \Exception("Can not load $file");
            }

            $im_width = imagesx($this->canvas);
            $im_height = imagesy($this->canvas);

            //Resample before detection?
            $ratio = 0;
            $diff_width = 320 - $im_width;
            $diff_height = 240 - $im_height;
            if ($diff_width > $diff_height) {
                $ratio = $im_width / 320;
            } else {
                $ratio = $im_height / 240;
            }

            if ($ratio != 0) {
                $this->reduced_canvas = imagecreatetruecolor($im_width / $ratio, $im_height / $ratio);
                imagecopyresampled($this->reduced_canvas, $this->canvas, 0, 0, 0, 0, $im_width / $ratio, $im_height / $ratio, $im_width, $im_height);

                $stats = $this->get_img_stats($this->reduced_canvas);
                $this->face = $this->do_detect_greedy_big_to_small($stats['ii'], $stats['ii2'], $stats['width'], $stats['height']);
                if (isset($this->face) && isset($this->face['w']) && $this->face['w'] > 0) {
                    $this->face['x'] *= $ratio;
                    $this->face['y'] *= $ratio;
                    $this->face['w'] *= $ratio;
                }
                else{
                    return false;
                }
            } else {
                $stats = $this->get_img_stats($this->canvas);
                $this->face = $this->do_detect_greedy_big_to_small($stats['ii'], $stats['ii2'], $stats['width'], $stats['height']);
            }
            if (isset($this->face) && isset($this->face['w']) && $this->face['w'] > 0) {
                $this->face_found = true;
            }
            return $this;
        }

    }
}

