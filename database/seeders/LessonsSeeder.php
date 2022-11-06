<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
