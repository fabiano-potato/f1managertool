<?php

namespace App\Providers;

use App\Services\CarComponents\CarComponentUpgrader;
use Illuminate\Support\ServiceProvider;

/**
 * Class ServicesServiceProvider
 * @package App\Providers
 */
class ServicesServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [];

    /**
     * Register any application services
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CarComponentUpgrader', function() {
            // TODO: Inject the $user object
            return new CarComponentUpgrader();
        });
    }
}
