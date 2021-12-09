<?php

namespace App\Providers;

//classes
use App\Repository\Eloquent\ClientRepository;

//interfaces
use App\Repository\Interfaces\ClientRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {

        // App Repository
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
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
