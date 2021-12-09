<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;

/**
 * Description of ErrorsMessagesForScanHelper
 *
 * @author moataz
 */
class DocumentStatusForScanHelper {

    const Status = [
        'document_protocol_not_supported' => 'Not Supported',
        'pcr_expired' => 'Expired',
        'Certificate_expired' => 'Expired',
        'Signing_Certificate_expired' => 'Expired',
        'pcr_not_allowed' => 'Unchecked',
        'Certificate_revoked' => 'Unchecked',
        'Verification_failed' => 'Unchecked',
        'test_date_future' => 'Unchecked',
        'recovery_not_valid_yet' => "Unchecked",
        'recover_not_valid_anymore' => "Unchecked",
        'rules_validation_failed' => "Unchecked",
        'cryptographic_signature_invalid' => "Unchecked",
        'Verification_failed' => "Unchecked",
        'valid' => "Vaccinated",
        'recovered' => "Vaccinated",
        'negative_pcr' => "Negative PCR",
        'test_result_positive' => 'Positive PCR',
    ];
    const DocumentStatus = ['Unchecked' => ['pcr_not_allowed', 'Certificate_revoked', 'Verification_failed', 'test_date_future', 'recovery_not_valid_yet',
            'recover_not_valid_anymore', 'rules_validation_failed', 'cryptographic_signature_invalid', 'Verification_failed'],
            'Vaccinated' => ['Valid', 'recovered'],
            'Negative PCR'=> ['negative_pcr'],
            'Positive PCR'=> ['test_result_positive'],
            'Not Supported'=> ['document_protocol_not_supported'],
            'Expired'=> ['pcr_expired','Certificate_expired','Signing_Certificate_expired'],
    ];

}
