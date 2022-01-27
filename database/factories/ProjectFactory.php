<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),
            'name' => $this->faker->domainWord(),
            'description' => $this->faker->paragraph(),
            'variables' => ['PROJECT_ENV' => 'TEMP'],
        ];
    }
}
