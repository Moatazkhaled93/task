<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers\Passport;

use App\Http\Clients\GuzzleClient;
use Illuminate\Support\Facades\Session;

/**
 * Description of AuthPassport
 *
 * @author moataz
 */
class AuthPassport {

    const GET_CLIENTS = '/api/get-client-secret';
    const GET_TOKEN = '/api/access-token';

    private $guzzleClient;
    private $baseUri;

    public function __construct() {
        $this->baseUri = config('app.passport_url');
        $this->guzzleClient = new GuzzleClient();
        $this->getClientSecret();
        $this->getToken();
    }

    private function getClientSecret() {
        $response = $this->guzzleClient->post($this->baseUri . self::GET_CLIENTS, ['key' => config('app.passport_key')]);
        session(['secretKey' => $response->data]);
    }

    private function getToken() {
        $response = $this->guzzleClient->post($this->baseUri . self::GET_TOKEN, ['secret' => Session::get('secretKey')]);
        session(['passportToken' => $response->data->access_token]);
    }

}
