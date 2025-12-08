<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Subject;


class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects=subject::factory()->count(10)->create();

        Student::all()->each(function ($student) use ($subjects) {
        $student->subjects()->attach(
            $subjects->random(rand(1, 3))->pluck('id')->toArray() 
        );
       
    });

    }
}
