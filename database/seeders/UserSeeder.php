<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Brandon Julio Thenaro', 'username' => 'br20-2'],
            ['name' => 'Clarissa Chuardi', 'username' => 'cc20-2'],
            ['name' => 'Johanes Peter Vincentius', 'username' => 'jp20-2'],
            ['name' => 'Lionel Ritchie', 'username' => 'll20-2'],
            ['name' => 'Skolastika Gabriella Theresandia Prasetyo', 'username' => 'ga20-2'],
            ['name' => 'Stanley Dave Teherag', 'username' => 'st20-2'],
            ['name' => 'Thaddeus Cleo', 'username' => 'tc20-2'],
            ['name' => 'Vincent Benedict', 'username' => 'vn20-2'],
        ];

        collect($users)->each(function ($user) {
            $split = Str::of($user['name'])->split('/\s/');

            $first = $split[0];
            $last = $split[$split->count() - 1];

            User::create(collect($user)->merge([
                'password' => bcrypt(Str::repeat($user['username'], 3)),
                'email' => Str::lower("$first.$last@binus.edu"),
            ])->all());
        });
    }
}
