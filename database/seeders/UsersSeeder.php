<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'             => fake()->uuid(),
                'username'       => 'Admin',
                'name'           => 'Admin',
                'last_name'      => 'Admin',
                'type'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$KjopsXqbCq1NrrGYJe7rr./68LzZSGCas5XxBHHbG.9AF4mc3GPR.',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
