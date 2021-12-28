<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::factory([
            'team_id' => 1,
            'name' => 'test',
            'variables' => [
                'APP_NAME' => 'Laravel',
                'APP_ENV' => 'production',
                'APP_KEY' => 'base64:gIwnzmYrwpX2cg2t6Lomvrs4XcXwMiuuOvkWPkqqYrE=',
                'APP_DEBUG' => 'false',
                'APP_URL' => 'https://laravel.com',
            ],
        ])->create();
    }
}
