<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;

/**
 * Description of ProxyRequest
 *
 * @author moata
 */
class GuzzleClient {

    private $client;
    private $headers;
    private $token;

    public function __construct($token = null) {
        $this->client = new Client();
        $this->token = $token;
        $this->headers = $this->getHeaders();
    }

    public function post($url, $params) {
        $request = $this->client->post($url, ['form_params' => $params], ['headers' => $this->headers]);

        return json_decode($request->getBody());
    }

    public function put($url, $params) {
        $request = $this->client->put($url, ['headers' => $this->headers, 'form_params' => $params]);

        return json_decode($request->getBody());
    }

    public function get($url, $params) {
        $request = $this->client->get($url, ['query' => $params], ['headers' => $this->headers]);

        return json_decode($request->getBody());
    }

    public function delete($url) {
        $request = $this->client->delete($url);

        return json_decode($request->getBody());
    }

    public function getHeaders() {
        if (!empty($this->token)) {
            return [
                'Authorization' => "Bearer " . $this->token,
                'Accept' => 'application/json',
            ];
        } else {

            return [
                'Content-Type' => 'application/json',
            ];
        }
    }

}
