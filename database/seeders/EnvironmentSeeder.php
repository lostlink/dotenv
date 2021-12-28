<?php

namespace Database\Seeders;

use App\Models\Environment;
use Illuminate\Database\Seeder;

class EnvironmentSeeder extends Seeder
{
    public function run(): void
    {
        Environment::factory([
            'target_id' => 1,
            'name' => 'Local',
            'url' => 'http://laravel.test',
            'variables' => [
                'APP_ENV' => 'local',
                'APP_DEBUG' => 'true',
                'APP_URL' => 'http://laravel.test',
            ],
        ])->create();

        Environment::factory([
            'target_id' => 1,
            'name' => 'Production',
            'url' => 'https://laravel.com',
            'variables' => []
        ])->create();
    }
}
