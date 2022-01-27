<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        Model::unguard();

        Team::factory(
            [
                'user_id' => User::factory([
                    'name' => 'Nuno Souto',
                    'email' => 'nsouto@lostlink.net',
                ])->create(),
                'name' => 'Nuno\'s Personal Team',
                'personal_team' => true,
            ]
        )->create();

        Team::factory()->count(3)->create();

        Model::reguard();
    }
}
