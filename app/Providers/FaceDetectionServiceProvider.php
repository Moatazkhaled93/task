<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utils\FaceDetection;

class FaceDetectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('FaceDetection', FaceDetection::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
