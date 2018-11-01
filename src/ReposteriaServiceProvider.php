<?php

namespace Pieroenrico\Reposteria;

use Illuminate\Support\ServiceProvider;
use Pieroenrico\Reposteria\Commands\RepositoryGeneratorCommand;

class ReposteriaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->commands([
                RepositoryGeneratorCommand::class,
            ]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
