<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Facades\FaceDetection as FaceDetect;

class FaceDetection implements Rule
{
    private $avgMimeTypes ;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->avgMimeTypes = ['image/png' ,'image/jpeg'];
    }
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(request()->hasFile($attribute) && $value){

            $mimeType = request()->file($attribute)->getClientMimeType();

            if(in_array($mimeType, $this->avgMimeTypes)) {
                $faceDetectCheck = FaceDetect::extract(request()->file($attribute))->face_found;
                return $faceDetectCheck;

            }
            return false;
        }
       return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The user image must have a real image for user.';
    }
}
