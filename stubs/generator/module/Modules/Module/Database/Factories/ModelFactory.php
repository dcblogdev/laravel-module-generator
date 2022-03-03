<?php
namespace Modules\{Module}\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\{Module}\Models\{Model};

class {Model}Factory extends Factory
{
    protected $model = {Model}::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}