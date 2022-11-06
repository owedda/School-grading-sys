<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            LessonsSeeder::class,
            UsersSeeder::class
        ]);
        User::factory()->times(20)->create();
    }
}
