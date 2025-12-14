<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use Carbon\Carbon;

class UpdateStudentAge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-student-age';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $this->info('Starting student age update...');

        $students = Student::whereNotNull('date_of_birth')->get();
        $updatesCount = 0;
        $now = Carbon::now();

        foreach ($students as $student) {
            try {
                $dateOfBirth = Carbon::parse($student->date_of_birth);

                $age = $dateOfBirth->diffInYears($now);

                if (!isset($student->age) || $student->age != $age) {

                    $student->age = $age;
                    $student->save();

                    $updatesCount++;
                }

            } catch (\Exception $e) {
                $this->error("Error updating student ID {$student->id}: " . $e->getMessage());
            }
        }

        $this->info("Student age update complete. {$updatesCount} students were updated.");

        return 0;
    }
}
