<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Tests\MigrateFreshSeedOnce;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use MigrateFreshSeedOnce;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginSuccessful()
    {
        // Mock Guzzle Client
        $mock = $this->mock(Client::class);
        $mock->shouldReceive('post')
            ->andReturn(new Response(
                $status = 200,
                $headers = [],
                File::get(base_path('tests/Feature/tokenResponse.json'))
            ));

        $this->setPassportConfigCredentails();

        $email = 'r.skinner@lamasatech.com';

        $credentials = [
            'email' => $email,
            'password' => 'password',
        ];

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);

        $response = $this->post(route('login'), $credentials);

        $response->assertJson([
            'status',
            'message',
            'data' => [
                'token_type',
                'expires_in',
                'access_token',
                'refresh_token',
            ],
        ]);
    }

    public function testLoginUnsuccesfulResponse()
    {
        $email = 'r.skinner@lamasatech.com';

        $credentials = [
            'email' => $email,
            'password' => '1234567890',
        ];

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);

        $response = $this->post(route('login'), $credentials);

        $response->assertJson(json_decode(File::get(base_path('tests/Feature/registerUnauthorisedResponse.json')), true));
    }

    private function setPassportConfigCredentails()
    {
        // Get passport credentials
        $oauthCreds = DB::table('oauth_clients')
            ->select()
            ->where('name', '=', env('APP_NAME') . ' Password Grant Client')
            ->first();

        // Set config for passport
        Config::set('services.passport.password_client_id', $oauthCreds->id);
        Config::set('services.passport.password_client_secret', $oauthCreds->secret);
        Config::set('services.passport.redirect_uri', $oauthCreds->redirect);
    }
}
