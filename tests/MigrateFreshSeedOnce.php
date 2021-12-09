<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait MigrateFreshSeedOnce
{
    protected static $masterMigratePath = "/database/migrations/master";
    protected static $masterSeederPath = "DatabaseMasterSeeder";

    protected static $appSeederPath = "DatabaseSeeder";
    protected static $appMigratePath = "/database/migrations/app";

    /**
     * If true, setup has run at least once.
     * @var boolean
     */
    protected static $setUpHasRunOnce = false;

    /**
     * After the first run of setUp "migrate:fresh --seed"
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        try {
            if (!static::$setUpHasRunOnce) {
                Artisan::call('migrate:fresh');
                Artisan::call('migrate', ['--database' => 'master', '--path' => static::$masterMigratePath]);
                Artisan::call('db:seed', ['--class' => static::$masterSeederPath]);
                Artisan::call('migrate', ['--database' => 'app', '--path' => static::$appMigratePath]);
                Artisan::call('db:seed', ['--class' => static::$appSeederPath]);
                Artisan::call('passport:install');
                Artisan::call('cache:clear');
                Artisan::call('config:clear');
                Artisan::call('route:clear');
                static::$setUpHasRunOnce = true;
            }

            $this->app[Kernel::class]->setArtisan(null);
        } catch (\Exception $exception) {
            dd(
                __FILE__,
                __METHOD__,
                $exception
            );
        }
    }
}
