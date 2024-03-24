<?php

use App\Models\User;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(Tests\TestCase::class);

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

test('can see {module} create page', function() {
    get(route('{module}.create'))
    ->assertOk();
});

test('name is required for creating a {module}', function() {
   post(route('{module}.store'))
   ->assertSessionHasErrors('name');
});

test('Can create a {model}', function() {
   post(route('{module}.store'), ['name' => fake()->name])
   ->assertSessionHasNoErrors()
   ->assertRedirect(route('{module}.index'));
});
