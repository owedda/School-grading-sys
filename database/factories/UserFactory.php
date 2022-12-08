<?php

namespace Database\Factories;

use App\Constants\DatabaseConstants;
use App\Models\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            DatabaseConstants::USERS_TABLE_ID => fake()->uuid(),
            DatabaseConstants::USERS_TABLE_USERNAME => fake()->userName(),
            DatabaseConstants::USERS_TABLE_NAME => fake()->name(),
            DatabaseConstants::USERS_TABLE_LAST_NAME => fake()->lastName(),
            DatabaseConstants::USERS_TABLE_TYPE => UserTypeEnum::Student->value,
            DatabaseConstants::USERS_TABLE_EMAIL => fake()->unique()->safeEmail(),
            // 123456789
            DatabaseConstants::USERS_TABLE_PASSWORD => '2y$10$T0xzj5si/.XhC7EudZ/wx.CYxwBMEdFArl.gjY67BWXhYcB9csIfy',
        ];
    }
}
