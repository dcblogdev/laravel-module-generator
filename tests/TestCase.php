<?php

namespace Dcblogdev\Generator\Tests;

use Dcblogdev\Generator\GeneratorServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            GeneratorServiceProvider::class
        ];
    }
}