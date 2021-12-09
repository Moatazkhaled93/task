<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers\MongodbHelpers;

use App\Helpers\MongodbHelpers\TransactionsHelpers;
use App\Models\Mongodb\Transaction;

/**
 * Description of AttachHelpers
 *
 * @author moataz
 */
class AttachHelpers {

    private $transaction;
    private $TransactionsHelpers;
    private $tableName;

    public function __construct($tableName) {
        $this->transaction = new Transaction();
        $this->tableName = $tableName;
        $this->TransactionsHelpers = new TransactionsHelpers($this->tableName);
    }

    public function created($data) {
        $body = $this->TransactionsHelpers::INSERT;
        $body['changedProperties'] = $data['changedProperties'];
        $body['recordId'] = $data['recordId'];
        $body['dataBefore'] = null;
        $body['dataAfter'] = $data['dataAfter'];
        $body['creationTime'] = $data['creationTime'];
        $body['entityId'] = $data['entityId'];
        $body['tableName'] = $this->tableName;
        $this->createInMongo($body);
    }

    public function updated($data) {
        $body = $this->TransactionsHelpers::UPDATE;
        $body['changedProperties'] = $data['changedProperties'];
        $body['recordId'] = $data['recordId'];
        $body['dataBefore'] = isset($data['dataBefore']) ? $data['dataBefore'] : null;
        $body['dataAfter'] = $data['dataAfter'];
        $body['creationTime'] = $data['creationTime'];
        $body['entityId'] = $data['entityId'];
        $body['tableName'] = $this->tableName;
        $this->createInMongo($body);
    }

    public function deleted($data) {
        $body = $this->TransactionsHelpers::DELETE;
        $body['changedProperties'] = $data['changedProperties'];
        $body['recordId'] = $data['recordId'];
        $body['dataBefore'] = null;
        $body['dataAfter'] = $data['dataAfter'];
        $body['creationTime'] = $data['creationTime'];
        $body['entityId'] = $data['entityId'];
        $body['tableName'] = $this->tableName;
        $this->createInMongo($body);
    }

    public function createInMongo($data) {
        $transactionObject = Transaction::where('tableName', $data['tableName'])
                        ->where('entityId', $data['entityId'])
                        ->where('transactionType', $data['transactionType'])
                        ->where('dataAfter', $data['dataAfter'])
                        ->where('creationTime','>', $data['creationTime'])
                        ->where('recordId', $data['recordId'])->first();
        if (!$transactionObject) {
            Transaction::insert($data);
        }
    }

}
