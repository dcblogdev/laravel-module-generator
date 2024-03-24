<?php

use App\Models\User;
use Modules\{Module}\Models\{Model};

use function Pest\Laravel\deleteJson;

uses(Tests\TestCase::class);

test('Can delete a {model}', function() {
    $user = User::factory()->create();
    $this->actingAs($user);

    ${model} = {Model}::factory()->create();

    $this->assertDatabaseCount({Model}::class, 1);

    deleteJson(route('api.v1.{module}.destroy', ${model}))
    ->assertJsonMissingValidationErrors()
    ->assertNoContent();

    $this->assertDatabaseCount({Model}::class, 0);
});
