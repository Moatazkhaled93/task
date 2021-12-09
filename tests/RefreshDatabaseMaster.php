<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;

trait RefreshDatabaseMaster
{
    use RefreshDatabase;

    public function refreshInMemoryDatabase()
    {
        $this->artisan('migrate --path=database/migrations/lamasatech_master');
        $this->artisan('migrate');

        $this->app[Kernel::class]->setArtisan(null);
    }
}
