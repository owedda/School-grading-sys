<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = [
            [
                'id'   => fake()->uuid(),
                'name' => 'Mathematics',
            ],
            [
                'id'   => fake()->uuid(),
                'name' => 'Physics',
            ],
            [
                'id'   => fake()->uuid(),
                'name' => 'Biology',
            ],
            [
                'id'   => fake()->uuid(),
                'name' => 'Spain',
            ],
            [
                'id'   => fake()->uuid(),
                'name' => 'Computer science',
            ],
            [
                'id'   => fake()->uuid(),
                'name' => 'English',
            ],
            [
                'id'   => fake()->uuid(),
                'name' => 'Geography',
            ],
        ];

        Lesson::insert($lessons);
    }
}
