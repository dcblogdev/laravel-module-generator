<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Modules\{Module}\App\Models\{Model};
use function Pest\Laravel\delete;

uses(Tests\TestCase::class, LazilyRefreshDatabase::class);

test('Can delete a {model}', function() {
    $user = User::factory()->create();
    $this->actingAs($user);

    ${model} = {Model}::factory()->create();

    $this->assertDatabaseCount({Model}::class, 1);

    delete(route('{module}.destroy', ${model}))
    ->assertSessionHasNoErrors()
    ->assertRedirect(route('{module}.index'));

    $this->assertDatabaseCount({Model}::class, 0);
});
