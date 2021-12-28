<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class TargetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => Project::factory(),
            'name' => collect(['ec2', 'fargate', 'lambda', 'vapor', 'vultr'])->random(),
            'color' => collect(['green', 'amber', 'red'])->random(),
            'notes' => $this->faker->paragraph,
            'variables' => ['TARGET_ENV' => 'NA'],
        ];
    }
}
