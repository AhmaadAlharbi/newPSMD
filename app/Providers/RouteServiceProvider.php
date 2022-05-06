<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';
    public const ProtectionHomeUser = "/dashboard/user/query_section_id=2";
    public const BatteryHomeUser = "/dashboard/user/query_section_id=3";
    public const TransformersHomeUser = "/dashboard/user/query_section_id=5";
    public const SwitchGearHomeUser = "/dashboard/user/query_section_id=6";

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Protection.php'));
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/battery.php'));
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/switchRoute.php'));
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/transformersRoute.php'));
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/firefightingRoute.php'));
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/EdaraRoute.php'));
                
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}