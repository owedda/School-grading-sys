<?php

namespace Database\Seeders;

use App\Constants\DatabaseConstants;
use App\Models\User;
use App\Models\UserTypeEnum;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                DatabaseConstants::USERS_TABLE_ID        => fake()->uuid(),
                DatabaseConstants::USERS_TABLE_USERNAME  => 'owida',
                DatabaseConstants::USERS_TABLE_NAME      => 'Ovidijus',
                DatabaseConstants::USERS_TABLE_LAST_NAME => 'Rapalis',
                DatabaseConstants::USERS_TABLE_TYPE      => UserTypeEnum::Teacher->value,
                DatabaseConstants::USERS_TABLE_EMAIL     => 'teacher@teacher.com',
                DatabaseConstants::USERS_TABLE_PASSWORD  => '$2y$10$T0xzj5si/.XhC7EudZ/wx.CYxwBMEdFArl.gjY67BWXhYcB9csIfy',
            ],
            [
                DatabaseConstants::USERS_TABLE_ID        => fake()->uuid(),
                DatabaseConstants::USERS_TABLE_USERNAME  => 'student12345',
                DatabaseConstants::USERS_TABLE_NAME      => 'Student',
                DatabaseConstants::USERS_TABLE_LAST_NAME => 'Studentaukas',
                DatabaseConstants::USERS_TABLE_TYPE      => UserTypeEnum::Student->value,
                DatabaseConstants::USERS_TABLE_EMAIL     => 'student@student.com',
                DatabaseConstants::USERS_TABLE_PASSWORD  => '$2y$10$T0xzj5si/.XhC7EudZ/wx.CYxwBMEdFArl.gjY67BWXhYcB9csIfy',
            ],
        ];

        User::insert($users);
        User::factory()->times(7)->create();
    }
}
