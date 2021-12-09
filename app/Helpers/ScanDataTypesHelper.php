<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;

use App\Models\ScanDataTypes;

/**
 * Description of ScanDataTypesHelper
 *
 * @author moataz
 */
class ScanDataTypesHelper {

    const ScanDataTypes = [
        [
            'id' => 1,
            'name' => ScanDataTypes::STATUS['CHECKED_IN'],
            'description' => ScanDataTypes::STATUS['CHECKED_IN'],
        ],
        [
            'id' => 2,
            'name' => ScanDataTypes::STATUS['CHECKED_OUT'],
            'description' => ScanDataTypes::STATUS['CHECKED_OUT'],
        ],
        [
            'id' => 3,
            'name' => ScanDataTypes::STATUS['SIGNED_IN'],
            'description' => ScanDataTypes::STATUS['SIGNED_IN'],
        ],
        [
            'id' => 4,
            'name' => ScanDataTypes::STATUS['SIGNED_OUT'],
            'description' => ScanDataTypes::STATUS['SIGNED_OUT'],
        ],
        [
            'id' => 5,
            'name' => ScanDataTypes::STATUS['DENIED'],
            'description' => ScanDataTypes::STATUS['DENIED'],
        ],
    ];

}
