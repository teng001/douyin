<?php



namespace Tengs\Douyin;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

/**
 * Class ServiceProvider.
 *
 */
class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Boot the provider.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/douyin.php' => config_path('douyin.php'),
        ], 'config');
    }

    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/config/douyin.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('douyin.php')]);
        }

        $this->mergeConfigFrom($source, 'douyin');
    }

    /**
     * Register the provider.
     */
    public function register()
    {
        $this->setupConfig();
        $config = config('douyin');
        $this->getRouter()->group($config['route']['attributes'], function ($router) use ($config) {
            $this->loadRoutesFrom(__DIR__.'/router/routers.php');
        });
    }

    protected function getRouter()
    {
        return $this->app->router;
    }
}
