<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Lavage;
use App\Models\Vehicule;
use App\Models\Driver;
use App\Models\Entretien;
use App\Models\User;

use App\Observers\ModelHistoryObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    Lavage::observe(ModelHistoryObserver::class);
    Vehicule::observe(ModelHistoryObserver::class);
    Driver::observe(ModelHistoryObserver::class);
    Entretien::observe(ModelHistoryObserver::class);
    User::observe(ModelHistoryObserver::class);
    }
}
