<?php

namespace App\Providers;

use App\Http\Clients\OAuth2ProxyClient;
use App\Http\Clients\ProxyInterface;
use App\Services\DashboardService;
use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\Schema;
//Models
use App\Models\Area;
use App\Models\User;
use App\Models\Visit;
use App\Models\AdminPreference;
use App\Models\Department;
use App\Models\Entity;
use App\Models\InputMethods;
use App\Models\ScanDataTypes;
use App\Models\Setting;
use App\Models\Kiosk;
use App\Models\UserType;
use App\Models\Role;
use App\Models\Scan;
use App\Models\Site;
use App\Models\Compliance;
use App\Models\JourneyFlow;
use App\Models\Journey;
//Observer
use App\Observers\AreaObserver;
use App\Observers\UserObserver;
use App\Observers\VisitObserver;
use App\Observers\AdminPreferenceObserver;
use App\Observers\DepartmentObserver;
use App\Observers\EntityObserver;
use App\Observers\InputMethodsObserver;
use App\Observers\ScanDataTypesObserver;
use App\Observers\SettingObserver;
use App\Observers\KioskObserver;
use App\Observers\UserTypeObserver;
use App\Observers\RoleObserver;
use App\Observers\ScanObserver;
use App\Observers\SiteObserver;
use App\Observers\ComplianceObserver;
use App\Observers\JourneyFlowObserver;
use App\Observers\JourneyObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProxyInterface::class, OAuth2ProxyClient::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);
    
    }
}
