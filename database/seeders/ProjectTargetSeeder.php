<?php

namespace Database\Seeders;

use App\Models\ProjectTarget;
use Illuminate\Database\Seeder;

class ProjectTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectTarget::factory([
            'project_id' => 1,
            'name' => 'EC2',
            'variables' => 'MAILER_DRIVE=ses'
        ])->create();
    }
}
