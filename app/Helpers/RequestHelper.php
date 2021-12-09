<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

/**
 * Description of RequestHelper
 *
 * @author moata
 */
class RequestHelper {

    /**
     * GET .
     *
     * @param string
     */
    public function getGuzzleRequest($url) {

        $client = new Client();
        $apiRequest = $client->get($url);
        $response = json_decode($apiRequest->getBody());

        return $response;
    }

    /**
     * POST .
     *
     * @param string
     * @param array
     */
    public function postGuzzleRequest($url, $data = []) {

        $client = new Client();
        $apiRequest = $client->post($url, array('form_params' => $data));
        $response = json_decode($apiRequest->getBody());

        return $response;
    }

    /**
     * PUT .
     *
     * @param string
     * @param array
     */
    public function putGuzzleRequest($url, $data = []) {

        $client = new Client();
        $apiRequest = $client->put($url, array('form_params' => $data));
        $response = json_decode($apiRequest->getBody());

        return $response;
    }

    /**
     * DELETE .
     *
     * @param string
     */
    public function deleteGuzzleRequest($url) {

        $client = new Client();
        $apiRequest = $client->delete($url);
        $response = json_decode($apiRequest->getBody());

        return $response;
    }

}
