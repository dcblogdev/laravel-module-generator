<?php

use App\Http\Resources\V1\{Module}Resource;
use App\Models\{Model};
use App\Models\User;
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\put;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->{model} = {Model}::factory()->create();
    Sanctum::actingAs($this->user);
});

test('can see {module}')
    ->get('api/v1/{module}')
    ->assertStatus(200);

test('can sort {module} by name')
    ->get('api/v1/{module}?sort=name')
    ->assertStatus(200);

test('can set pagination number', function () {
    {Model}::factory()->count(5)->create();
    get('api/v1/{module}?perPage=1')->assertJsonFragment([
        'from'      => 1,
        'last_page' => 6
    ]);
});

test('can see single {model}', function () {
    get('api/v1/{module}/'.$this->{model}->uuid)
        ->assertStatus(200)
        ->assertResource(new {module}Resource($this->{model}));
});

test('can update {model}', function () {
    put('api/v1/{module}/'.$this->{model}->uuid, [
        'name' => 'Accounting'
    ])
        ->assertStatus(200)
        ->assertSessionHasNoErrors();
});

test('cannot update {model} with no name', function () {
    put('api/v1/{module}/'.$this->{model}->uuid, [
        'name' => ''
    ])->assertInvalid();
});

test('can delete single {model}', function () {
    delete(route('{module}.delete', $this->{model}->uuid))->assertStatus(204);
    assertSoftDeleted('{module}', ['id' => $this->{model}->id]);
});