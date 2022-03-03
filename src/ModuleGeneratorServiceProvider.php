<?php

namespace Dcblogdev\ModuleGenerator;

use Illuminate\Support\ServiceProvider;
use Dcblogdev\ModuleGenerator\Console\Commands\MakeGeneratorCommand;

class ModuleGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/module-generator.php', 'module-generator');
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
                __DIR__.'/../config/module-generator.php' => config_path('module-generator.php'),
            ], 'config');

    }
}
