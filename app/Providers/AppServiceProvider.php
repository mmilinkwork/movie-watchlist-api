<?php

namespace App\Providers;

use App\Services\API\OMBD\Contracts\MovieApiIntegrationServiceInterface;
use App\Services\API\OMBD\Contracts\OMBDServiceInterface;
use App\Services\API\OMBD\OMBDIntegrationService;
use App\Services\API\OMBD\OMBDService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        OMBDServiceInterface::class => OMBDService::class,
        MovieApiIntegrationServiceInterface::class => OMBDIntegrationService::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
