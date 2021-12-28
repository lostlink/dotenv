<?php

namespace Database\Seeders;

use App\Models\Target;
use Illuminate\Database\Seeder;

class TargetSeeder extends Seeder
{
    public function run(): void
    {
        Target::factory([
            'project_id' => 1,
            'name' => 'EC2',
            'variables' => [
                'MAILER_DRIVER' => 'ses',
            ],
        ])->create();
    }
}
