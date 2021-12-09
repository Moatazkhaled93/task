<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers\MongodbHelpers;

use MongoDB\BSON\UTCDateTime;
use DateTime;
use App\Models\Mongodb\Transaction;
/**
 * Description of TransactionsHelpers
 *
 * @author moataz
 */
class TransactionsHelpers {

    private $tableName;

    const INSERT = array(
        'changedProperties' => [],
        'isSync' => false,
        'syncTo' => ['cloud'],
        'tableName' => '',
        'recordId' => [],
        'transactionType' => 'insert',
        'dataBefore' => null,
        'dataAfter' => [],
        'changeSource' => 'cloud',
        'creationTime' => '',
        'entityId' => '',
    );
    const UPDATE = [
        'changedProperties' => [],
        'isSync' => false,
        'syncTo' => ['cloud'],
        'tableName' => '',
        'recordId' => [],
        'transactionType' => 'update',
        'dataBefore' => [],
        'dataAfter' => [],
        'changeSource' => 'cloud',
        'creationTime' => '',
        'entityId' => '',
    ];
    const DELETE = [
        'changedProperties' => [],
        'isSync' => false,
        'syncTo' => ['cloud'],
        'tableName' => '',
        'recordId' => [],
        'transactionType' => 'delete',
        'dataBefore' => [],
        'dataAfter' => [],
        'changeSource' => 'cloud',
        'creationTime' => '',
        'entityId' => '',
    ];

    public function __construct($tableName) {
        $this->tableName = $tableName;
    }

    public function propertiesUpdateOrDelete($model, &$body, $entityId) {
        $data = $model->toArray();
        foreach ($data as $key => $value) {
            if ($model->isDirty($key)) {
                $body ['changedProperties'][] = $key;
            }
            if ($key == 'created_at' || $key == 'updated_at' || $key == 'deleted_at') {
                $body ['dataBefore'][$key] = (!empty($model->getOriginal($key))) ? new UTCDateTime(new DateTime($model->getOriginal($key))) : null;
            } else {

                $body ['dataBefore'][$key] = $model->getOriginal($key);
            }
        }
        $body ['dataAfter'] = $data;
        $body ['dataAfter']['created_at'] = new UTCDateTime(new DateTime($body ['dataAfter']['created_at']));
        $body ['dataAfter']['updated_at'] = new UTCDateTime(new DateTime($body ['dataAfter']['updated_at']));
        $body ['dataAfter']['deleted_at'] = (!empty($body ['dataAfter']['deleted_at'])) ? new UTCDateTime(new DateTime($body ['dataAfter']['deleted_at'])) : null;
        $body ['tableName'] = $this->tableName;
        $body ['creationTime'] = now();
        $body ['entityId'] = $entityId;
    }

    public function propertiesInsert($model, &$body, $entityId) {
        $data = $model->toArray();
        $data['created_at'] = new UTCDateTime(new DateTime($data['created_at']));
        $data['updated_at'] = new UTCDateTime(new DateTime($data['updated_at']));
        foreach ($data as $key => $value) {
            $body ['changedProperties'][] = $key;
        }
        $body ['dataAfter'] = $data;
        $body ['tableName'] = $this->tableName;
        $body ['creationTime'] = now();
        $body ['entityId'] = $entityId;
    }

    public function createInMongo($transactionRepository, $data) {
//        $transactionObject = $transactionRepository->findByAttribute(['tableName' => $data['tableName'], 'entityId' => $data['entityId']
//            , 'transactionType' => $data['transactionType'], 'dataAfter' => $data['dataAfter'], 'recordId' => $data['recordId'], 'creationTime' => $data['creationTime']]);
                $transactionObject = Transaction::where('tableName', $data['tableName'])
                        ->where('entityId', $data['entityId'])
                        ->where('transactionType', $data['transactionType'])
                        ->where('dataAfter', $data['dataAfter'])
                        ->where('creationTime','>', $data['creationTime'])
                        ->where('recordId', $data['recordId'])->first();
        if (!$transactionObject) {
            $transactionRepository->create($data);
        }
    }

}
