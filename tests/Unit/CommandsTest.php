<?php

use Dcblogdev\Generator\Tests\TestCase;

uses(TestCase::class);

test('does not complete with a path that does not exist', function () {
    $this->artisan('build:template')
        ->expectsConfirmation('Please enter a name', 'contacts')
        ->expectsConfirmation('Please enter the template folder path', 'wrong')
        ->assertExitCode(0);
});

test('completes with a valid path', function () {
    $this->artisan('build:template')
        ->expectsConfirmation('Please enter a name', 'contacts')
        ->expectsConfirmation('Please enter the template folder path')
        ->assertExitCode(1);
});