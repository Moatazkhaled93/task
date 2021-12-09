<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;

use App\Models\InputMethods;

/**
 * Description of InputMethodsHelper
 *
 * @author moataz
 */
class InputMethodsHelper {

    const InputMethods = [
        [
            'id' => 1,
            'name' => InputMethods::METHODS['RFID'],
            'description' => InputMethods::METHODS['RFID'],
        ],
        [
            'id' => 2,
            'name' => InputMethods::METHODS['FACE_RECOGNITION'],
            'description' => InputMethods::METHODS['FACE_RECOGNITION'],
        ],
        [
            'id' => 3,
            'name' => InputMethods::METHODS['QR'],
            'description' => InputMethods::METHODS['QR'],
        ],
        [
            'id' => 4,
            'name' => InputMethods::METHODS['DASHBOARD'],
            'description' => InputMethods::METHODS['DASHBOARD'],
        ],
    ];

}
