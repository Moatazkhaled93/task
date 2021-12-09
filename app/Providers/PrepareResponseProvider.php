<?php

namespace App\Providers;

use App\Library\Services\ResponseInterface;
use Illuminate\Support\ServiceProvider;
use App\Library\Services\PrepareResponse;

class PrepareResponseProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(ResponseInterface::class, PrepareResponse::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        //
    }

}
