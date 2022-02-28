<?php

namespace Dcblogdev\Generator;

use Illuminate\Support\ServiceProvider;
use Dcblogdev\Generator\Console\Commands\MakeGeneratorCommand;

class GeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/generator.php', 'generator');
    }

    public function boot()
    {
        $this->configureCommands();
        $this->configurePublishing();
    }

    public function configureCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            MakeGeneratorCommand::class,
        ]);
    }

    public function configurePublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../stubs' => base_path('stubs'),
        ], 'stubs');

        $this->publishes([
                __DIR__.'/../config/generator.php' => config_path('generator.php'),
            ], 'config');

    }
}
