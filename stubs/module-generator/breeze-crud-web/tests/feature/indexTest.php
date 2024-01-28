<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use function Pest\Laravel\get;

uses(Tests\TestCase::class, LazilyRefreshDatabase::class);

test('can see {module} page', function() {
    $user = User::factory()->create();
    $this->actingAs($user);

    get(route('{module}.index'))->assertOk();
});