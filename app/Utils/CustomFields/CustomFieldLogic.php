<?php

namespace App\Utils\CustomFields;

//use ModelsBundle\Entity\VmUserFormValue;

class CustomFieldLogic {

    public $serviceUrl;
    public $accountName;
    public $formTypes = [];
    public $formTypesArr = [];
    public $form;
    public $formCustomFields = [];

    public function __construct($serviceUrl, $accountName) {
        $this->serviceUrl = $serviceUrl;
        $this->accountName = $accountName;
    }

    public function getCustomFieldsKeysValues() {
        $url = $this->serviceUrl . '/field-simple';
        return $this->sendGetCurlRequest($url);
    }

    public function fetchFormTypes() {

        $url = $this->serviceUrl . '/form';
        $this->formTypes = $this->sendGetCurlRequest($url);
    }

    public function prepareFormTypes() {
        if ($this->formTypes) {
            foreach ($this->formTypes as $formType) {
                $this->formTypesArr[$formType['id']] = $formType['type'];
            }
        }
    }

    public function getFormId($key) {
        $id = 0;
        if ($this->formTypes) {
            foreach ($this->formTypes as $formType) {
                if ($formType['type'] == $key)
                    $id = $formType['id'];
            }
        }
        // $id = 3;
        return $id;
    }

    public function fetchFormCustomFields($id) {
//        $url = $this->serviceUrl . '/form/' . $id;
//        $this->form = $this->sendGetCurlRequest($url);
        $this->form = [];
        if (!empty($this->formTypes)) {
            foreach ($this->formTypes as $formType) {
                if ($formType["title"] == $id) {
                    $this->form = $formType;
                }
            }
        }
    }

    public function prepareFormCustomFields($formValuesArr = null) {

        $i = 0;
        $formCustomFields = [];
        if (isset($this->form['custom_fields'])) {
            foreach ($this->form['custom_fields'] as $customField) {
                $formCustomFields[$i]['id'] = $customField['id'];
                $formCustomFields[$i]['name'] = $customField['name'];
                $formCustomFields[$i]['data'] = (isset($formValuesArr[$customField['id']])) ? $formValuesArr[$customField['id']] : null;
                $formCustomFields[$i]['field_type'] = $customField['field_type']['type'];
                $formCustomFields[$i]['field_label'] = $customField['field_type']['name'];
                $formCustomFields[$i]['field_name'] = $customField['field_type']['name'];
                $formCustomFields[$i]['is_required'] = ($customField['pivot']['is_required'] === 1) ? true : false;
                $formCustomFields[$i]['field_options'] = $customField['options'];
                $i++;
            }
        }
        return $formCustomFields;
    }

    public function prepareStaffCustomFieldsSubmit($formData) {
        $customFieldsData = [];
        $i = 0;
        foreach ($formData as $key => $value) {
            if ($key != 'staffId' && $key != '_token') {
                $keyArr = explode('_', $key);
                $customFieldsData[$i]['id'] = $keyArr[0];
                if (is_array($value)) {
                    $valueStr = implode(',', $value);
                } else if (is_bool($value) || $keyArr[1] == 'switch') {
                    $valueStr = ($value || '1') ? 'yes' : 'no';
                } else {
                    $valueStr = $value;
                }
                $customFieldsData[$i]['value'] = $valueStr;
                $i++;
            }
        }
        return $customFieldsData;
    }

    public function prepareVisitorCustomFieldsSubmit($formData) {
        $customFieldsData = [];
        $i = 0;
        foreach ($formData as $key => $value) {
            if ($key != 'visitorId' && $key != 'host' && $key != '_token') {
                $keyArr = explode('_', $key);
                $customFieldsData[$i]['id'] = $keyArr[0];
                if (is_array($value)) {
                    $valueStr = implode(',', $value);
                } else if (is_bool($value) || $keyArr[1] == 'switch') {
                    $valueStr = ($value || $value == '1') ? 'yes' : 'no';
                } else {
                    $valueStr = $value;
                }
                $customFieldsData[$i]['value'] = $valueStr;
                $i++;
            }
        }
        return $customFieldsData;
    }

    public function prepareContractorCustomFieldsSubmit($formData) {
        $customFieldsData = [];
        $i = 0;
        foreach ($formData as $key => $value) {
            if (
                    $key != 'staffId' &&
                    $key != 'visitorId' &&
                    $key != 'contractorId' &&
                    $key != 'userId' && $key != 'host' && $key != '_token'
            ) {
                $keyArr = explode('_', $key);
                $customFieldsData[$i]['id'] = $keyArr[0];
                if (is_array($value)) {
                    $valueStr = implode(',', $value);
                } else if (is_bool($value) || $keyArr[1] == 'switch') {
                    $valueStr = ($value || '1') ? 'yes' : 'no';
                } else {
                    $valueStr = $value;
                }
                $customFieldsData[$i]['value'] = $valueStr;
                $i++;
            }
        }
        return $customFieldsData;
    }

    public function prepareUserCustomFieldsSubmit($formData) {
        $customFieldsData = [];
        $i = 0;
        foreach ($formData as $key => $value) {
            if ($key != 'contractorId' && $key != 'host' && $key != '_token') {
                $keyArr = explode('_', $key);
                $customFieldsData[$i]['id'] = $keyArr[0];
                if (is_array($value)) {
                    $valueStr = implode(',', $value);
                } else if (is_bool($value) || $keyArr[1] == 'switch') {
                    $valueStr = ($value || '1') ? 'yes' : 'no';
                } else {
                    $valueStr = $value;
                }
                $customFieldsData[$i]['value'] = $valueStr;
                $i++;
            }
        }
        return $customFieldsData;
    }

//    public function saveProfileCustomFields($em, $userObj, $customFieldsFormData) {
//        foreach ($customFieldsFormData as $customField) {
//            $staffFormValue = new VmUserFormValue();
//            $staffFormValue->setUser($userObj);
//            $staffFormValue->setFieldId($customField['id']);
//            if (is_array($customField['value'])) {
//                $value = implode(',', $customField['value']);
//            } elseif (is_bool($customField['value'])) {
//                $value = ($customField['value']) ? 'yes' : 'no';
//            } else {
//                $value = $customField['value'];
//            }
//            $staffFormValue->setFieldValue($value);
//            $em->persist($staffFormValue);
//        }
//    }
    //

    public function sendGetCurlRequest($url) {
//        try {


        $qry_str = "?account=" . $this->accountName;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . $qry_str);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        $result = trim(curl_exec($ch));
        curl_close($ch);
        return json_decode($result, true);
//        } catch (\Exception $exc) {
//            // echo $exc->getTraceAsString();
//            return [];
//        }
    }

//    public function makeCurlRequest($data, $url) {
//        $data_string = json_encode($data);
//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/json',
//            'Content-Length: ' . strlen($data_string))
//        );
//        $result = curl_exec($ch);
//        return json_decode($result, true);
//    }
//    public function curlDemo($param) {
//        //        $ch = curl_init($url);
////        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
////        curl_setopt($ch, CURLOPT_POST, FALSE);
////        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
////        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
////        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['account' => $this->accountName]));
////        $returnData = curl_exec($ch);
////        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
////        curl_close($ch);
////        echo '<pre>';
////        print_r($returnData);
////        echo '</pre>';
////        die();
////        return $returnData;
//    }
}
