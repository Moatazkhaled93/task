<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Validation\Factory as ValidationFactory;

class KioskErrorResponse extends FormRequest
{
      protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
                        response()->json([
                            'error_code' => 400,
                            'status' => 'error',
                            'message' => 'The given data was invalid.',
                                'errors' => $validator->errors()->all()
                                ], 400)
        );
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }
}
