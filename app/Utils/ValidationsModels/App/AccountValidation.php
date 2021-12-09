<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils\ValidationsModels\App;

use App\Interfaces\ValidationInterface;

/**
 * Description of AccountValidation
 *
 * @author moata
 */
class AccountValidation implements ValidationInterface {

    //function to validate account model
    public function validate() {
        $retunData = [
            'name' => 'required|unique:accounts',
            'phone' => 'required',
            'address' => 'required',
            'kiosks' => 'required',
        ];

        return $retunData;
    }

}
