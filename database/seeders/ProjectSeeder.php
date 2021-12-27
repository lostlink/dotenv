<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::factory([
            'team_id' => 1,
            'variables' => "APP_NAME=envmanager\nAPP_ENV=production\nAPP_KEY=base64:gIwnzmYrwpX2cg2t6Lomvrs4XcXwMiuuOvkWPkqqYrE=\nAPP_DEBUG=false\nAPP_URL=http://envmanager.com",
        ])->create();
    }
}
