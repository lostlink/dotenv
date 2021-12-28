<?php

namespace Database\Seeders;

use App\Models\Target;
use App\Models\Environment;
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
            TargetSeeder::class,
            EnvironmentSeeder::class,
        ]);
    }
}
