<?php

namespace Database\Seeders;

use App\Models\ProjectTarget;
use App\Models\TargetEnvironment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TeamSeeder::class,
            ProjectSeeder::class,
            ProjectTargetSeeder::class,
            TargetEnvironmentSeeder::class,
        ]);
    }
}
