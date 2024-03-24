<?php

use App\Models\User;
use Modules\{Module}\Models\{Model};

use function Pest\Laravel\get;
use function Pest\Laravel\put;

uses(Tests\TestCase::class);

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

test('Can see {module} edit page', function() {
    ${model} = {Model}::factory()->create();

    get(route('{module}.edit', ${model}))
    ->assertOk();
});

test('name is required for editing a {model}', function() {
    ${model} = {Model}::factory()->create();

    put(route('{module}.update', ${model}))
    ->assertSessionHasErrors();
});

test('Can update a {model}', function() {
    ${model} = {Model}::factory()->create();

    $name = fake()->name;

    put(route('{module}.update', ${model}), ['name' => $name])
    ->assertSessionHasNoErrors()
    ->assertRedirect(route('{module}.index'));

    $this->assertDatabaseHas({Model}::class, ['name' => $name]);
});
