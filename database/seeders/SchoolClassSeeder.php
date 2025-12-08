<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\schoolClass;
use App\Models\Student;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {     
       schoolClass::factory()->count(5)->has(student::factory()->count(2))->create();
    }
}
