<?php

namespace App\Utils;

use Jose\Component\Core\JWK;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Signature\Algorithm\ES256;
use Jose\Component\Signature\JWSBuilder;
use Jose\Component\Signature\Serializer\JWSSerializerManager;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\KeyManagement\JWKFactory;
/**
 * Description of CreateToken
 *
 * @author sabry
 */
class JWT
{
    public $payload;

    public function __construct($payload = [])
    {
        $this->payload = $payload;
    }

    public function setPayload(array $payload)
    {
        $this->payload = $payload;

        return $this;
    }

    public function createToken()
    {
        $algorithm_manager = new AlgorithmManager([
            new ES256(),
        ]);
    
        // We instantiate our JWS Builder.
        $jwsBuilder = new JWSBuilder($algorithm_manager);

        $jwk = JWKFactory::createFromKeyFile(
            storage_path() . '/app/public/jwtES256.key', // The filename PRIVATE_KEY_PATH
            '', // Secret if the key is encrypted
            [
                'use' => 'sig', // Additional parameters
            ]
        );

        $payload = json_encode($this->payload);

        $jws = $jwsBuilder
            ->create()                               // We want to create a new JWS
            ->withPayload($payload)                  // We set the payload
            ->addSignature($jwk, ['alg' => 'ES256']) // We add a signature with a simple protected header
            ->build();                               // We build it
        // The serializer manager. We only use the JWS Compact Serialization Mode.
        $serializer = new CompactSerializer();

        // We try to load the token.
        $token = $serializer->serialize($jws, 0); // We serialize the signature at index
        return ($token);
    }

}
