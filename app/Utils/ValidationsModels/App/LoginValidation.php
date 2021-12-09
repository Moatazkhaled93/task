<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils\ValidationsModels\App;

use App\Interfaces\ValidationInterface;

/**
 * Description of LoginValidation
 *
 * @author moata
 */
class LoginValidation implements ValidationInterface {

    //function to validate login model
    public function validate() {

        $retunData = [
            'fullName' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'companyName' => 'required'
        ];

        return $retunData;
    }

}
