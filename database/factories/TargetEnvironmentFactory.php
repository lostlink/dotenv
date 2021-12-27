<?php

namespace Database\Factories;

use App\Models\ProjectTarget;
use Illuminate\Database\Eloquent\Factories\Factory;

class TargetEnvironmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_target_id' => ProjectTarget::factory(),
            'name' => collect(['local', 'production', 'staging', 'develop'])->random(),
            'description' => $this->faker->paragraph,
            'variables' => 'ENVIRONMENT_ENV=NA',
        ];
    }
}
