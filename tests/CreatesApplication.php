<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Config;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();
        // Set Database config to SQLite creds for testing as its difficult to change when using the $connection var on models
        Config::set('database.connections.master', Config::get('database.connections.sqlite'));
        Config::set('database.connections.app', Config::get('database.connections.sqlite'));

        return $app;
    }
}
