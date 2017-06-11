<?php

namespace Socialchan\Hikari;

use Illuminate\Support\ServiceProvider;
use Socialchan\Hikari\Repositories\Repository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/repositories.php', 'repositories'
        );

        // Get caching
        Repository::setCacheInstance($this->app['cache']);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositoryCommand();

        if ($this->isLumen() === false) {
            $this->publishes([
                __DIR__.'/../config/repositories.php' => config_path('repositories.php'),
            ], 'config');
        }
    }

    /**
     * Register the make:repository command.
     *
     * @return void
     */
    private function registerRepositoryCommand()
    {
        $this->app->singleton('command.hikari.repository', function ($app) {
            return $app['Socialchan\Hikari\Console\MakeRepositoryCommand'];
        });

        $this->commands('command.hikari.repository');
    }

    /**
     * Check if package is running under Lumen app.
     *
     * @return bool
     */
    protected function isLumen()
    {
        return str_contains($this->app->version(), 'Lumen') === true;
    }
}
