<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('username', 'like', '%20-2%')->get();

        $team = Team::create([
            'user_id' => $users->firstWhere('username', 'br20-2')->id,
            'name' => '20-2',
            'personal_team' => false,
        ]);

        $users->each(function (User $user) use ($team) {
            $user->teams()->attach($team->id, ['role' => 'admin']);
            $user->update(['current_team_id' => $team->id]);
        });
    }
}
