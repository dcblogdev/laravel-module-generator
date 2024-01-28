<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use function Pest\Laravel\postJson;

uses(Tests\TestCase::class, LazilyRefreshDatabase::class);

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

test('name is required for creating a {model}', function() {
   postJson(route('api.v1.{module}.store'))
   ->assertUnprocessable()
   ->assertJsonValidationErrors('name');
});

test('Can create a {module}', function() {
   postJson(route('api.v1.{module}.store'), ['name' => fake()->name])
   ->assertJsonMissingValidationErrors()
   ->assertCreated();
});
