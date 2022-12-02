<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserTypeEnum;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'id'             => fake()->uuid(),
                'username'       => 'owida',
                'name'           => 'Ovidijus',
                'last_name'      => 'Rapalis',
                'type'           => UserTypeEnum::Teacher->value,
                'email'          => 'teacher@teacher.com',
                'password'       => '$2y$10$T0xzj5si/.XhC7EudZ/wx.CYxwBMEdFArl.gjY67BWXhYcB9csIfy',
                'remember_token' => null,
            ],
            [
                'id'             => fake()->uuid(),
                'username'       => 'student12345',
                'name'           => 'Student',
                'last_name'      => 'Studentaukas',
                'type'           => UserTypeEnum::Student->value,
                'email'          => 'student@student.com',
                'password'       => '$2y$10$T0xzj5si/.XhC7EudZ/wx.CYxwBMEdFArl.gjY67BWXhYcB9csIfy',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
        User::factory()->times(7)->create();
    }
}
