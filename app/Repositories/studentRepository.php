<?php
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;


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
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $student = $this->find($id);
        if ($student) {
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