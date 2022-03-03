<?php

use Modules\{Module}\Models\{Model};

uses(Tests\TestCase::class);

test('can see {model} list', function() {
    $this->authenticate();
   $this->get(route('app.{module}.index'))->assertOk();
});

test('can see {model} create page', function() {
    $this->authenticate();
   $this->get(route('app.{module}.create'))->assertOk();
});

test('can create {model}', function() {
    $this->authenticate();
   $this->post(route('app.{module}.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.{module}.index'));

   $this->assertDatabaseCount('{module}', 1);
});

test('can see {model} edit page', function() {
    $this->authenticate();
    ${model} = {Model}::factory()->create();
    $this->get(route('app.{module}.edit', ${model}->id))->assertOk();
});

test('can update {model}', function() {
    $this->authenticate();
    ${model} = {Model}::factory()->create();
    $this->patch(route('app.{module}.update', ${model}->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.{module}.index'));

    $this->assertDatabaseHas('{module}', ['name' => 'Joe Smith']);
});

test('can delete {model}', function() {
    $this->authenticate();
    ${model} = {Model}::factory()->create();
    $this->delete(route('app.{module}.delete', ${model}->id))->assertRedirect(route('app.{module}.index'));

    $this->assertDatabaseCount('{module_}', 0);
});