<?php

namespace App\Http\Clients;

interface ProxyInterface
{
    public function setHeaders(array $headers);
    public function getHeaders();
    public function setBody(array $body);
    public function getBody();
    public function post(string $uri, array $params = []);
}
