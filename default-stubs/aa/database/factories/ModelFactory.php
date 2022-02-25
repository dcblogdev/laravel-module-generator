<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Model};
use App\Models\User;

class {Model}Factory extends Factory
{
    protected $model = {Model}::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'added_by_id' => User::factory()->create()
        ];
    }
}