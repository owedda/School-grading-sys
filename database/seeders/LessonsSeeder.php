<?php

namespace Database\Seeders;

use App\Constants\DatabaseConstants;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = [
            [
                DatabaseConstants::LESSONS_TABLE_ID   => fake()->uuid(),
                DatabaseConstants::LESSONS_TABLE_NAME => 'Mathematics',
            ],
            [
                DatabaseConstants::LESSONS_TABLE_ID   => fake()->uuid(),
                DatabaseConstants::LESSONS_TABLE_NAME => 'Physics',
            ],
            [
                DatabaseConstants::LESSONS_TABLE_ID   => fake()->uuid(),
                DatabaseConstants::LESSONS_TABLE_NAME => 'Biology',
            ],
            [
                DatabaseConstants::LESSONS_TABLE_ID   => fake()->uuid(),
                DatabaseConstants::LESSONS_TABLE_NAME => 'Spain',
            ],
            [
                DatabaseConstants::LESSONS_TABLE_ID   => fake()->uuid(),
                DatabaseConstants::LESSONS_TABLE_NAME => 'Computer science',
            ],
            [
                DatabaseConstants::LESSONS_TABLE_ID   => fake()->uuid(),
                DatabaseConstants::LESSONS_TABLE_NAME => 'English',
            ],
            [
                DatabaseConstants::LESSONS_TABLE_ID   => fake()->uuid(),
                DatabaseConstants::LESSONS_TABLE_NAME => 'Geography',
            ],
        ];

        Lesson::insert($lessons);
    }
}
