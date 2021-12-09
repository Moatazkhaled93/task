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
class ErrorsMessagesForScanHelper {

    const Errors = [
        'no_mask' => 'No Mask',
        'high_temperature' => 'High Temperature',
        'wrong_answer' => 'Wrong Answer',
        'no_flow_assigned' => 'No Flow Assigned',
        'incorrect_input_method_rfid' => 'RFID is not enabled for this flow',
        'incorrect_input_method_facial_recognition' => 'Facial Recognition is not enabled for this flow',
        'rfid_not_recognized' => 'Card unidentified',
        'inactivity' => 'Card Inactivity',
        'Certificate_expired' => 'Certificate is expired',
        'Certificate_revoked' => "Certificate was revoked",
        'Verification_failed' => "Verification failed",
        'Signing_Certificate_expired' => "Signing Certificate is expired",
        'test_date_future' => "The test date is in the future",
        'test_result_positive' => "Test result positive",
        'recovery_not_valid_yet' => "Recovery statement is not valid yet",
        'recover_not_valid_anymore' => "Recovery statement is not valid anymore",
        'rules_validation_failed' => "Country rules validation failed",
        'cryptographic_signature_invalid' => "Cryptographic signature invalid",
        'failed_processing_qr' => "Failed processing QR",
        'not_fully_vaccinated' => "Not fully vaccinated",
        'not_vaccinated' => "Not Vaccinated",
        'pcr_not_allowed' => "PCR Not Allowed",
        'pcr_expired' => "PCR Expired",
        'document_not_uploaded' => "Document Not Uploaded",
        'document_protocol_not_supported' => "Document protocol not supported",
        
    ];
        const VaccinErrors = [
        'Certificate_expired',
        'Certificate_revoked',
        'Verification_failed',
        'Signing_Certificate_expired',
        'test_date_future',
        'test_result_positive',
        'recovery_not_valid_yet',
        'recover_not_valid_anymore',
        'rules_validation_failed',
        'cryptographic_signature_invalid',
        'failed_processing_qr',
        'not_fully_vaccinated',
        'not_vaccinated',
        'pcr_not_allowed',
        'pcr_expired',
        'document_not_uploaded'
    ];

}


