<?php

namespace Dcblogdev\Generator\Tests;

use Dcblogdev\Generator\GeneratorServiceProvider;
use Orchestra\Testbench\TestCase as Testbench;

class TestCase extends Testbench
{
    protected function getPackageProviders($app)
    {
        return [
            GeneratorServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}