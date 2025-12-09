<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class StudentRepository
{
    protected $model;

    public function __construct(Student $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Student
    {
        return $this->model->find($id);
    }

    public function create(array $data): Student
    {
        if (isset($data['photo'])) {
            $path = $data['photo']->store('profile_pictures', 'public');
            $data['photo'] = $path;
        }
        if (isset($data['subjects'])) {
            $subjects = $data['subjects'];
            unset($data['subjects']);
        }
        $student= $this->model->create($data);

        if (!empty($subjects)) {
            $student->subjects()->sync($subjects);
        }

        return $student;
    }

    public function update(int $id, array $data): bool
    {
        $student = $this->find($id);

        if ($student) {

            if (isset($data['photo'])) {
                // Delete old photo if exists
                if ($student->photo) {
                    Storage::disk('public')->delete($student->photo);
                }
                $path = $data['photo']->store('profile_pictures', 'public');
                $data['photo'] = $path;
            }

            if (isset($data['subjects'])) {
                $subjects = $data['subjects'];
                unset($data['subjects']);
                $student->subjects()->sync($subjects);
            }
            
            return $student->update($data);
        }
        return false;
    }
    public function delete(int $id): bool
    {
        $student = $this->find($id);
        if ($student) {
            return $student->delete();
        }
        return false;
    }

    public function getStudentWithClassAndSubjects(int $id): ?Student
    {
        return $this->model->with(['schoolClass','subjects'])->find($id);
    }
}