<?php

namespace App\Providers;

use App\Events\EntityCreated;
use App\Events\UserTypeCreated;
use App\Listeners\AddDefaultUserType;
use App\Listeners\AddSettings;
use App\Listeners\AddDefaultRole;
use App\Listeners\AddDefaultDepartment;
use App\Listeners\AddDefaultJourney;
use App\Listeners\AddDefaultJourneyFlow;
use App\Listeners\AddDefaultCompliances;
use App\Listeners\AddDefaultSiteAndArea;
use App\Listeners\AddScanDataTypes;
use App\Listeners\AddInputMethods;
use App\Listeners\AttachDefulateUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider {

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        EntityCreated::class => [
//            AddSettings::class,
            AddDefaultUserType::class,
            AddDefaultRole::class,
            AddDefaultDepartment::class,
            AddDefaultJourney::class,
            AddDefaultCompliances::class,
            AddDefaultJourneyFlow::class,
            AddDefaultSiteAndArea::class,
            AttachDefulateUser::class,
//            AddScanDataTypes::class,
//            AddInputMethods::class,
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot() {
        parent::boot();

        //
    }

}
