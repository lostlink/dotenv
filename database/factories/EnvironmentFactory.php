<?php

namespace Database\Factories;

use App\Models\Target;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnvironmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'target_id' => Target::factory(),
            'name' => collect(['local', 'production', 'staging', 'develop'])->random(),
            'color' => collect(['green', 'amber', 'red'])->random(),
            'url' => $this->faker->url,
            'notes' => $this->faker->paragraph,
            'variables' => ['ENVIRONMENT_ENV' => 'NA'],
        ];
    }
}
