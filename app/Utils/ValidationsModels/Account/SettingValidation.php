<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils\ValidationsModels\Account;

use App\Interfaces\ValidationInterface;

/**
 * Description of AccountValidation
 *
 * @author moata
 */
class SettingValidation implements ValidationInterface {

    //function to validate account model
    public function validate() {
        $retunData = [
            'name' => 'required|unique:settings',
            'type' => 'required',
            'label' => 'required',
        ];

        return $retunData;
    }

}
