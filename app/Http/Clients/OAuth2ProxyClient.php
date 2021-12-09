<?php

namespace App\Http\Clients;

use App\Exceptions\OAuth2Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use phpDocumentor\Reflection\Types\Self_;
use Laravel\Passport\Client as OClient;
use \Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;

/**
 * Description of ProxyRequest
 *
 * @author moata
 */
class OAuth2ProxyClient implements ProxyInterface {

    const OAUTH_TOKEN = '/oauth/token';
    const OAUTH_CLIENTS = '/oauth/clients';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var oClient
     */
    private $oClient;

    /**
     * @TODO: Possibly bring the Client in through a factory or service provider setting the base uri there
     * @var string
     */
    private $baseUri;

    /**
     * @var array
     */
    private $params;

    /**
     * @var array
     */
    private $headers;

    public function __construct(Client $client) {
        $this->baseUri = config('app.url');
        $this->client = $client;
        $this->oClient = OClient::where('password_client', 1)->first();
    }

    public function setHeaders(array $headers) {
        $this->headers = $headers;

        return $this;
    }

    public function getHeaders() {
        return [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ];
    }

    public function setBody(array $params): OAuth2ProxyClient {
        $body = array_merge(
                $params,
                [
                    'client_id' => $this->oClient->id,
                    'client_secret' => $this->oClient->secret,
                    'scope' => '*',
                ]
        );

        $this->params = [
            'body' => $body
        ];

        return $this;
    }

    public function getBody() {
        return $this->params;
    }

    public function grantPasswordToken(string $email, string $password): array {
        $this->setBody([
            'grant_type' => 'password',
            'username' => $email,
            'password' => $password,
            'redirect_uri' => config('services.passport.redirect_uri')
        ]);

        try {
            return $this->post(self::OAUTH_TOKEN, $this->getBody());
        } catch (ClientException $clientException) {
            throw new OAuth2Exception($clientException->getMessage(), $clientException->getCode());
        }
    }

    public function refreshAccessToken(string $refreshToken): array {
        $this->setBody([
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        ]);

        try {
            return $this->post(self::OAUTH_TOKEN, $this->getBody());
        } catch (ClientException $clientException) {
            throw new OAuth2Exception($clientException->getMessage(), $clientException->getCode());
        }
    }

    public function post(string $uri, array $params = []) {
        // make an internal request to the passport server
        $tokenRequest = Request::create($uri, 'post', $params['body']);
        // let the framework handle the request
        $response = app()->handle($tokenRequest);
        $response = json_decode($response->getContent(), true);
        return $response;
    }

    public function grantClientSecret($data) {
        $oClient = OClient::where('name', $data['entityId'] . "_" . $data['kioskId'])->first();
        if (!$oClient) {
            Artisan::call('passport:client', [
                '--personal' => true,
                '--name' => $data['entityId'] . "_" . $data['kioskId']
            ]);
            $oClient = OClient::where('name', $data['entityId'] . "_" . $data['kioskId'])->first();
        }

        return $oClient;
    }

    public function getAccessToken($data) {
        $oClient = OClient::firstWhere('secret', $data['secret']);
        $this->setBody([
            'grant_type' => 'client_credentials',
            'client_id' => $oClient->id,
            'client_secret' => $data['secret'],
            'scope' => '*'
        ]);
        return $this->post(self::OAUTH_TOKEN, $this->getBody());
    }

}
