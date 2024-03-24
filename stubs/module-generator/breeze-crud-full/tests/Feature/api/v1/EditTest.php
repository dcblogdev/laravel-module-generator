<?php

use App\Models\User;
use Modules\{Module}\Models\{Model};

use function Pest\Laravel\putJson;

uses(Tests\TestCase::class);

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

test('name is required for editing a {model}', function() {
    ${model} = {Model}::factory()->create();

    putJson(route('api.v1.{module}.update', ${model}))
    ->assertJsonValidationErrors('name');
});

test('Can update a {model}', function() {
    ${model} = {Model}::factory()->create();

    $name = fake()->name;

    putJson(route('api.v1.{module}.update', ${model}), ['name' => $name])
    ->assertJsonMissingValidationErrors()
    ->assertOk();

    $this->assertDatabaseHas({Model}::class, ['name' => $name]);
});
