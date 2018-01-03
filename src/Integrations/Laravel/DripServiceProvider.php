<?php

namespace Snscripts\Drip\Integrations\Laravel;

use Illuminate\Support\ServiceProvider;

/**
 * @codeCoverageIgnore
 */
class DripServiceProvider extends ServiceProvider
{
    public function register()
    {
        $authType = ucfirst(config('drip.authType'));

        $this->registerAuthTypes();

        $this->app->singleton(
            'Snscripts\Drip\Drip',
            function ($app) use ($authType) {
                return new \Snscripts\Drip\Drip(
                    new \GuzzleHttp\Client,
                    $app['Snscripts\Drip\Auth\\' . $authType],
                    config('drip.accountId')
                );
            }
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/drip.php' => config_path('drip.php'),
        ]);
    }

    public function registerAuthTypes()
    {
        $this->app->singleton(
            'Snscripts\Drip\Auth\Token',
            function ($app) {
                return new \Snscripts\Drip\Auth\Token(
                    config('drip.apiToken')
                );
            }
        );

        $this->app->singleton(
            'Snscripts\Drip\Auth\Oauth',
            function ($app) {
                return new \Snscripts\Drip\Auth\Oauth(
                    config('drip.apiToken')
                );
            }
        );
    }
}
