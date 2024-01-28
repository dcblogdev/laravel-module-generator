<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use function Pest\Laravel\getJson;

uses(Tests\TestCase::class, LazilyRefreshDatabase::class);

test('can see books page', function() {
    $user = User::factory()->create();
    $this->actingAs($user);

    getJson(route('api.v1.{module}.index'))->assertOk();
});