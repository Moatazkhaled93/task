<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils\ValidationsModels\Account;
use App\Interfaces\ValidationInterface;

/**
 * Description of KioskValidation
 *
 * @author moataz
 */
class KioskValidation implements ValidationInterface {

    //function to validate account model
    public function validate() {
        $retunData = [
            'name' => 'required',
            'serial_number' => 'required',
            'model' => 'required',
            'platform_version' => 'required',
            'mac_address' => 'required',
            'area_id' => 'required',
        ];

        return $retunData;
    }

}
