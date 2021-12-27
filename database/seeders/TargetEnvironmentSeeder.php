<?php

namespace Database\Seeders;

use App\Models\TargetEnvironment;
use Illuminate\Database\Seeder;

class TargetEnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TargetEnvironment::factory([
            'project_target_id' => 1,
            'name' => 'Local',
            'variables' => "APP_ENV=local\nAPP_DEBUG=true\nAPP_URL=http://envmanager.test"
        ])->create();

        TargetEnvironment::factory([
            'project_target_id' => 1,
            'name' => 'Production',
            'variables' => null
        ])->create();
    }
}
